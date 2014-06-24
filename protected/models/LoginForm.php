<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;
	public $fbId;
	
	public $verifyCode;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
			//fb id is safe, as its not necessary we get it every time
			array('fbId', 'safe'),
			array('verifyCode', 'safe', 'on'=>'withCaptcha'),
			array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=> defined(YII_DEBUG) || !CCaptcha::checkRequirements(), 'on' => 'withCaptcha'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate()) {
				$this->addError('password','Incorrect username or password.');
            }
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login($x = 0)
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->fbId=$this->fbId;
			$this->_identity->authenticate($x);
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			//User::model()->updateByPk($this->_identity->id, array('last_login_time'=> new CDbExpression('Now()')));
			return true;
		}
		else
			return false;
	}
	
	public function login2($x = 0)
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->fbId=$this->fbId;
			$this->_identity->authenticate2($x);
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			//User::model()->updateByPk($this->_identity->id, array('last_login_time'=> new CDbExpression('Now()')));
			return true;
		}
		else
			return false;
	}
}
