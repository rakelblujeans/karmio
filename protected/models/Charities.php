<?php

/**
 * This is the model class for table "tbl_charities".
 *
 * The followings are the available columns in table 'tbl_charities':
 * @property integer $id
 * @property string $name
 * @property string $owner_name
 * @property string $email
 * @property string $tag_line
 * @property string $state
 * @property integer $ein
 * @property integer $isupdated
 * @property string $city
 * @property string $cause
 * @property string $category
 * @property string $url
 * @property string $type
 *
 * The followings are the available model relations:
 * @property Product[] $products
 */
class Charities extends CActiveRecord
{
	public $verifyCode;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Charities the static model class
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
		return 'tbl_Charities';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, owner_name, email, ein', 'required'),
			array('isupdated', 'numerical', 'integerOnly'=>true),
			array('name, tag_line, cause, category, url, logo', 'length', 'max'=>255),
			array('state', 'length', 'max'=>20),
			array('city', 'length', 'max'=>50),
			array('type', 'length', 'max'=>7),
			//array('ein', 'numerical', 'integerOnly' => true),
			array('email', 'length', 'max'=>255),
			array('email', 'email'),
			array('owner_name', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, tag_line, state, ein, isupdated, city, cause, category, url, type, deleted', 'safe'),
			array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=> defined(YII_DEBUG) || !CCaptcha::checkRequirements()),
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
			'products' => array(self::HAS_MANY, 'Product', 'ein'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Charity Name',
			'owner_name' => 'Your Name',
			'email' => 'Your Email Address',
			'tag_line' => 'Tag Line',
			'state' => 'State',
			'ein' => 'Ein',
			'isupdated' => 'Isupdated',
			'city' => 'City',
			'cause' => 'Cause',
			'category' => 'Category',
			'url' => 'Url',
			'type' => 'Type',
			'logo' => 'Charity Logo',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('owner_name',$this->owner_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('tag_line',$this->tag_line,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('ein',$this->ein);
		$criteria->compare('isupdated',$this->isupdated);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('cause',$this->cause,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('deleted',$this->deleted);
		$criteria->condition = 'deleted=0';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}