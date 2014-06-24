<?php

/**
 * This is the model class for table "tbl_product".
 *
 * The followings are the available columns in table 'tbl_product':
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property string $name
 * @property string $description
 * @property double $price
 * @property string $status
 * @property string $expiry_date
 *
 * The followings are the available model relations:
 * @property Category $category
 * @property User $user
 * @property ProductFile[] $productFiles
 * @property ProductOrganization[] $productOrganizations
 * @property ProductStore[] $productStores
 * @property UserPurchase[] $userPurchases
 */
class Product extends CActiveRecord
{
	public $storeArray;	// need to get list of stores selected
	public $pType;
	public $pVal;
	public $oName;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Product the static model class
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
		return 'tbl_product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, category_id, name, price, pVal, organization_id, regular_price, coupons', 'required'),
			array('user_id, category_id, coupons', 'numerical', 'integerOnly'=>true),
			array('price regular_price', 'numerical'),
			array('name', 'length', 'max'=>90),
			array('status', 'length', 'max'=>20),
			array('description, fine_print, publish_date, expiry_date, pType, pVal, organization_id, amount_share, percentage_share, oName', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, category_id, name, description, price, status, expiry_date', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'productOrganization' => array(self::BELONGS_TO, 'Organization', 'organization_id'),
			'productStores' => array(self::HAS_MANY, 'ProductStore', 'product_id'),
			'userPurchases' => array(self::HAS_MANY, 'UserPurchase', 'product_id'),
		);
	}

	/**
	 * get category data
	 */
	public function getCategorys($pid = 0)
	{
		$data = Category::model()->findALL('parent = :pId',
											array(':pId'=>$pid)
										);
		$data = CHtml::listData($data, 'id', 'value');
		return $data;
	}

	/**
	 * get username
	 */
	public function getUserName($pid = 0)
	{
		if($pid == 0)
			$pid = $this->user_id;

		$data = User::model()->findByPk($pid);
		$data = $data->fname.' '.$data->lname;
		return $data;
	}

	/**
	 * get category name
	 */
	public function getCatText($pid = 0)
	{
		if($pid == 0)
			$pid = $this->category_id;

		$data = Category::model()->findByPk($pid);
		$data = $data->value;
		return $data;
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
	 * get organization info
	 */
	public function getOrgInfo()
	{
		$data = Organization::model()->findByPk($this->organization_id);
		return $data;
	}
	public function getOrgInfo2($id)
	{
		$data = Organization::model()->findByPk($id);
		return $data;
	}

	/**
	 * get store info
	 */
	public function getStoreInfo()
	{
		//$data = ProductStore::model()->findByPk($this->id);
			//Getting store ids
			$LCriteria = new CDbCriteria();
			$LCriteria->condition = "product_id = '$this->id'";
			$Ldata = ProductStore::model()->findAll($LCriteria);

			$Ldata = CHtml::listData($Ldata, 'store_id', 'store_id');
			foreach($Ldata as $data)
			{
				//$_LIds .=', '.$data;
				$x = (int)$data;
				break;
			}
		$data = UserStore::model()->findByPk($x);
		return $data;
	}
	public function getShareList($uid)
	{
		
	$criteria = new CDbCriteria;
    $criteria->select = 'l.* , org.logo';
    $criteria->alias = 'l';
    $criteria->join = 'join tbl_user u on (l.user_id = u.id ) and (l.organization_id = u.organization_id) left join tbl_organization org on (l.organization_id = org.id )';
	$criteria->condition = "(l.status = 'sold_out' or l.status = 'ended') and (l.user_id = $uid) ";
    $criteria->order = 'l.id desc';
    $data = Product::model()->findAll($criteria);
		return $data;
	}
	/**
	 * raiseToDate
	 */
	public function raiseToDate()
	{
		$x = 0;
		$myCriteria = new CDbCriteria();
		//$myCriteria->select = 'SUM(paid_price) AS sum';
		$myCriteria->condition = "product_id = '$this->id'";

		$data = UserPurchase::model()->findAll($myCriteria);
		$data = CHtml::listData($data, 'donated', 'donated');
		//var_dum($data);
	
		foreach($data as $rec)
		{
			$x += $rec;
		}	

		return $x;
	}
	
	/**
	 * Return array for seller, this product is sold how many times and all
	 */
	public function overAllSale()
	{
		//Number of times sold
		//gross income -> total paid
		//net income -> profit
		//pledge
		$x = 0;
		$myCriteria = new CDbCriteria();
		$myCriteria->select = 'SUM(paid_price) AS paid_price'
							.', SUM(donated) AS donated'
							.', SUM(quantity) AS quantity';
		$myCriteria->condition = "product_id = '$this->id'";
		$data = UserPurchase::model()->findAll($myCriteria);
		
		foreach($data as $datum)
		{
			;
		}
		//echo '<pre>';
		//var_dump($data);exit();
/*
		$data = CHtml::listData($data, 'donated', 'donated');
		//var_dum($data);
	
		foreach($data as $rec)
		{
			$x += $rec;
		}	

*/
		//if no record found
		if($datum->quantity == null)
		{
			$datum->paid_price = 0;
			$datum->donated = 0;
			$datum->quantity = 0;
		}
		return $datum;
	}

	/**
	 * @return remaining time to buy deal
	 */
	public function remainingTime()
	{
		$rem = strtotime($this->expiry_date) - time();

		$secs = $mins = $hrs = $days = '';
		
		if($rem > 59)
		{
			$mins = $rem / 60;
			$mins = (int) $mins;
			$secs = $rem-($mins*60);
		}
		if($mins > 59)
		{
			$hrs = $mins/60;
			$hrs = (int) $hrs;
			$mins = $mins-($hrs*60);
		}
		if($hrs > 23)
		{
			$days = $hrs/24;
			$days = (int) $days;
			$hrs = $hrs-((int)$days*24);
		}

		$remTime = '';
		$remTime .= ($days != '')? $days.'d ':'';
		$remTime .= ($hrs != '')? $hrs.'h ':'';
		$remTime .= ($mins != '')? $mins.'m ':'';
		$remTime .= ($secs != '')? $secs.'s ':'Expired';

		return $remTime;
	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'category_id' => 'Sub Category',
			'name' => 'Title',
			'description' => 'Description',
			'fine_print' => 'Fine Print',
			'price' => 'Price',
			'status' => 'Status',
			'publish_date' => 'Publish Date',
			'expiry_date' => 'Expiry Date',
			'coupons'	=> 'Coupons',
			'pVal' => 'Pledge Amount',
			'organization_id' => 'Organization',
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
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('expiry_date',$this->expiry_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function generatePDF()
	{

	//$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
      //                      'P', 'cm', 'A4', true, 'UTF-8');
	  require_once('protected/extensions/tcpdf/config/lang/eng.php');
	require_once('protected/extensions/tcpdf/tcpdf.php');

// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor("Nicola Asuni");
	$pdf->SetTitle("TCPDF Example 002");
	$pdf->SetSubject("TCPDF Tutorial");
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont("times", "BI", 20);
	$pdf->Cell(0,10,"Example 002",1,1,'C');
	$dat = $pdf->Output("example_002.pdf", "I");
	return $dat;
	}
}
