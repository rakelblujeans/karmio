<?php

/**
 * This is the model class for table "transactions_details".
 *
 * The followings are the available columns in table 'transactions_details':
 * @property integer $id
 * @property integer $user_id
 * @property string $fname
 * @property string $lname
 * @property string $cnumber
 * @property string $ccv
 * @property string $edate
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zipcode
 * @property string $country
 */
class TransactionsDetails extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return TransactionsDetails the static model class
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
        return 'tbl_transactions_details';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, fname, lname, cnumber, ccv, edate, address, city, state, zipcode, country', 'required'),
            array('user_id, zipcode', 'numerical', 'integerOnly'=>true),
            array('fname, lname, city, state, country', 'length', 'max'=>90),
            array('address', 'length', 'max'=>255),
            array('zipcode', 'length', 'max'=>5),
            //array('cnumber, ccv, edate', 'unique'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, fname, lname, cnumber, ccv, edate, address, city, state, zipcode, country', 'safe', 'on'=>'search'),
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
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'cnumber' => 'Credit Card Num',
            'ccv' => 'CCV',
            'edate' => 'Expiration Date',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'zipcode' => 'Zipcode',
            'country' => 'Country',
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
        $criteria->compare('fname',$this->fname,true);
        $criteria->compare('lname',$this->lname,true);
        $criteria->compare('cnumber',$this->cnumber,true);
        $criteria->compare('ccv',$this->ccv,true);
        $criteria->compare('edate',$this->edate,true);
        $criteria->compare('address',$this->address,true);
        $criteria->compare('city',$this->city, true);
        $criteria->compare('state',$this->state, true);
        $criteria->compare('zipcode',$this->zipcode,true);
        $criteria->compare('country',$this->country,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}