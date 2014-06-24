<?php

/**
 * This is the model class for table "purchased_coupons".
 *
 * The followings are the available columns in table 'purchased_coupons':
 * @property integer $id
 * @property integer $purchase_id
 * @property integer $invoice_id
 * @property string $consumption_status
 * @property string $collection_date
 *
 * The followings are the available model relations:
 * @property TblUserPurchase $purchase
 */
class PurchasedCoupons extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PurchasedCoupons the static model class
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
		return 'tbl_purchased_coupons';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('purchase_id, invoice_id', 'required'),
			array('purchase_id, invoice_id', 'numerical', 'integerOnly'=>true),
			array('consumption_status', 'length', 'max'=>8),
			array('collection_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, purchase_id, invoice_id, consumption_status, collection_date', 'safe', 'on'=>'search'),
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
			'purchase' => array(self::BELONGS_TO, 'UserPurchase', 'purchase_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'purchase_id' => 'Purchase',
			'invoice_id' => 'Invoice',
			'consumption_status' => 'Consumption Status',
			'collection_date' => 'Collection Date',
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
		$criteria->compare('purchase_id',$this->purchase_id);
		$criteria->compare('invoice_id',$this->invoice_id);
		$criteria->compare('consumption_status',$this->consumption_status,true);
		$criteria->compare('collection_date',$this->collection_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}