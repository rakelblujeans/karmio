<?php

/**
 * This is the model class for table "tbl_product_organization".
 *
 * The followings are the available columns in table 'tbl_product_organization':
 * @property integer $id
 * @property integer $product_id
 * @property integer $organization_id
 * @property double $amount_share
 * @property double $percentage_share
 *
 * The followings are the available model relations:
 * @property Product $product
 * @property Organization $organization
 */
class ProductOrganization extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ProductOrganization the static model class
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
		return 'tbl_product_organization';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('organization_id', 'required'),
			array('product_id, organization_id', 'numerical', 'integerOnly'=>true),
			array('amount_share, percentage_share', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_id, organization_id, amount_share, percentage_share', 'safe', 'on'=>'search'),
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
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'organization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),
		);
	}

	/**
	 * get organizaiton list
	 */
	public function getOrgList()
	{
		$data = Organization::model()->findALL('status = :pId',
											array(':pId'=>'active'));
		$data = CHtml::listData($data, 'id', 'name');
		return $data;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_id' => 'Product',
			'organization_id' => 'Organization',
			'amount_share' => 'Amount Share',
			'percentage_share' => 'Percentage Share',
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
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('organization_id',$this->organization_id);
		$criteria->compare('amount_share',$this->amount_share);
		$criteria->compare('percentage_share',$this->percentage_share);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
