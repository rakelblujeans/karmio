<?php

class UserManagementTest extends CTestCase
{
    protected $user;
    protected $badUser;
    protected $org;

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

        # clear old data
        $fname = 'UNIT_TEST';
        User::model()->deleteAllByAttributes(array('fname' => $fname));
        UserStore::model()->deleteAllByAttributes(array('name' => $fname));

        $loc = Location::model()->findByAttributes(array('value' => 'New York'));

        $this->user = array(
            "email" => $fname ."@karm.io",
            "fname" => $fname,
            "zip" => "11205",
            "cellphone" => "1234561234",
            "password" => "12345",
            "password_repeat" => "12345",
            "location_id" => '',
            'state_id' => '',
            'tax_id' => '',
            'address2' => 't',
            'organization_id' => '1', #TODO fix
        );

        $this->userStore = array(
            'owner_name' => $fname,
             'name' => $fname,
             'email' => $this->user['email'],
             'phone' => $this->user['cellphone'],
             'zip' => $this->user['zip'],
             'location_id' => 'Brooklyn',
             'state_id' => $loc->id,
             );
        $this->badUser = null;
    }

    public function testValidateUser()
    {
        $um = new UserManagement();
        $result = $um->validateUser($this->user);
        $this->assertTrue(!is_null($result));
    }

    public function testBadValidateUser()
    {
        $um = new UserManagement();
        $result = $um->validateUser($this->badUser);
        $this->assertNull($result);
    }

    public function testCreateUser()
    {
        $um = new UserManagement();
        $result = $um->createUser($this->user, null);
        $this->assertTrue(!is_null($result));
    }

    public function testCreateUserBad()
    {
        $um = new UserManagement();
        $result = $um->createUser($this->badUser, null);
        $this->assertNull($result);
    }

    public function testSignupSeller()
    {
      $um = new UserManagement();
      $result_store = $um->signupSeller($this->user, $this->userStore, 0);
      $this->assertTrue(!is_null($result_store));

      // verify they are in the db
      $found_user = User::model()->findByPk($result_store->user_id);
      $this->assertTrue(count($found_user) == 1);
      $found_store = UserStore::model()->findByPk($result_store->id);
      $this->assertTrue(count($found_store) == 1);
      //print_r($result_store->user_id);
    }

    public function testSignupSellerNoUser()
    {
        $um = new UserManagement();
        $result_store = $um->signupSeller(null, $this->userStore, 0);
        $this->assertTrue(!is_null($result_store));

        // verify they are in the db
        $found_user = User::model()->findByPk($result_store->user_id);
        $this->assertTrue(count($found_user) == 1);
        $found_store = UserStore::model()->findByPk($result_store->id);
        $this->assertTrue(count($found_store) == 1);
    }

    public function testSignupSellerAsAdmin()
    {
        $um = new UserManagement();
        $result = $um->signupSeller($this->user, $this->userStore, 1);
        $this->assertTrue(!is_null($result));

        // verify they are in the db
        // verify that the user_id on the store is set
        $found_user = User::model()->findByPk($result['user']->id);
        $this->assertTrue(count($found_user) == 1);
        //print_r($found_user->password);
        $found_store = UserStore::model()->findByPk($result->id);
        $this->assertTrue(count($found_store) == 1);
        //print_r($result['user']->id);
    }

    public function testActivateUser() {
        $um = new UserManagement();
        $user = $um->createUser($this->user, null);
        $this->assertTrue(!is_null($user));

        $result = $um->activateUser($user);
        $this->assertTrue($result == 1);

        // verify DB data
        $found_user = User::model()->findByPk($user->id);
        $this->assertTrue($found_user->status === 'active');
        $this->assertTrue($found_user->activatekey === 'z');
    }

    public function testLoginSellerCreatedByAdmin() {
        $um = new UserManagement();
        $result = $um->signupSeller($this->user, $this->userStore, 1);
        $this->assertTrue(!is_null($result));

        $lf = new LoginForm();
        $lf->attributes = array(
            'username' => $this->user['email'],
            'password' => $this->user['password'],
        );

        $result = $lf->validate();
        //var_dump($lf->getErrors());
        //var_dump($result);
        $this->assertTrue($result);
    }

    public function testLoginForm() {
        $um = new UserManagement();
        $user = $um->createUser($this->user, null);
        $this->assertTrue(!is_null($user));
        $result = $um->activateUser($user);
        $this->assertTrue($result == 1);

        $lf = new LoginForm();
        $lf->attributes = array(
            'username' => $this->user['email'],
            'password' => $this->user['password'],
        );

        $result = $lf->validate();
        $this->assertTrue($result);
    }

    public function testResetPassword() {
        $um = new UserManagement();
        $user = $um->createUser($this->user, null);
        $this->assertTrue(!is_null($user));
        $result = $um->activateUser($user);
        $this->assertTrue($result == 1);

        $um->resetPassword($user);
    }

    public function testUpdatePassword() {
        $um = new UserManagement();
        $user = $um->createUser($this->user, null);
        $this->assertTrue(!is_null($user));
        $result = $um->activateUser($user);
        $this->assertTrue($result == 1);

        $post = array(
            'password' => '343434',
            'password_repeat' => '343434',
        );
        $result = $um->updatePassword($user, $post);
        $this->assertTrue($result);

        $lf = new LoginForm();
        $lf->attributes = array(
            'username' => $user->email,
            'password' => '343434',
        );
        $result = $lf->validate();
        $this->assertTrue($result);
    }

    /* TODO:
     * test tempStore
     * update
     * delete
     */
}

?>