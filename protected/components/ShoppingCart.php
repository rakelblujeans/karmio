<?php

// Adjust this to point to the Authorize.Net PHP SDK
require_once dirname(Yii::app()->basePath) . '/anet_php_sdk/AuthorizeNet.php';

/**
 * Created by JetBrains PhpStorm.
 * User: raquelbujans
 * Date: 10/15/13
 * Time: 12:20 AM
 * To change this template use File | Settings | File Templates.
 */

class ShoppingCart
{

    private function log($text)
    {
        Yii::log($text . "\n\n\n\n\n\n");
        error_log($text);
    }

    /* stores credit card on file and then charges NFG */
    public function chargeNFG($buyNowForm, $product, $charity_amount, $user, $userIPAddress)
    {
        ini_set("soap.wsdl_cache_enabled", "1");
        $client = new SoapClient(Yii::app()->params["NFG_URL"]);

        $card_type = '';
        $card_num = substr($buyNowForm->cnumber, 0, 1);
        switch ($card_num) {
            case 3:
                $card_type = 'American Express';
                break;
            case 4:
                $card_type = 'Visa';
                break;
            case 5:
                $card_type = 'MasterCard';
                break;
            case 6:
                $card_type = 'Discover';
                break;
        }

        $loc = Location::model()->findByAttributes(array('id' => $buyNowForm->state));
        $params = array(
            'PartnerID' => Yii::app()->params['NFG_PARTNER_ID'],
            'PartnerPW'       => Yii::app()->params['NFG_PARTNER_PW'],
            'PartnerSource'   => Yii::app()->params['NFG_PARTNER_SOURCE'],
            'PartnerCampaign' => Yii::app()->params['NFG_CAMPAIGN'],
            'DonationLineItems' => array(
                'DonationItem' => array(
                    'NpoEin' => $product->ein,
                    'donorVis' => 'ProvideAll',
                    'ItemAmount' => $charity_amount,
                    'RecurType' => 'NotRecurring',
                    'AddOrDeduct' => 'Deduct',
                    'TransactionType' => 'Donation',
            )),
            'TotalAmount' => $charity_amount,
            'TipAmount'   => 0,
            'DonorIpAddress'  => $userIPAddress,
            'DonorFirstName'  => $buyNowForm->fname,
            'DonorLastName'   => $buyNowForm->lname,
            'DonorEmail'      => $product->user->email,
            'DonorAddress1'   => $buyNowForm->address,
            'DonorCity'       => $buyNowForm->city,
            'DonorState'      => $loc->value,
            'DonorZip'        => $buyNowForm->zipcode,
            'DonorPhone'      => $buyNowForm->phone_number,
            'DonorToken'      => $user->id,
            'CardType'        => $card_type,
            'NameOnCard'      => $buyNowForm->fname . ' ' . $buyNowForm->lname,
            'CardNumber'      => $buyNowForm->cnumber,
            'ExpMonth'        => $buyNowForm->emonth,
            'ExpYear'         => $buyNowForm->eyear,
            'CSC'             => $buyNowForm->ccv
        );

        //var_dump($params);
        $result = $client->MakeDonationAddCOF($params);

        $cofId = $result->MakeDonationAddCOFResult->CofId;
        $chargeId = $result->MakeDonationAddCOFResult->ChargeId;

        if ($result->MakeDonationAddCOFResult->StatusCode === 'Success') {
            return array(
                'CofId' => $cofId,
                'ChargeId' => $chargeId,
            );
        } else {
            error_log(var_dump($result));
            return -1;
        }
    }

    public function chargeAuthorizeNet($model, $user, $seller_amount)
    {
        $METHOD_TO_USE = "AIM";
        if (!defined("AUTHORIZENET_API_LOGIN_ID")) {
            define("AUTHORIZENET_API_LOGIN_ID",
                Yii::app()->params['AUTHORIZENET_API_LOGIN_ID']);
        }
        if (!defined("AUTHORIZENET_TRANSACTION_KEY")) {
            define("AUTHORIZENET_TRANSACTION_KEY",
                Yii::app()->params["AUTHORIZENET_TRANSACTION_KEY"]);
        }
        if (!defined("AUTHORIZENET_SANDBOX")) {
            // Set to false to test against production
            define("AUTHORIZENET_SANDBOX",
                Yii::app()->params["AUTHORIZENET_SANDBOX"]);
        }
        if (!defined("TEST_REQUEST")) {
            // You may want to set to true if testing against production
            define("TEST_REQUEST",
                Yii::app()->params["TEST_REQUEST"]);
        }

        $transaction = new AuthorizeNetAIM;
        $transaction->setSandbox(Yii::app()->params["AUTHORIZENET_SANDBOX"]);
        $transaction->setFields(
            array(
                'amount' => (float)($seller_amount),
                'card_num' => $model->cnumber,
                'exp_date' => $model->edate,
                'first_name' => $model->fname,
                'last_name' => $model->lname,
                'address' => $model->address,
                'city' => $model->city,
                'state' => $model->state,
                'country' => $model->country,
                'zip' => $model->zipcode,
                'email' => $user->email,
                'card_code' => $model->ccv,
                'cust_id' => $user->id,
            )
        );
        $response = $transaction->authorizeAndCapture();
        if ($response->error) {
            error_log(var_dump($response)); //exit;
        }

        return $response;
    }

