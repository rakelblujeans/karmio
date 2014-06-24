<?php

/**
 * This is the model class for table "tbl_states".
 *
 * The followings are the available columns in table 'tbl_states':
 * @property integer $id
 * @property integer $state_id
 * @property string $state_code
 * @property string $state_name
 * @property integer $orgcount
 * @property integer $isupdated
 */
class States extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return States the static model class
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
		return 'tbl_states';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('state_id, state_code, state_name, orgcount, isupdated', 'required'),
			array('state_id, orgcount, isupdated', 'numerical', 'integerOnly'=>true),
			array('state_code', 'length', 'max'=>5),
			array('state_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, state_id, state_code, state_name, orgcount, isupdated', 'safe', 'on'=>'search'),
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
			'state_id' => 'State',
			'state_code' => 'State Code',
			'state_name' => 'State Name',
			'orgcount' => 'Orgcount',
			'isupdated' => 'Isupdated',
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
		$criteria->compare('state_id',$this->state_id);
		$criteria->compare('state_code',$this->state_code,true);
		$criteria->compare('state_name',$this->state_name,true);
		$criteria->compare('orgcount',$this->orgcount);
		$criteria->compare('isupdated',$this->isupdated);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}