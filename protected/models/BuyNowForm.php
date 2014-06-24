<?php

/**


 * BuyNowForm class.


 * BuyNowForm is the data structure for keeping


 * BuyNow form data. It is used by the 'BuyNow' action of 'SiteController'.


 */


class BuyNowForm extends CFormModel


{


	public $fname;


	public $lname;


	public $cnumber;


	public $edate;


	public $ccv;


	public $address;


	public $city;


	public $state;


	public $zipcode;


	public $country;


	public $pid;


	public $pqty;


	public $availableQuantity;


	public $emonth;


	public $eyear;
    public $phone_number;

 





	/**


	 * Declares the validation rules.


	 */


	public function rules()


	{


		return array(


			// name, email, subject and body are required


			array('fname, lname, emonth,eyear,cnumber, edate, ccv, address, city, state, zipcode, country, phone_number', 'required'),


			array('pid, pqty, availableQuantity', 'safe'),


			array('pqty', 'numerical', 'max'=>$this->availableQuantity),


		);


	}





	/**


	 * Declares customized attribute labels.


	 * If not declared here, an attribute would have a label that is


	 * the same as its name with the first letter in upper case.


	 */


	public function attributeLabels()


	{


		return array(


			'fname'=>'Card Holder First Name',


			'lname'=>'Card Holder Last Name',


			'cnumber'=>'Card Number',


			'edate'=>'Expiry Date',


			'ccv'=>'CCV',


			'address'=>'Street Address',


			'zipcode'=>'Zip Code',


			'pqty'=>'Quantity',


			'month'=>'Expiry Date',
			'phone_number' => 'Phone Number'


		);


	}


}


