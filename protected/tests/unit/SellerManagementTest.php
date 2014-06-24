<?php
/**
 * Created by PhpStorm.
 * User: raquelbujans
 * Date: 12/5/13
 * Time: 6:29 AM
 */

class SellerManagementTest extends CTestCase {

    protected $user, $store, $charity, $product, $pqty, $buyNowForm, $pm, $sc;

    protected function setUp()
    {
        if (!defined(YII_DEBUG)) {
            define(YII_DEBUG, true);
        }

        # fixes to handle captcha
        Yii::$classMap = array_merge(Yii::$classMap, array(
            'CaptchaExtendedAction' => Yii::getPathOfAlias('ext.captchaExtended') . DIRECTORY_SEPARATOR . 'CaptchaExtendedAction.php',
            'CaptchaExtendedValidator' => Yii::getPathOfAlias('ext.captchaExtended') . DIRECTORY_SEPARATOR . 'CaptchaExtendedValidator.php'
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
        Charities::model()->deleteAllByAttributes(array('name' => $name));

        # set up new data
        $user = new User();
        $user->location_id = 1;
        $user->state_id = 2;
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

        $this->charity = new Charities();
        $attribs = array(
            'name' => $name,
            'owner_name' => $name,
            'email' => $name . '@karm.io',
            'ein' => 123456789,
            'verifyCode' => '',
        );
        $this->charity->attributes = $attribs;
        $this->charity->save();

        $start = new DateTime();
        $start = $start->format('Y-m-d');
        $end = new DateTime();
        $end = $end->modify("+7 day")->format('Y-m-d');

        $this->product = array(
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

        $this->pqty = 5;
        $this->buyNowForm = new BuyNowForm();
        $this->buyNowForm->attributes = array(
            'fname'=> $user->fname,
            'lname'=> $user->lname,
            'cnumber'=>'4111111111111111',
            'ccv'=> '222',
            'address'=>'123 Karmio St',
            'city' => 'New York',
            'state' => 'NY',
            'zipcode'=>'12345',
            'country' => 'usa',
            'pqty'=> $this->pqty,
            'phone_number' => '1231231234',
            'availableQuantity' => '25',
            'emonth' => '08',
            'eyear' => '2017',
        );
        $this->buyNowForm->edate = $this->buyNowForm->emonth . '/' . substr($this->buyNowForm->eyear, 2, 2);
        $this->buyNowForm->validate();

        $this->pm = new ProductManagement();
        $this->sc = new ShoppingCart();
    }

    public function testCheckIn() {
        // create a deal
        $new_product = $this->pm->create($this->product, $this->store, $this->charity->ein, $this->user->id, null);
        $new_product->status = 'published';
        $new_product->save();

        // make a purchase
        $sm = new SellerManagement();
        $output = $this->sc->purchaseDeal($this->user, $this->buyNowForm, $new_product);

        if (isset($output['invoice_ids'])) {
            $invoice_ids = $output['invoice_ids'];
        }

        $post = array('invoice' => $invoice_ids);
        $output = $sm->checkIn($this->user, $post);
        $this->assertTrue($output['status'] === 'valid');
        $this->assertTrue(!is_null($output['coupon']));
        $this->assertTrue($output['total'] > 0);
        $this->assertTrue($output['used'] === $this->pqty);
    }


} 