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
 * @property string $twitter_text
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
	public $verifyCode;
	public $storeArray;	// need to get list of stores selected
	public $pType;
	public $pVal;
	public $oName;
	public $agree;
	public $discount_percentage;
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
			array('user_id,redeming_date_start, redeming_date_end oName, name,fine_print, description, agree, amount_share, regular_price, coupons', 'required'),

			array('agree', 'required', 'requiredValue' => 1, 'message' => 'You should accept terms and conditions'),
			array('user_id, category_id, coupons,zip', 'numerical', 'integerOnly'=>true),
			array('price, regular_price, admin_share', 'numerical'),
			 array('price', 'compareDateRange', 'type' => 'numerical', 'message' => '{attribute}:'),
			 array('amount_share', 'numerical', 'min'=>10),
			 array('amount_share', 'comparePledged','type' => 'numerical', 'message' => '{attribute}:'),
			array('name', 'length', 'max'=>500),
			array('fine_print', 'length', 'max'=>500),
			array('status', 'length', 'max'=>20),
			array('description, twitter_text, facebook_text, fine_print,address,location_id,state_id, publish_date,end_date, expiry_date,  organization_id, amount_share, percentage_share', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, ein, oName, category_id, name, description,admin_share,couponcode,zip, price, end_date,status, expiry_date, ipaddres', 'safe', 'on'=>'search'),

		);

	}



	/**

	 * @return array relational rules.

	 */

	public function relations()

	{

		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'productStores' => array(self::HAS_MANY, 'ProductStore', 'product_id'),
			'userPurchases' => array(self::HAS_MANY, 'UserPurchase', 'product_id'),
			'charity' => array(self::BELONGS_TO, 'Charities', 'ein'),
);

	}
	public function afterFind()
	{
		$st_name = $this->name;
		$ps = ProductStore::model()->find('product_id='.$this->id);	
		if(count($ps))
		{
			$store = UserStore::model()->findByPk($ps->store_id);
			if(count($store))
			$st_name = $store->name;
		}
		$this->name = $st_name;
		 parent::afterFind();
	}
	public function userCharity($upid)
	{
		//echo $upid; exit;
		$up = UserPurchase::model()->findByPk($upid);
		//echo $up->
		$charity = Charities::model()->find('ein='.$up->ein);
		return $charity->name;
	}


	/**

	 * get category data

	 */

	

	public function comparepledge($attribute,$params) {

		if(!empty($this->attributes['pVal'])) {

		if($this->attributes['pType']=='amount') {

			if($this->attributes['pVal'] < '10') {

				$this->addError($attribute,'Pledge amount should be equal or greater than $10');

			}

		}

		if($this->attributes['pType']=='percent') {

			$percentage=($this->attributes['price'] * $this->attributes['pVal'] / 100);

			if($percentage < '10') {

				$this->addError($attribute,'Pledge amount should be equal or greater than $10');

			}

		}

	}

	}

	

	public function compareDateRange($attribute,$params) {

		if(!empty($this->attributes['price'])) {
			$disc = $this->attributes['regular_price']*$this->attributes['price']/100;
			if($disc > $this->attributes['regular_price']) {

				$this->addError($attribute,'Discount price should be lower than original price');

			}

		}

	}

	

	

	

	public function comparePledged($attribute,$params) {

		if(!empty($this->attributes['price'])) {
		 $disc = $this->attributes['regular_price'] - (($this->attributes['regular_price']*$this->attributes['price'])/100);
	
			if($this->attributes['amount_share'] > $disc) {

				$this->addError($attribute,'Charity amount should be lower than discounted price');

			}

		}

		if(empty($this->attributes['price']) && !empty($this->attributes['regular_price'])) {

			if($this->attributes['amount_share'] > $this->attributes['regular_price']) {

				$this->addError($attribute,'This price should be lower than original price');

			}

		}

	}

	

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

	 

	  public function getProStatename()
	{
	$data = Location::model()->findALL('id = :id',
							array(':id'=>'$this->state_id'));

		$data = CHtml::listData($data, 'id', 'value');

		return $data;

	

	}

	

	 public function getStatename()

	{

		$x=0;

	$uid = Yii::app()->user->id;

	$LCriteria = new CDbCriteria();

	$LCriteria->condition = "id = '$this->user_id'";

	//$Ldata = User::model()->findAll($LCriteria);

	$Ldata = User::model()->find($LCriteria);
	if(count($Ldata))
	return $Ldata->state_id;
	else return '';

/*
			$Ldata = CHtml::listData($Ldata, 'state_id', 'state_id');
			foreach($Ldata as $data)
			{
				//$_LIds .=', '.$data;
				$x = (int)$data;
				break;
			}
	$data = Location::model()->findByPk($x);
	return $data;*/

	}

	

	public function getCityname()

	{

		$x=0;

	$uid = Yii::app()->user->id;

	$LCriteria = new CDbCriteria();

	$LCriteria->condition = "id = '$this->user_id'";

	//$Ldata = User::model()->findAll($LCriteria);

	$Ldata = User::model()->find($LCriteria);
	if($Ldata)
	return $Ldata->location_id;
	else return '';

			/*$Ldata = CHtml::listData($Ldata, 'location_id', 'location_id');

			foreach($Ldata as $data)

			{

				//$_LIds .=', '.$data;

				$x = (int)$data;

				break;

			}

	$data = Location::model()->findByPk($x);

	

	return $data;*/

	}

	 

	 

	public function getUserName($pid = 0)

	{

		if($pid == 0)

			$pid = $this->user_id;



		$data = User::model()->findByPk($pid);

		$data = $data->fname.' '.$data->lname;

		return $data;

	}

	

	public function overAllSaleCheckin()

	{

		//Number of times sold

		//gross income -> total paid

		//net income -> profit

		//pledge

		//$x = 0;

		$myCriteria = new CDbCriteria();

		$myCriteria->select = 'count(consumption_status) AS consumption_status';

		$myCriteria->condition = "product_id = '$this->id' and 	consumption_status='consumed'";

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

		if($datum->consumption_status == null)

		{

			$datum->consumption_status = 0;

		}

		return $datum;

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

	

	public function getGiftqunt($pid)

	{			

		$val=0;

		$uid = Yii::app()->user->id;

		$myCriteria = new CDbCriteria();

		$myCriteria->condition = "user_id =$uid and product_id=$pid";

		$Ldata = UserPurchase::model()->findAll($myCriteria);

		$Ldata = CHtml::listData($Ldata, 'id', 'id');

			foreach($Ldata as $data)

			{

				//$_LIds .=', '.$data;

				$val = (int)$data;

				break;

			}

		$data = UserPurchase::model()->findByPk($val);

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

			$val=0;
			$LCriteria = new CDbCriteria();
			$LCriteria->condition = "product_id = '$this->id'";
			$Ldata = ProductStore::model()->findAll($LCriteria);
			$Ldata = CHtml::listData($Ldata, 'store_id', 'store_id');
			foreach($Ldata as $data)
			{
				//$_LIds .=', '.$data;
				$val = (int)$data;
				break;
			}
		$data = UserStore::model()->findByPk($val);
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

		$x = '';

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

	

	public function getUserTax()

	{

		$x=0;

	$uid = Yii::app()->user->id;

	$LCriteria = new CDbCriteria();

	$LCriteria->condition = "user_id = '$this->user_id'";

	//$Ldata = User::model()->findAll($LCriteria);

	$Ldata = Product::model()->findAll($LCriteria);



			$Ldata = CHtml::listData($Ldata, 'user_id', 'user_id');

			foreach($Ldata as $data)

			{

				//$_LIds .=', '.$data;

				$x = (int)$data;

				break;

			}

	$data = User::model()->findByPk($x);

	

	return $data;

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
	 public function getSoldCoupons()
	 {
		 $recs = CHtml::listData(UserPurchase::model()->findAll('product_id='.$this->id), 'id', 'id');
		 if(count($recs))
		 {
		 $ids = implode(',', $recs);
		 $recs  = PurchasedCoupons::model()->findAll('purchase_id IN('.$ids.')');
		 }
		 return count($recs);
	 }
	  public function getCheckedCoupons()
	 {
		 $recs = CHtml::listData(UserPurchase::model()->findAll('product_id='.$this->id), 'id', 'id');
		  if(count($recs))
		 {
		 $ids = implode(',', $recs);
		 $recs  = PurchasedCoupons::model()->findAll('purchase_id IN('.$ids.')  AND consumption_status="consumed"');
		 }
		 return count($recs);
	 }
	public function remainingDays()
	{
		$exp=$this->end_date;
		$newdate = strtotime ( ( $exp ) ) ;
		$newdate = date ( 'Y-m-d' , $newdate );
		$rem = strtotime($newdate) - time();
		$secs = $mins = $hrs = $days = 0;
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

		

		return $days;
	}
	public function remainingTime()
	{
	  //$newdate = strtotime ( '+1 day' , strtotime ( $exp ) ) ;
	  $exp=$this->expiry_date;
		$newdate = strtotime ( ( $exp ) ) ;
		$newdate = date ( 'Y-m-d' , $newdate );
		$rem = strtotime($newdate) - time();
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
		$remTime .= ($days != '')? $days.' days  ':'';
		if($remTime == '')
		$remTime .= ($hrs != '')? $hrs.' hours ':'';
		if($remTime == '')$remTime .= ($mins != '')? $mins.' minutes ':'';
		if($remTime == '')$remTime .= ($secs != '')? $secs.' seconds ':'Expired';

		return $remTime;
	}
	
	public function dateDiff($start, $end) {



$start_ts = strtotime($start);



$end_ts = strtotime($end);



$diff = $end_ts - $start_ts;



return round($diff / 86400);



}







	/**

	 * @return array customized attribute labels (name=>label)

	 */

	public function attributeLabels()

	{

		return array(

			'id' => 'ID',
			'user_id' => 'User',
			'amount_share' => 'Charity',
			'ein' => 'Non-profit Organization',
			'category_id' => 'Sub Category',
			'name' => 'Title',
			'description' => 'Description',
			'twitter_text' => 'Twitter Text',
			'facebook_text' => 'Facebook Text',
			'fine_print' => 'Fine Print',
			'price' => 'Price',
			'regular_price' => 'Original Price',
			'status' => 'Status',
			'publish_date' => 'Publish Date',
			'expiry_date' => 'Expiry Date',
			'coupons'	=> 'Coupons',
			'pVal' => 'Pledge Amount',
			'oName' => 'Non-profit Organization',
			'Address' => 'Store Address',
			'location' => 'Location',
			'verifyCode'=>'Verification Code',
			'end_date'=>"End date",
			'agree'=>"Agreement",
			'redeming_date_start' => 'Redeming Start Date',
			'redeming_date_end' => 'Redeming End Date'
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
		
		$criteria->compare('twitter_text',$this->twitter_text,true);
		$criteria->compare('facebook_text', $this->facebook_text, true);
		$criteria->compare('price',$this->price);

		$criteria->compare('status',$this->status,true);

		$criteria->compare('expiry_date',$this->expiry_date,true);

		$criteria->compare('ein',$this->ein,true);

		$criteria->compare('oName',$this->oName,true);

		$criteria->compare('address',$this->address,true);

		$criteria->compare('location_id',$this->location_id,true);

		return new CActiveDataProvider($this, array(

			'criteria'=>$criteria,

		));

	}

	public function generatePDF()

	{ob_clean() ;

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

	



	public function generatecode($trans,$proid)
	{
		$x = substr($proid,0,2) . substr(strtoupper(mt_rand()),0,2) . substr(time(),3,2);
        //print_r("\nX:[". $x ."]");
		$myCriteria = new CDbCriteria();
		$myCriteria->condition = "invoice_id = '$x'";
		$ups = PurchasedCoupons::model()->findAll($myCriteria);
		$t=$trans;
		$id=$proid;
		if(empty($ups) || $ups=null)
		{
	    	return $x;
		}
		else
		{
    		$this->generatecode($t,$id);
		}
	}

	

	public function encryptStringArray($stringArray, $key = "Karmio") {

 $s = strtr(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), serialize($stringArray), MCRYPT_MODE_CBC, md5(md5($key)))), '+/=', '-_,');

 return $s;

}



public function decryptStringArray($stringArray, $key = "Karmio") {

 $s = unserialize(rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode(strtr($stringArray, '-_,', '+/=')), MCRYPT_MODE_CBC, md5(md5($key))), "\0"));

 return $s;

}



	public function generatepubcode($nm)

	{

		$x=  ucfirst(substr($nm,0,1)). substr(time(),0,3). substr(strtoupper(mt_rand()),0,4);

		$myCriteria = new CDbCriteria();

		$myCriteria->condition = "couponcode = '$x'";

		$ups = Product::model()->findAll($myCriteria);

		$xx=$nm;

		if(empty($ups))

		{

			return $x;

		}

		else

		{

			$this->generatepubcode($nm);

		}

	}

	

	

	

	public	function generate_resized_image($name,$tmp,$size){

$max_dimension = 800; // Max new width or height, can not exceed this value.

$dir = "images/orgLogos/"; // Directory to save resized image. (Include a trailing slash - /)

// Collect the post variables.

$postvars = array(

"image"    => trim($name),

"image_tmp"    => $tmp,

"image_size"    => (int)$size,

"image_max_width"    => (int)334,

"image_max_height"   => (int)198

);

// Array of valid extensions.

$valid_exts = array("jpg","jpeg","gif","png");

// Select the extension from the file.

$ext = end(explode(".",strtolower(trim($name))));

// Check not larger than 175kb.

if($postvars["image_size"] <= 4000000){

// Check is valid extension.

if(in_array($ext,$valid_exts)){

if($ext == "jpg" || $ext == "jpeg"){

$image = imagecreatefromjpeg($postvars["image_tmp"]);

}

else if($ext == "gif"){

$image = imagecreatefromgif($postvars["image_tmp"]);

}

else if($ext == "png"){

$image = imagecreatefrompng($postvars["image_tmp"]);

}

// Grab the width and height of the image.

list($width,$height) = getimagesize($postvars["image_tmp"]);

// If the max width input is greater than max height we base the new image off of that, otherwise we

// use the max height input.

// We get the other dimension by multiplying the quotient of the new width or height divided by

// the old width or height.

if($postvars["image_max_width"] > $postvars["image_max_height"]){

if($postvars["image_max_width"] > $max_dimension){

$newwidth = $max_dimension;

} else {

$newwidth = $postvars["image_max_width"];

}

$newheight = ($newwidth / $width) * $height;

} else {

if($postvars["image_max_height"] > $max_dimension){

$newheight = $max_dimension;

} else {

$newheight = $postvars["image_max_height"];

}

$newwidth = ($newheight / $height) * $width;

}

// Create temporary image file.

$tmp = imagecreatetruecolor($newwidth,$newheight);

// Copy the image to one with the new width and height.

imagecopyresampled($tmp,$image,0,0,0,0,$newwidth,$newheight,$width,$height);

// Create random 4 digit number for filename.

$rand = rand(1000,9999);

$filename = $dir.$rand.$postvars["image"];

//chmod('images/orgLogos/'.$filename,0777);

// Create image file with 100% quality.

imagejpeg($tmp,$filename,100);

return $filename;

imagedestroy($image);

imagedestroy($tmp);

}/* else {

return "File size too large. Max allowed file size is 175kb.";

}*/

} /*else {

return "Invalid file type. You must upload an image file. (jpg, jpeg, gif, png).";

}*/

}

	

	

}

