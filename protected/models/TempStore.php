<?php

/**
 * This is the model class for table "temp_store".
 *
 * The followings are the available columns in table 'temp_store':
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $website
 * @property string $address
 * @property string $zip
 * @property string $location_id
 * @property string $state_id
 * @property string $address2
 */
class TempStore extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return TempStore the static model class
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
		return 'temp_store';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('location_id, state_id', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('name, phone, website, zip', 'length', 'max'=>90),
			array('email, address, address2', 'length', 'max'=>255),
			array('email', 'unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, name, email, phone, website, address, zip, location_id, state_id, address2', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'name' => 'Name',
			'email' => 'Email',
			'phone' => 'Phone',
			'website' => 'Website',
			'address' => 'Address',
			'zip' => 'Zip',
			'location_id' => 'Location',
			'state_id' => 'State',
			'address2' => 'Address2',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('zip',$this->zip,true);
		$criteria->compare('location_id',$this->location_id, true);
		$criteria->compare('state_id',$this->state_id, true);
		$criteria->compare('address2',$this->address2,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}