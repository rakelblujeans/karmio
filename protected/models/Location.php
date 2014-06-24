<?php

/**
 * This is the model class for table "tbl_location".
 *
 * The followings are the available columns in table 'tbl_location':
 * @property integer $id
 * @property string $label
 * @property integer $parent
 * @property string $value
 *
 * The followings are the available model relations:
 * @property Organization[] $organizations
 * @property User[] $users
 * @property UserStore $userStore
 */
class Location extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Location the static model class
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
		return 'tbl_location';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('value', 'required'),
			array('parent', 'numerical', 'integerOnly'=>true),
			array('label', 'length', 'max'=>7),
			array('value', 'length', 'max'=>90),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, label, parent, value', 'safe', 'on'=>'search'),
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
			'organizations' => array(self::HAS_MANY, 'Organization', 'location_id'),
			'users' => array(self::HAS_MANY, 'User', 'location_id'),
			'products' => array(self::HAS_MANY, 'Product', 'location_id'),
			'products' => array(self::HAS_MANY, 'Product', 'state_id'),
			'userStore' => array(self::HAS_ONE, 'UserStore', 'id'),
		);
	}

	/**
	 * get states data
	 */
	public static function getStates($pid = 1)
	{
		$data = Location::model()->findALL('parent = :pId',
											array(':pId'=>$pid)
										);
		$data = CHtml::listData($data, 'id', 'value');
		return $data;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'label' => 'Label',
			'parent' => 'Parent',
			'value' => 'Value',
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
		$criteria->compare('label',$this->label,true);
		$criteria->compare('parent',$this->parent);
		$criteria->compare('value',$this->value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
