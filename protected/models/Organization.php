<?php

/**
 * This is the model class for table "tbl_organization".
 *
 * The followings are the available columns in table 'tbl_organization':
 * @property integer $id
 * @property integer $location_id
 * @property string $name
 * @property string $status
 * @property string $address
 * @property string $phone
 * @property string $zipcode
 *
 * The followings are the available model relations:
 * @property Location $location
 * @property ProductOrganization[] $productOrganizations
 */
class Organization extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Organization the static model class
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
		return 'tbl_organization';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
//NOTE: you should only define rules for those attributes that will receive user inputs.array('location_id', 'numerical', 'integerOnly'=>true),
		return array(
		array('url, name, email, slogon, summary', 'required'),
		//array('adminemail', 'pattern'=>'/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/'),
		array('email','email','allowName'=>false,'enableClientValidation'=>true),
		array('url','url','enableClientValidation'=>true),
			array('name, email, slogon', 'length', 'max'=>90),
			array('summary', 'length', 'max'=>100),
			array('logo', 'file', 'types'=>'jpg, gif, png','maxSize'=>409600,'tooLarge'=>'The file was larger than 400K. Please upload a smaller file.'),
			array('email', 'authenticate'),
			array('detail', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			//array('id, location_id, name, status, address, phone, zipcode', 'safe', 'on'=>'search'),
			array('id, name, url, email, slogon, logo, summary, detail', 'safe', 'on'=>'search'),
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
			//'location' => array(self::BELONGS_TO, 'Location', 'location_id'),
			'user' => array(self::BELONGS_TO, 'User', 'email'),
			'products' => array(self::HAS_MANY, 'Product', 'organization_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			//'location_id' => 'Location',
			'name' => 'Name',
			'url' => 'Url',
			'email' => 'Email',
			'logo' => 'Logo',
			'slogon' => 'Slogon',
			'summary' => 'Summary',
			'detail' => 'Detail',
		
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
		//$criteria->compare('location_id',$this->location_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('slogon',$this->slogon,true);
		$criteria->compare('summary',$this->summary,true);
		$criteria->compare('detail',$this->detail,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function authenticate()
	{
	$cCriteria = new CDbCriteria();
	$cCriteria->select = '*';
	$cCriteria->condition = "(t.email != 'pledgeon@gmail.com')
AND (t.email = '$this->email')
AND (t.organization_id = 0) ";
    $cCriteria->order = 'id desc';
	
	 $data = User::model()->find($cCriteria);
		//echo $data->email;
	 if(empty($data->email))
		{
		 $this->addError($this->email,"Admin is not valid or already non-profit admin");
		}
		else
		{
		return $data->email;
		}
	}
	
	
	
	public function generatePassword($length=9, $strength=0) {
    $vowels = 'aeiou';
    $consonants = 'zxcvbnmsdfghjklqwrtyp';
    if ($strength >= 1) {
        $consonants .= 'ZXCVBNMSDFGHJKLQWRTYP';
    }
    if ($strength >= 2) {
        $vowels .= "AEIOU";
    }
    if ($strength >= 4) {
        $consonants .= '23456789';
    }
    if ($strength >= 8 ) {
        $vowels .= '@#$%';
    }
 
    $password = '';
    $alt = time() % 2;
    for ($i = 0; $i < $length; $i++) {
        if ($alt == 1) {
            $password .= $consonants[(rand() % strlen($consonants))];
            $alt = 0;
        } else {
            $password .= $vowels[(rand() % strlen($vowels))];
            $alt = 1;
        }
    }
    return $password;
	}
	
	
	public function updatepwd($pwd)
	{
	$model2=new User;
	$model2->password=$pwd;
	if($model2->save())
			{
			return true;
			}
			
	}
	
	function xmldisplay($q,$cat,$sat,$fromrec)
	{ // TODO: remove magic charity number
	$xmlstr =file_get_contents("http://www.charitynavigator.org/feeds/search7/?appid=". "100365167458" . "&keyword=".$q."&category=$cat&state=$sat&fromrec=$fromrec");
   $xml = new SimpleXMLElement($xmlstr);
    $_SESSION['torec']=$xml->attributes()->torec;
	 $_SESSION['fromrec']=$xml->attributes()->fromrec;

  foreach($xml->charity as $charity)
	{
	
	 $test.='<tr><td>'.$charity->charity_name.'</td>'; 
	 $test.='<tr><td>'.$charity->charity_name.'</td>'; 
 	  $test.='<td>'.$charity->state.'</td>'; 
	  $test.='<td>'.$charity->category.'</td>'; 
	 $test.='<td>'. $charity->cause.'</td>';  
	 $test.='<td>'.$charity->ein.'</td>'; 
	 $test.= '<td>'.$charity->tag_line.'</td></tr>'; 
   
	 } 
	 
 return $test;
 }

}
