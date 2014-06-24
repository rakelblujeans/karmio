<?php

/**
 * This is the model class for table "tbl_resource_monitor".
 *
 * The followings are the available columns in table 'tbl_resource_monitor':
 * @property integer $id
 * @property string $table_name
 * @property integer $tbl_pkey
 * @property integer $tbl_pkey_val
 * @property string $creation_date
 * @property string $modification_date
 * @property integer $created_by
 * @property integer $modified_by
 */
class ResourceMonitor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ResourceMonitor the static model class
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
		return 'tbl_resource_monitor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('table_name, tbl_pkey, tbl_pkey_val, creation_date, modification_date, created_by, modified_by', 'required'),
			array('tbl_pkey, tbl_pkey_val, created_by, modified_by', 'numerical', 'integerOnly'=>true),
			array('table_name', 'length', 'max'=>90),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, table_name, tbl_pkey, tbl_pkey_val, creation_date, modification_date, created_by, modified_by', 'safe', 'on'=>'search'),
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
			'table_name' => 'Table Name',
			'tbl_pkey' => 'Tbl Pkey',
			'tbl_pkey_val' => 'Tbl Pkey Val',
			'creation_date' => 'Creation Date',
			'modification_date' => 'Modification Date',
			'created_by' => 'Created By',
			'modified_by' => 'Modified By',
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
		$criteria->compare('table_name',$this->table_name,true);
		$criteria->compare('tbl_pkey',$this->tbl_pkey);
		$criteria->compare('tbl_pkey_val',$this->tbl_pkey_val);
		$criteria->compare('creation_date',$this->creation_date,true);
		$criteria->compare('modification_date',$this->modification_date,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('modified_by',$this->modified_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}