    // NOTE: authorize.net response
    public function generateInvoice($model, $model2, $data, $transaction_id, $purchase)
    {
        //print "\nQTY: " . $purchase->quantity;
        $invoiceId = array();
        for ($i = 1; $i <= $purchase->quantity; $i++) {
            $output = null;
            while ($output === null) {
                // TODO: sometimes this comes back null. just keep trying
                $output = $model2->generatecode($transaction_id . $i, $data->id);
            }
            $invoiceId[$i - 1] = $output;
            //var_dump($invoiceId[$i - 1]);
        }
        $invoice_ids = implode(',', $invoiceId);
        //print_r("IDS: ". $invoice_ids);
        $purchase->invoice_id = $invoice_ids;
        $purchase->paid_price = (float)($data->price * $model->pqty);
        $purchase->donated = (float)($data->amount_share * $model->pqty);
        $purchase->transaction_id = $transaction_id;
        $purchase->save(false);
        //print_r($purchase->getErrors());
        foreach ($invoiceId as $val) {

            $invc = new PurchasedCoupons;
            $invc->purchase_id = $purchase->id;
            //print_r("\nVAL: " . $val);
            $invc->invoice_id = $val;
            $invc->save(false);
            //print_r($invc->getErrors());
        }
        //print_r("IDS: ". $invoice_ids);
        return $invoice_ids;
    }

    // store credit card if not on file
    public function saveCreditCard($buyNowForm, $product2, $data, $uid)
    {
        $row = TransactionsDetails::model()->findByAttributes(array('user_id' => $uid));

        $crdnum = $buyNowForm->cnumber;
        $crd = $product2->encryptStringArray($crdnum);
        $ccv = $buyNowForm->ccv;
        $ccven = $product2->encryptStringArray($ccv);
        $updatedRow = '';
        if (is_null($row)) {
            $td = new TransactionsDetails();
            $td->attributes = array('user_id' => $uid,
                'cnumber' => $crd,
                'ccv' => $ccven,
                'fname' => $buyNowForm->fname,
                'lname' => $buyNowForm->lname,
                'address' => $buyNowForm->address,
                'city' => $buyNowForm->city,
                'state' => $buyNowForm->state,
                'country' => $buyNowForm->country,
                'zipcode' => $buyNowForm->zipcode,
                'edate' => $buyNowForm->edate);
            $td->save();
            //print_r($td->getErrors());
        } elseif ($buyNowForm->cnumber != $product2->decryptStringArray($row->cnumber) ||
            $buyNowForm->ccv != $product2->decryptStringArray($row->ccv)
        ) {
            // update card on file
            $foundRow = TransactionsDetails::model()->findByAttributes(array('user_id' => $uid));
            $foundRow->update(
                array('cnumber' => $crd,
                    'ccv' => $ccven,
                    'fname' => $buyNowForm->fname,
                    'lname' => $buyNowForm->lname,
                    'address' => $buyNowForm->address,
                    'city' => $buyNowForm->city,
                    'state' => $buyNowForm->state,
                    'country' => $buyNowForm->country,
                    'zipcode' => $buyNowForm->zipcode,
                    'edate' => $buyNowForm->edate));
        }
        return $updatedRow;
    }

