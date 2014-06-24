<?php

/* TODO
 *
 * Unverifiable because I can not send karmio emails from my local machine.
 *
 */

class CentralMailingTest extends CTestCase
{
    protected $user;
    //protected $store_no_user;
    protected $product;
    protected $store;
    protected $charity;
    protected $userPurchase;

    protected function setUp() {

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

        $name = 'unit_test';
        $email = "look.away+". $name ."@gmail.com";
        # delete old data
        User::model()->deleteAllByAttributes(array('email' => $email));
        Product::model()->deleteAllByAttributes(array('name' => $name));
        UserStore::model()->deleteAllByAttributes(array('name' => $name));
        UserStore::model()->deleteAllByAttributes(array('name' => $name . "_no_user"));
        Charities::model()->deleteAllByAttributes(array('name' => $name . "_charity"));
        UserPurchase::model()->deleteAllByAttributes(array('invoice_id' => '1234567890'));

        # set up new data

        $user = new User();
        $user->location_id = 1;
        $user->state_id = 2;
        $user->zip = "12345";
        $user->fname = $name;
        $user->email = $email;
        $user->password = "123456";
        $user->address2 = "123 Main St";
        $user->cellphone = '1231231234';
        $user->organization_id = 0;
        $user->activatekey = 'test123';
        $user->secret_key= "blah";
        $user->tax_id = 'test123';
        $user->save();
        //print_r($user->getErrors());
        $this->user = $user;

        $this->store = new UserStore;
        $attribs = array(
            'name' => $name,
            'owner_name' => $name,
            'email' => $name . '@karm.io',
            'user_id' => $user->id,
        );
        $this->store->attributes = $attribs;
        $this->store->save();

        $this->store_no_user = new UserStore;
        $attribs = array(
            'name' => $name . "_no_user",
            'owner_name' => $name . "_no_user",
            'email' => $name . '@karm.io',
        );
        $this->store_no_user->attributes = $attribs;
        $this->store_no_user->save();

        $this->charity = new Charities();
        $attribs = array(
            'name' => $name . "_charity",
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

        $product_attributes = array(
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
        );

        $this->pm = new ProductManagement();
        // this will generate a deal_created email:
        $this->product = $this->pm->create($product_attributes, $this->store, $this->charity->ein, $this->user->id, null);

        $up = new UserPurchase();
        $up->attributes = array(
            'product_id' => $this->product->id,
            'user_id' => $this->user->id,
            'store_id' => $this->store->id,
            'invoice_id' => '1234567890',
            'transaction_id' => '1234567890',
            'expiry_date' => $end,
            'paid_price' => '100',
            'donated' => '10',
            'quantity' => 1,
            'nfg_chargedid' => '1234567890',
            'gift' => 0,
            'ein' => $this->charity->ein,
        );
        $up->save();
        $this->userPurchase = $up;
    }

    /*public function testWelcomeBuyer() {
        $cm = new CentralMailing();
        $mail = $cm->welcome_buyer($this->user);
        $this->assertTrue($mail);
    }

    public function testWelcomeSeller() {
        $cm = new CentralMailing();
        $mail = $cm->welcome_seller($this->store);
        $this->assertTrue($mail);
    }

    public function testWelcomeSellerNoUser() {
        $cm = new CentralMailing();
        $mail = $cm->welcome_seller($this->store_no_user);
        $this->assertTrue($mail);
    }

    /*public function testDealCreated() {
        $cm = new CentralMailing();
        $mail = $cm->deal_created($this->user, $this->product);
        $this->assertTrue($mail);
    }

    public function testDealApproval() {
        $cm = new CentralMailing();
        $mail = $cm->deal_approved($this->product->id);
        $this->assertTrue($mail);
    }

    public function testDealSuspended() {
        $cm = new CentralMailing();
        $mail = $cm->deal_suspended($this->product->id);
        $this->assertTrue($mail);
    }

    // TODO
    public function testPurchaseComplete() {
        $cm = new CentralMailing();
        $mail = $cm->purchase_complete($this->userPurchase);
        $this->assertTrue($mail);
    }

    // TODO
    /*public function testResetPassword() {
        $cm = new CentralMailing();
        $mail = $cm->reset_password($this->user);
        $this->assertTrue($mail);
    }

    public function testNewCharityRegistered() {
        $cm = new CentralMailing();
        $mail = $cm->new_charity_registered($this->charity);
        $this->assertTrue($mail);
    }

    // TEST
    public function testSellerCheckIn() {
        $cm = new CentralMailing();
        $mail = $cm->seller_check_in($this->userPurchase);
        $this->assertTrue($mail);
    }

    public function testContact() {
        $cf = new ContactForm();
        $cf->name = 'UNIT TEST NAME';
        $cf->email = 'look.away+unit_test_contact@gmail.com';
        $cf->body = 'blah blah blah';
        $cf->subject = 'this website is so cool';
        $cf->validate();

        $cm = new CentralMailing();
        $cm->contact($cf);
    }

    public function testStoreApproved() {
        $this->store->is_verified = 1;
        $this->store->save(array('is_verified'));

        $cm = new CentralMailing();
        $mail = $cm->store_approved($this->store);
        $this->assertTrue($mail);
    }

    public function testStoreApprovedNoUser() {
        $this->store_no_user->is_verified = 1;
        $this->store_no_user->save(array('is_verified'));

        $cm = new CentralMailing();
        $mail = $cm->store_approved($this->store_no_user);
        $this->assertTrue($mail);
    }

    public function testStoreDenied() {
        $this->store->is_verified = 0;
        $this->store->save(array('is_verified'));

        $cm = new CentralMailing();
        $mail = $cm->store_denied($this->store);
        $this->assertTrue($mail);
    }

    public function testStoreDeniedNoUser() {
        $this->store_no_user->is_verified = 0;
        $this->store_no_user->save(array('is_verified'));

        $cm = new CentralMailing();
        $mail = $cm->store_denied($this->store_no_user);
        $this->assertTrue($mail);
    }

    /*
     * TODO: need to test with remote db or local version of website
     * in order to fully verify
     */
    // TODO: test bad inputs
}


?>