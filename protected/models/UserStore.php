<?php



/**

 * This is the model class for table "tbl_user_store".

 *

 * The followings are the available columns in table 'tbl_user_store':

 * @property integer $id

 * @property integer $user_id

 * @property string $name
 * @property string $owner_name
 * @property string $email

 * @property string $phone

 * @property string $address

 * @property string $zip

 * @property string $location_id

 *

 * The followings are the available model relations:

 * @property ProductStore[] $productStores

 * @property Location $id0

 * @property User $user

 */

class UserStore extends CActiveRecord

{
	public $verifyCode;

	/**

	 * Returns the static model of the specified AR class.

	 * @return UserStore the static model class

	 */

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}



	/**

	 * @return string the associated database table name

	 */

	public function tableName()

	{

		return 'tbl_user_store';

	}



	/**

	 * @return array validation rules for model attributes.

	 */

	public function rules()

	{

		// NOTE: you should only define rules for those attributes that

		// will receive user inputs.

		return array(

			array('name, owner_name, email', 'required'),

			array('image_path', 'safe'),

			array('user_id', 'numerical', 'integerOnly'=>true),

			array('name, phone, zip', 'length', 'max'=>90),

			array('address2, website, email, street', 'length', 'max'=>255),
			array('email', 'unique'),
            array('email', 'email'),
			// The following rule is used by search().

			// Please remove those attributes that should not be searched.

			array('id, user_id, website, name, email,  phone, address, address2, zip, location_id,state_id, owner_name, contact_time, job_title', 'safe'),
			array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'captchaRequired'),

		);

	}



	/**

	 * @return array relational rules.

	 */

	public function relations()

	{

		// NOTE: you may need to adjust the relation name and the related

		// class name for the relations automatically generated below.

		return array(

			'productStores' => array(self::HAS_MANY, 'ProductStore', 'store_id'),

			//'location' => array(self::BELONGS_TO, 'Location', 'location_id'),

			//'state' => array(self::BELONGS_TO, 'Location', 'state_id'),

			'user' => array(self::BELONGS_TO, 'User', 'user_id'),

		);

	}



	/**

	 * user stores

	 */

	public static function getStores($cid = 0)

	{

		if ($cid == 0)

			$cid = Yii::app()->user->id;

		$data = self::model()->findAll('user_id = :cId',

										array(':cId'=>$cid)

									);

		$data = CHtml::listData($data, 'id', 'name');

		

		return $data;

	}



public function getStatename()

	{

		$x=0;

	$uid = Yii::app()->user->id;

	$LCriteria = new CDbCriteria();

	$LCriteria->condition = "id = '$this->user_id'";

	//$Ldata = User::model()->findAll($LCriteria);

	$Ldata = User::model()->findAll($LCriteria);



			$Ldata = CHtml::listData($Ldata, 'state_id', 'state_id');

			foreach($Ldata as $data)

			{

				//$_LIds .=', '.$data;

				$x = (int)$data;

				break;

			}

	$data = Location::model()->findByPk($x);

	

	return $data;

	}

	

	public function getCityname()

	{

		$x=0;

	$uid = Yii::app()->user->id;

	$LCriteria = new CDbCriteria();

	$LCriteria->condition = "id = '$this->user_id'";

	//$Ldata = User::model()->findAll($LCriteria);

	$Ldata = User::model()->findAll($LCriteria);



			$Ldata = CHtml::listData($Ldata, 'location_id', 'location_id');

			foreach($Ldata as $data)

			{

				//$_LIds .=', '.$data;

				$x = (int)$data;

				break;

			}

	$data = Location::model()->findByPk($x);

	

	return $data;

	}



	/**

	 * @return array customized attribute labels (name=>label)

	 */

	public function attributeLabels()

	{

		return array(

			'id' => 'ID',

			'user_id' => 'User',
			'name' => 'Business Name',
			'owner_name' => 'Your Name',
			'email' => 'Your Email Address',
			'phone' => 'Phone',
			'address' => 'Address',
			'address2' => 'Address2',
			'zip' => 'Zip',
			'location_id' => 'City',
			'state_id' => 'State',
			'website' => 'Business URL',
			'street' => 'Street',
			'is_verified' => 'Verified',
			'verifyCode' => 'Captcha Answer',

		);

	}



	/**

	 * Retrieves a list of models based on the current search/filter conditions.

	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.

	 */

	public function search()

	{

		// Warning: Please modify the following code to remove attributes that

		// should not be searched.



		$criteria=new CDbCriteria;



		$criteria->compare('id',$this->id);

		$criteria->compare('user_id',$this->user_id);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('phone',$this->phone,true);

		$criteria->compare('address',$this->address,true);

		$criteria->compare('address2',$this->address2,true);

		$criteria->compare('zip',$this->zip,true);

		$criteria->compare('location_id',$this->location_id, true);

		$criteria->compare('state_id',$this->state_id, true);

		$criteria->compare('website',$this->website,true);

		$criteria->compare('email',$this->email,true);
		
		$criteria->compare('street',$this->street,true);
		
		$criteria->compare('is_verified',$this->is_verified);
		$criteria->order  = 'id DESC';
		return new CActiveDataProvider($this, array(

			'criteria'=>$criteria,

		));

	}

}

