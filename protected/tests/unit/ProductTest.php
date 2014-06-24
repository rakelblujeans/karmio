<?php
/**
 * Created by JetBrains PhpStorm.
 * User: raquelbujans
 * Date: 10/14/13
 * Time: 7:37 PM
 * To change this template use File | Settings | File Templates.
 */

class ProductTest extends CTestCase
{
    protected $product;
    protected $badProduct;
    protected $store;
    protected $charity;
    protected $charity2;
    protected $pc;

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
        User::model()->deleteAllByAttributes(array('fname' => $fname));
        Product::model()->deleteAllByAttributes(array('name' => $name));
        Product::model()->deleteAllByAttributes(array('name' => $name . 'Bad'));
        UserStore::model()->deleteAllByAttributes(array('name' => $name));
        Charities::model()->deleteAllByAttributes(array('name' => $name));
        Charities::model()->deleteAllByAttributes(array('name' => $name . '2'));

        # set up new data
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

        $this->charity2 = new Charities();
        $attribs = array(
            'name' => $name . '2',
            'owner_name' => $name,
            'email' => $name . '@karm.io',
            'ein' => 123456780,
            'verifyCode' => '',
        );
        $this->charity2->attributes = $attribs;
        $this->charity2->save();

        $user = new User();
        $user->location_id = 1;
        $user->state_id = 2;
        $user->zip = "12345";
        $user->fname = $fname;
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
        //print_r($p->getErrors());

        $this->pm = new ProductManagement();
    }

    // validate a product with user-choice of charities
    public function testValidateProductEIN() {
        $output = $this->pm->validate($this->product, $this->store->name, '', $this->user->id);
        $this->assertTrue(!is_null($output));
    }

    // validate a product with specific charity
    public function testValidateProductChoice() {
        $output = $this->pm->validate($this->product, $this->store->name, $this->charity->ein, $this->user->id);
        $this->assertTrue(!is_null($output));
    }

    public function testValidateBadProduct() {
        $output = $this->pm->validate($this->badProduct, $this->store->name, $this->charity->ein, $this->user->id);
        $this->assertNull($output);
    }

    public function testCreateEIN() {
        $output = $this->pm->create($this->product, $this->store, $this->charity->ein, $this->user->id, null);
        $this->assertTrue(!is_null($output));
    }

    public function testCreateChoice() {
        $output = $this->pm->create($this->product, $this->store, '', $this->user->id, null);
        //var_dump($output);
        $this->assertTrue(!is_null($output));
    }

    // from one specific charity to another
    public function testUpdateSpecificEIN() {
        $output1 = $this->pm->create($this->product, $this->store, $this->charity->ein, $this->user->id, null);
        $output2 = $this->pm->update($output1, $output1->attributes, $this->charity2->ein, null);
        $this->assertTrue($output2->ein == $this->charity2->ein);
        $this->assertTrue(!is_null($output2));
    }

    // from user choice to charity
    public function testUpdateChoiceToSpecificEIN() {
        $output1 = $this->pm->create($this->product, $this->store, '', $this->user->id, null);
        $output2 = $this->pm->update($output1, $output1->attributes, $this->charity->ein, null);
        $this->assertTrue($output2->ein == $this->charity->ein);
        $this->assertTrue(!is_null($output2));
    }

    // from charity to user choice
    public function testUpdateSpecificToChoiceEIN() {
        $output1 = $this->pm->create($this->product, $this->store, $this->charity->ein, $this->user->id, null);
        $output2 = $this->pm->update($output1, $output1->attributes, '', null);
        $this->assertTrue(is_null($output2->ein));
        $this->assertTrue(!is_null($output2));
    }

    // from user choice to user choice
    public function testUpdateChoiceToChoiceEIN() {
        $output1 = $this->pm->create($this->product, $this->store, $this->charity->ein, $this->user->id, null);
        $output2 = $this->pm->update($output1, $output1->attributes, $this->charity2->ein, null);
        $this->assertTrue($output2->ein == $this->charity2->ein);
        $this->assertTrue(!is_null($output2));
    }

    public function testListAllSearch() {
        $output = $this->pm->create($this->product, $this->store, $this->charity->ein, $this->user->id, null);
        $output->status = 'published';
        $output->save();
        // 0 == default val for Product::location_id
        $output = $this->pm->listAll($output->id, null, 0);
        $this->assertTrue(!is_null($output));
    }

    public function testListAllClear() {
        $output = $this->pm->create($this->product, $this->store, $this->charity->ein, $this->user->id, null);
        $output = $this->pm->listAll($output->id, 1, null);
        $this->assertTrue(!is_null($output));
    }

    /* TODO
     * creation:
     * test new store
     * test existing store
     * test with picture
     *
     * update:
     * test with picture
     */
}

?>