<?php
/**
 * Created by JetBrains PhpStorm.
 * User: raquelbujans
 * Date: 10/15/13
 * Time: 12:23 AM
 * To change this template use File | Settings | File Templates.
 */


class ShoppingCartTest extends CTestCase
{
    protected $sc;
    protected $user;
    protected $product;
    protected $store;
    protected $buyNowForm;
    protected $charity;

    protected function setUp()
    {
        if (!defined(YII_DEBUG)) {
            define(YII_DEBUG, true);
        }

        # fixes to handle captcha
        Yii::$classMap = array_merge( Yii::$classMap, array(
            'CaptchaExtendedAction' => Yii::getPathOfAlias('ext.captchaExtended').DIRECTORY_SEPARATOR.'CaptchaExtendedAction.php',
            'CaptchaExtendedValidator' => Yii::getPathOfAlias('ext.captchaExtended').DIRECTORY_SEPARATOR.'CaptchaExtendedValidator.php'
        ));
        $c = Yii::app()->createController('user/signupBuyer');
        Yii::app()->controller = $c[0];
        $captcha = new CCaptchaAction(Yii::app()->controller, 'captcha');
        $captcha_input = $captcha->getVerifyCode();

        # delete old data
        $fname = 'test123';
        $name = "UNIT_TEST";

        // delete purchased coupons first, because DB doesn't properly cascade
        $rows = UserPurchase::model()->findAll(
            'transaction_id LIKE :match',
            array(':match' => 'TEST%'));
        $arr = array();
        foreach($rows as $row)
            $arr[] = $row->id;
        $str = implode(',', $arr);
        if ($str)
            PurchasedCoupons::model()->deleteAll('purchase_id IN('. $str . ')');
        // delete UserPurchase row
        UserPurchase::model()->deleteAll(
            'transaction_id LIKE :match',
            array(':match' => 'TEST%'));
        User::model()->deleteAllByAttributes(array('fname' => $fname));
        Product::model()->deleteAllByAttributes(array('name' => $name));
        UserStore::model()->deleteAllByAttributes(array('name' => $name));

        $this->charity = Charities::model()->findByAttributes(array('name' => '10,000 Degrees'));
        $loc = Location::model()->findByAttributes(array('value' => 'New York'));

        # set up new data
        $user = new User();
        $user->location_id = 1;
        $user->state_id = $loc->id;
        $user->zip = "12345";
        $user->fname = $fname;
        $user->lname = $fname;
        $user->email = $fname. "@karm.io";
        $user->password = "123456";
        $user->address2 = "123 Main St";
        $user->cellphone = '1231231234';
        $user->organization_id = 0;
        $user->activatekey = $fname;
        $user->secret_key= $fname;
        $user->tax_id = $fname;
        $user->save();
        //print_r($user->getErrors());
        $this->user = $user;

        $this->store = new UserStore;
        $attribs = array(
            'name' => $name,
            'owner_name' => $name,
            'email' => $name . '@karm.io',
        );
        $this->store->attributes = $attribs;
        $this->store->save();

        $start = new DateTime();
        $start = $start->format('Y-m-d');
        $end = new DateTime();
        $end = $end->modify("+7 day")->format('Y-m-d');

        $product_attribs = array(
            'name' => $name,
            'fine_print' => $name,
            'oName' => 'Watsi.org',
            'description' => $name,
            'regular_price' => 100,
            'coupons' => 10,
            'redeming_date_start' => $start,
            'end_date' => $end,
            'redeming_date_end' => $end,
            'agree' => 1,
            'admin_share' => 10.00,
            'amount_share' => 10.00,
            'picture' => '',
            'address' => $name,
            'store_id' => $this->store->id,
        );
        // create a deal
        $pm = new ProductManagement();
        $this->product = $pm->create($product_attribs, $this->store, $this->charity->ein, $this->user->id, null);
        $this->product->status = 'published';
        $this->product->save();

        /*
        $this->product = new Product();
        $this->product->attributes = array(
            'user_id' => $user->id,
            'category_id' => 1,
            'organization_id' => 1,
            'name' => $name,
            'regular_price' => 100,
            'coupons' => 100,
            'end_date' => $end,
            'admin_share' => 10.00,
            'amount_share' => 10.00, // charity donation
            'fine_print' => $name,
            'oName' => 'Watsi.org',
            'description' => $name,
            'redeming_date_start' => $start,
            'redeming_date_end' => $end,
            'agree' => 1,
            'address' => $name,
        );
        // don't know why i need to do this
        $this->product->ipaddress = $name;
        $this->product->couponcode = $name;
        $this->product->picture = $name;
        $this->product->ein = $charity->ein;
        $this->product->save();

        $this->badProduct = new Product();
        $this->badProduct->attributes = array(
            'user_id' => $user->id,
            'category_id' => 1,
            'organization_id' => 1,
            'name' => $name . 'Bad',
            'regular_price' => 100,
            'coupons' => 100,
            'end_date' => $end,
            'admin_share' => 101,
            'amount_share' => 10.00, // charity donation
            'fine_print' => $name,
            'oName' => 'Watsi.org',
            'description' => $name,
            'redeming_date_start' => $start,
            'redeming_date_end' => $end,
            'agree' => 1,
            'address' => $name,
        );
        // don't know why i need to do this
        $this->badProduct->ipaddress = $name;
        $this->badProduct->couponcode = $name;
        $this->badProduct->picture = $name;
        $this->badProduct->save();
        //print_r($this->product->getErrors());*/

        $this->buyNowForm = new BuyNowForm();
        $this->buyNowForm->attributes = array(
            'fname'=> $user->fname,
            'lname'=> $user->lname,
            'cnumber'=>'4111111111111111',
            'ccv'=> '222',
            'address'=>'123 Karmio St',
            'city' => 'New York',
            'state' => $loc->value,
            'zipcode'=>'12345',
            'country' => 'usa',
            'pqty'=> '5',
            'phone_number' => '1231231234',
            'availableQuantity' => '25',
            'emonth' => '08', 
           'eyear' => '2017',
        );
        $this->buyNowForm->edate = $this->buyNowForm->emonth . '/' . substr($this->buyNowForm->eyear, 2, 2);
        $this->buyNowForm->validate();

        $this->sc = new ShoppingCart();
    }

