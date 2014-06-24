<?php



/**
 * This is the model class for table "tbl_user_purchase".
 *
 * The followings are the available columns in table 'tbl_user_purchase':
 * @property integer $id
 * @property integer $product_id
 * @property integer $user_id
 * @property integer $store_id
 * @property string $invoice_id
 * @property string $transaction_method
 * @property string $transaction_id
* @property string $transaction_status
 * @property string $consumption_status
 * @property string $expiry_date
 * @property string $collection_date
 * @property double $paid_price
 * @property double $donated
 * @property integer $quantity
 *
 * The followings are the available model relations:
* @property Product $product
 * @property UserStore $store
 * @property User $user
 */
class UserPurchase extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserPurchase the static model class
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
		return 'tbl_user_purchase';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, invoice_id, quantity', 'required'),
			array('product_id, user_id, store_id, quantity', 'numerical', 'integerOnly'=>true),
			array('paid_price, donated', 'numerical'),
			array('invoice_id, transaction_id', 'length', 'max'=>90),
			array('transaction_method', 'length', 'max'=>6),
			array('transaction_status', 'length', 'max'=>10),
			array('consumption_status', 'length', 'max'=>8),
			array('expiry_date, collection_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_id, user_id, nfg_chargid, store_id, invoice_id, transaction_method, transaction_id, transaction_status, consumption_status, expiry_date, collection_date, paid_price, donated, quantity', 'safe', 'on'=>'search'),
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
			'store' => array(self::BELONGS_TO, 'UserStore', 'store_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'charity' => array(self::BELONGS_TO, 'Charities', 'ein'),
			'purchasedCoupons' => array(self::HAS_MANY, 'PurchasedCoupons', 'purchase_id'),
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
			'user_id' => 'User',
            'store_id' => 'Store',
			'invoice_id' => 'Invoice',
			'transaction_method' => 'Transaction Method',
			'transaction_id' => 'Transaction',
			'transaction_status' => 'Transaction Status',
			'consumption_status' => 'Consumption Status',
			'expiry_date' => 'Expiry Date',
			'collection_date' => 'Collection Date',
			'paid_price' => 'Paid Price',
			'donated' => 'Donated',
			'quantity' => 'Quantity',
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
		//$criteria->compare('product_id',$this->product_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('store_id',$this->store_id);
		$criteria->compare('invoice_id',$this->invoice_id,true);
		$criteria->compare('transaction_method',$this->transaction_method,true);
	$criteria->compare('transaction_id',$this->transaction_id,true);
		$criteria->compare('transaction_status',$this->transaction_status,true);
		$criteria->compare('consumption_status',$this->consumption_status,true);
		$criteria->compare('expiry_date',$this->expiry_date,true);
	$criteria->compare('collection_date',$this->collection_date,true);
		$criteria->compare('paid_price',$this->paid_price);
		$criteria->compare('donated',$this->donated);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('product.couponcode',$this->product_id,true);  
            $criteria->with='product'; 
		
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			 'pagination'=>array(
             'pageSize'=>20
       ),

        //'sort'=>$sort,

	));
	}
	
	public function getcard() {
	//$tva = Transtn::model()->findByPK($id);

	$t=$this->user_id;
	$countpub=Yii::app()->db->createCommand('SELECT cnumber FROM tbl_transactions_details where user_id="'.$t.'"')->queryScalar();
	$countpub = Product::model()->decryptStringArray($countpub);
	return $countpub;
	}
}
