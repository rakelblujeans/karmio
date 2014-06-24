<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $location_id
 * @property string $fname
 * @property string $lname
 * @property string $email
 * @property string $password
 * @property string $old_password
 * @property string $password_repeat
 * @property string $zip
 * @property string $address
 * @property string $cellphone
 * @property string $status
 *
 * The followings are the available model relations:
 * @property Product[] $products
 * @property Location $location
 * @property UserPurchase[] $userPurchases
 * @property UserRole[] $userRoles
 * @property UserStore[] $userStores
 */
class User extends CActiveRecord {

    public $password_repeat; //passmatch
    public $old_password; //old password in case of password change
    public $captcha_code;

    /**
     * Returns the static model of the specified AR class.
     * @return User the static model class
     */

    public static function model($className = __CLASS__) {

        return parent::model($className);
    }

    public function GetIsAdmin() {
        $admin = UserRole::model()->findAllByAttributes(array('user_id' => $this->id, 'value' => 'admin'));
        if ($admin != null)
            return true;
        else
            return false;
    }

    /**

     * @return string the associated database table name

     */
    public function tableName() {

        return 'tbl_user';
    }

    /**

     * @return array validation rules for model attributes.

     */
    public function rules() {

        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.


        return array(
            array('old_password, password_repeat, password, location_id,secret_key, state_id', 'safe'),
            array('password, password_repeat', 'required', 'on' => 'up_password'),
            array('password', 'compare', 'compareAttribute' => 'password_repeat', 'on' => 'up_password'),
            //array('password', 'compare','compareAttribute' => 'password_repeat', 'on' => 'register'),
            array('email', 'unique'),
            array('fname, email, password ,zip,cellphone', 'required'),
            array('fname, lname, password, zip', 'length', 'max' => 90),
            array('organization_id, zip, state_id', 'numerical', 'integerOnly'=>true),
//            array('cellphone', 'length', 'max' => 11),
            //array('cellphone','match', 'pattern'=>'/^([0|1]?(\d{11}))$/'),
            array('email', 'email'),
            array('email', 'length', 'max' => 255),
            array('status,cellphone', 'length', 'max' => 10),
            array('tax_id', 'length', 'max' => 9),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, location_id,state_id, fname, lname, email,secret_key, tax_id, password, zip, address, address2, cellphone, status', 'safe'),
            //array('captcha_code', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
            array('captcha_code', 'CaptchaExtendedValidator', 'allowEmpty'=>defined(YII_DEBUG) || !CCaptcha::checkRequirements(), 'on' => 'withCaptcha'),
        );
    }

    public function getFullName() {
        return $this->fname . ' ' . $this->lname;
    }

    public function getStoreName() {
        return $this->userStores->name;
    }

    /**

     * @return array relational rules.

     */
    public function relations() {

        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.

        return array(
            'products' => array(self::HAS_MANY, 'Product', 'user_id'),
            //'location' => array(self::BELONGS_TO, 'Location', 'location_id'),
            //'state' => array(self::BELONGS_TO, 'Location', 'state_id'),
            'userPurchases' => array(self::HAS_MANY, 'UserPurchase', 'user_id'),
            'userRoles' => array(self::HAS_MANY, 'UserRole', 'user_id'),
            //'userStores' => array(self::HAS_MANY, 'UserStore', 'user_id'),
            'userStores' => array(self::HAS_ONE, 'UserStore', 'user_id'),
            'userFriendsLists' => array(self::HAS_MANY, 'UserFriendsList', 'user_id'),
        );
    }

    /**

     * @return array customized attribute labels (name=>label)

     */
    public function attributeLabels() {

        return array(
            'id' => 'ID',
            'location_id' => 'Location',
            'state_id' => 'State',
            'fname' => 'Name',
            'lname' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Re-type Password',
            'old_password' => 'Current Password',
            'zip' => 'Zip',
            'address' => 'Address',
            'cellphone' => 'Cellphone',
            'status' => 'Status',
            'tax_id' => 'tax_id',
            'fbId' => 'Facebook id ',
            'fb_profile_url' => 'Facebook Profile',
            'fb_dob' => 'Facebook DOB',
            'fb_email_address' => 'Facebook Email',
            'fb_current_city' => 'Facebook Current City',
            'fb_bio' => 'Facebook Bio',
            'secret_key' => 'Secret Key',
            'organization_id' => 'Organization',
        );
    }

    /**

     * Retrieves a list of models based on the current search/filter conditions.

     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.

     */
    public function search() {

        // Warning: Please modify the following code to remove attributes that
        // should not be searched.



        $criteria = new CDbCriteria;



        $criteria->compare('id', $this->id);

        $criteria->compare('location_id', $this->location_id, true);

        $criteria->compare('state_id', $this->state_id, true);

        $criteria->compare('fname', $this->fname, true);

        $criteria->compare('lname', $this->lname, true);

        $criteria->compare('email', $this->email, true);

        $criteria->compare('password', $this->password, true);

        $criteria->compare('zip', $this->zip, true);

        $criteria->compare('address', $this->address, true);

        $criteria->compare('cellphone', $this->cellphone, true);
        $criteria->compare('secret_key', $this->secret_key, true);
        $criteria->compare('status', $this->status, true);

        $criteria->compare('tax_id', $this->tax_id, true);
        if ($this->email == '') {
            $term = $this->fname;
            $this->fname = '';
            $criteria->condition = 'fname LIKE "%' . $term . '%" OR lname LIKE "%' . $term . '%" OR address LIKE "%' . $term . '%" OR zip LIKE "%' . $term . '%"' . ' OR cellphone LIKE "%' . $term . '%"';
        }
        $criteria->order = 'id DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**

     * after validation, encrypt the password

     */
    protected function afterValidate() {

        //keep the parent afterValidate function

        parent::afterValidate();

        if (!$this->hasErrors()) {
            $before = $this->password;
            $this->password = $this->encrypt($this->password);
        }
    }

    public function encrypt($value) {

        return md5($value);
    }

    public function getPosted() {
        //$tva = Transtn::model()->findByPK($id);
        $t = $this->id;
        $countpub = Yii::app()->db->createCommand('SELECT count(id) FROM tbl_product where user_id="' . $t . '"')->queryScalar();
        return $countpub;
    }

    public function getPurchase() {

        //$tva = Transtn::model()->findByPK($id);

        $t = $this->id;

        $countpub = Yii::app()->db->createCommand('SELECT  count(id) FROM tbl_user_purchase where user_id="' . $t . '"')->queryScalar();

        return $countpub;
    }
    public function beforeSave(){
            
            if($this->isNewRecord){
                $this->secret_key ='Password Not Update';
            }
            
            return parent::beforeSave();
        }
   

}

