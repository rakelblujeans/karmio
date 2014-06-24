<?php

/**
 * This is the model class for table "tbl_product_file".
 *
 * The followings are the available columns in table 'tbl_product_file':
 * @property integer $id
 * @property integer $product_id
 * @property string $type
 * @property string $file_name
 * @property string $file_ext
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class ProductFile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ProductFile the static model class
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
		return 'tbl_product_file';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, file_name', 'required'),
			array('product_id', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>8),
			array('file_name', 'length', 'max'=>90),
			array('file_ext', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_id, type, file_name, file_ext', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_id' => 'Product',
			'type' => 'Type',
			'file_name' => 'File Name',
			'file_ext' => 'File Ext',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('file_ext',$this->file_ext,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}