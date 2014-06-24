<?php
class FPForm extends CFormModel
{
	public $email;

	public function rules()

	{

		return array(

			// username and password are required

			array('email', 'required'),
			array('email', 'email'),
			array('email', 'safe'),
            array('verifyCode', 'safe', 'on'=>'withCaptcha'),
            array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=> defined(YII_DEBUG) || !CCaptcha::checkRequirements(), 'on' => 'withCaptcha'),
		);

	}
public function attributeLabels()

	{

		return array(

			'email'=>'Email',

		);

	}

	public function authenticate($attribute,$params)

	{

		if(!$this->hasErrors())

		{

			$this->_identity=new UserIdentity($this->username,$this->password);

			if(!$this->_identity->authenticate())

				$this->addError('password','Incorrect username or password.');

		}

	}


}

