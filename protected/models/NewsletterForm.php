<?php

/**
 * NewsletterForm class.
 * NewsletterForm is the data structure for keeping
 * newsletter subscription form data. It is used by the 'newsletter' action of 'SiteController'.
 */
class NewsletterForm extends CFormModel
{
	public $name;
	public $email;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// name and email are required
			array('email', 'required'),
                        // email field should be a valid email address
                        array('email', 'email'),
			//both name and email are safe for bulk assignment
			array('name, email', 'safe'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'name'=>'Name',
                        'email' => 'Email Address',
		);
	}
}