    public function purchaseDeal($user, $buyNowForm, $foundProduct, $userIPAddress) {
        // shown if any step in the financial process fails
        $error_msg = 'We are sorry! We are unable to process your credit card transaction. '.
            'Your donation may have failed if your billing information, such as your credit '.
            'card number, address, expiration date or card security code, did not match '.
            'exactly what is on file at your bank.  If your credit card information was '.
            'entered correctly and you are still unable to process your transaction, we '.
            'recommend that you contact your bank or our partner Network for Good\'s '.
            'customer service team at donations@networkforgood.org.';

        //Test if total total sales are equal to the coupons
        $myCriteria = new CDbCriteria();
        $myCriteria->select = 'SUM(quantity) AS quantity';
        $myCriteria->condition = "product_id = $foundProduct->id";
        $ups = UserPurchase::model()->findAll($myCriteria);
        foreach ($ups as $up) {
            ;
        }

        $buyNowForm->edate = $buyNowForm->emonth . '/' . substr($buyNowForm->eyear, 2, 2);
        $valid = false;
        $valid = $buyNowForm->validate();
        if ($valid) {
            //$this->log("FORM VALID");
            $quantity = $up->quantity + $buyNowForm->pqty;
            if ($quantity <= $foundProduct->coupons) {

                $this->log("QTY < COUPONS");
                // TODO: add in email when we run out of coupons
                /**
                 * Make entry in user purchase
                 */
                $purchase = new UserPurchase;
                $purchase->product_id = $foundProduct->id;
                $purchase->user_id = $user->id;
                $purchase->store_id = $foundProduct->productStores[0]->store_id;
                $purchase->expiry_date = $foundProduct->expiry_date;
                $purchase->quantity = $buyNowForm->pqty;
                $purchase->ein = $foundProduct->ein;

                $temp_price = ($foundProduct->regular_price * $foundProduct->price) / 100;
                $temp_price = round($temp_price);
                $temp_price_2 = $foundProduct->regular_price - $temp_price;
                $net_price = $temp_price_2 - $foundProduct->amount_share;
                $net_price = round($net_price);

                $seller_amount = round($net_price * $buyNowForm->pqty);
                $charity_amount = $foundProduct->amount_share * $buyNowForm->pqty;

                // charge to charity amount
                // charge to authorize.net
                $authorize_response = $this->chargeAuthorizeNet($buyNowForm, $user, $seller_amount);
                $this->log("AUTHORIZE.NET APPROVED: " . $authorize_response->response);
                $NFG_response = false;
                if ($authorize_response) {
                  $NFG_response = $this->chargeNFG($buyNowForm, $foundProduct, $charity_amount, $user, $userIPAddress);
                    $this->log("NFG RESPONSE: " . var_dump($NFG_response));
                    if ($NFG_response == -1) {
                        return array('successful' => 0,
                                     'error_msg' => $error_msg,
                                     'purchase' => $purchase,
                                     'model' => $buyNowForm,
                                     'foundProduct' => $foundProduct
                                     );
                    } else {
                        $purchase->nfg_chargedid = $NFG_response['ChargeId'];
                        $this->log("Purchase[". $purchase->id ."] NFG CHARGID: " . $purchase->nfg_chargedid);
                    }
                } else {
                    $this->log("AUTHORIZE>NET REASON:" . $authorize_response->response_reason_text);
                    // TODO: $this->render('buyNow', array('data' => $foundProduct, 'model' => $buyNowForm, 'msg' => $error_msg));
                    return array('successful' => 0,
                                 'error_msg' => $error_msg,
                                 'purchase' => $purchase,
                                 'model' => $buyNowForm,
                                 'foundProduct' => $foundProduct
                                 );
                }

                if ($authorize_response && $NFG_response != -1) {
                    // generate invoice
                    $this->log("GENERATING INVOICE");
                    $purchase->save();
                    $newProduct = new Product;
                    $invoice_ids = $this->generateInvoice(
                        $buyNowForm,
                        $newProduct,
                        $foundProduct,
                        $authorize_response->transaction_id,
                        $purchase);

                    // mark as sold out if all available coupons are sold
                    if ($buyNowForm->availableQuantity == $buyNowForm->pqty) {
                        $foundProduct->status = 'sold_out';
                        $foundProduct->save(false);
                    }

                    // save credit card
                    $this->saveCreditCard($buyNowForm, $newProduct, $foundProduct, $user->id);
                    return array(
                        'successful' => 1,
                        'error_msg' => '',
                        'purchase' => $purchase,
                        'model' => $buyNowForm,
                        'foundProduct' => $foundProduct,
                        'invoice_ids' => $invoice_ids
                    );

                    // purchase complete!
                    /*$this->redirect(CController::createUrl('/product/buyComplete',
                        array('pid' => $buyNowForm->pid,
                            'cid' => $purchase->id)));*/
                }
                $ret = array(
                    'successful' => 0,
                    'error_msg' => $error_msg,
                    'purchase' => $purchase,
                    'model' => $buyNowForm,
                    'foundProduct' => $foundProduct
                );
                return $ret;
            }
        }


    }
}

?>