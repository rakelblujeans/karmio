<?php

 
class UserFriendsList extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return UserStore the static model class

     */
    public static function model($className = __CLASS__) {

        return parent::model($className);
    }

    /**

     * @return string the associated database table name



     */
    public function tableName() {
        return 'tbl_user_friendlist';
    }

    /**



     * @return array validation rules for model attributes.



     */
    public function rules() {



        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.



        return array(
            array('user_id', 'numerical', 'integerOnly' => true),
            array('friends_url', 'length', 'max' => 500),
           
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, friends_url', 'safe'),
        );
    }

    /**



     * @return array relational rules.



     */
    public function relations() {

        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }
    /**
     * @return array customized attribute labels (name=>label)



     */
    public function attributeLabels() 
            {



        return array(
            'id' => 'ID',
            'user_id' => 'User Id',
            'friends_url' => 'Facebook Friends',
        );
    }

    /**

     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.

     */
    public function search() {

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('friends_url', $this->friends_url, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}