    // TODO: test forms and models to verify all params
    // TODO: test fail NFG
    // TODO: // test saveCreditCard with update

    /********* VERIFY API *************************/
    public function testChargeNFG() {
        $charityAmount = 25;
        $NFG_response = $this->sc->chargeNFG(
            $this->buyNowForm,
            $this->product,
            $charityAmount,
            $this->user,
            '127.0.0.1');
        $this->assertTrue(!is_null($NFG_response['ChargeId']));
        $this->assertTrue(!is_null($NFG_response['CofId']));
    }

    public function testChargeAuthorizeNET() {
        // vary amount so we don't get mistaken for a duplicate transaction
        $sellerAmount = rand(5, 100);
        $response = $this->sc->chargeAuthorizeNet($this->buyNowForm, $this->user, $sellerAmount);
        $this->assertTrue($response->approved);
    }

    public function testChargeAuthorizeNETBad() {
        // vary amount so we don't get mistaken for a duplicate transaction
        $sellerAmount = rand(5, 100);
        $this->buyNowForm->cnumber = '4211111111111111';
        $response = $this->sc->chargeAuthorizeNet($this->buyNowForm, $this->user, $sellerAmount);
        $this->assertFalse($response->approved);
    }

    /******************* VERIFY DB STATE **********************/
    public function testGenerateInvoice() {
        $product2 = new Product;

        $purchase = new UserPurchase;
        $purchase->product_id = $this->product->id;
        $purchase->user_id = $this->user->id;
        $purchase->expiry_date = $this->product->expiry_date;
        $purchase->quantity = $this->buyNowForm->pqty;
        //print_r("\n A: ".$purchase->quantity ."--".$this->buyNowForm->pqty);
        $purchase->ein = $this->product->ein;
        $purchase->gift = 1; // no idea what this means exactly

        $transId = "TEST_" . rand(1000, 9999);
        //print_r("\nTRANS ID: $transId");
        $invoice_ids = $this->sc->generateInvoice($this->buyNowForm, $product2, $this->product, $transId, $purchase);

        // check the db for a new row with all info
        $foundRow = UserPurchase::model()->findByAttributes(array('invoice_id' => $invoice_ids));
        $this->assertTrue(!is_null($foundRow));

        $foundRows = PurchasedCoupons::model()->countByAttributes(array('purchase_id' => $foundRow->id));
        $this->assertTrue($foundRows == $purchase->quantity);
    }

    public function testSaveCreditCard() {
        $product2 = new Product;
        $output = $this->sc->saveCreditCard($this->buyNowForm, $product2, $this->product, $this->user->id);
        $this->assertTrue(!is_null($output));

        // verify tbl_transactions_details, if not already on file
        $command = Yii::app()->db->createCommand();
        $row = $command->select('*')->from('tbl_transactions_details',
            array('cnumber' => $this->buyNowForm->cnumber,
                'ccv' => $this->buyNowForm->ccv,
                'fname' => $this->buyNowForm->fname,
                'lname' => $this->buyNowForm->lname,
                'address' => $this->buyNowForm->address,
                'city' => $this->buyNowForm->city,
                'state' => $this->buyNowForm->state,
                'country' => $this->buyNowForm->country,
                'zipcode' => $this->buyNowForm->zipcode,
                'edate' => $this->buyNowForm->edate),
            'user_id=:user_id',
            array(':user_id' => $this->user->id))->queryRow();
        $this->assertTrue(!is_null($row));

        // verify tbl_transactions_details, if already on file
        $output = $this->sc->saveCreditCard($this->buyNowForm, $product2, $this->product, $this->user->id);
        $this->assertTrue(!is_null($output));
    }

    public function testPurchaseDeal() {
        // make a purchase
        $output = $this->sc->purchaseDeal($this->user, $this->buyNowForm, $this->product, '127.0.0.1');
        $this->assertTrue($output['successful'] == 1);
        $this->assertTrue(!is_null($output['model']));
        $this->assertTrue(!is_null($output['foundProduct']));
        $this->assertTrue(!is_null($output['purchase']));
        $purch = $output['purchase'];

        // verify new purchase is in the db
        $new_up = UserPurchase::model()->findByAttributes(array('nfg_chargedid' => $purch->nfg_chargedid));
        $this->assertTrue(!is_null($new_up));
    }
}

?>