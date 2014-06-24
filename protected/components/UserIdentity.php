<?php
/** * UserIdentity represents the data needed to identity a user. * It contains the authentication method that checks if the provided * data can identity the user. */


class UserIdentity extends CUserIdentity{	public $fbId;

	/**	 * Authenticates a user.	 * The example implementation makes sure if the username and password	 * are both 'demo'.	 * In practical applications, this should be changed to authenticate	 * against some persistent user identity storage (e.g. database).	 * @return boolean whether authentication succeeds.	 */	
	
	public function authenticate($x = 0)
	{
		if($x == 0)
		{
			$user = User::model()->findByAttributes(array('email' => $this->username));	
			$this->setState('fbID', 0);
		}
		else
		{
			$user = User::model()->findByAttributes(array('fbId' => $this->username));
			$this->setState('myName', $user->fname.' '.$user->lname);    
			$this->setState('id', $user->id);	
			$this->setState('fbID', $user->fbId);
		}
		if($user === null)
		{	/*//No such user registered.*/
			$this->errorCode=self::ERROR_USERNAME_INVALID;	
		}
		else
		{
			//echo $this->username.'= '.$this->getState('myName'); exit;
			if(($user->password != $user->encrypt($this->password))&& $x==0)
			{	
				/*	//Invalid password*/
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			}
			else
			{
				$this->setState('id', $user->id);
				$this->setState('email', $user->email);
				$this->setState('myName', $user->fname.' '.$user->lname);
				$status=User::model()->findAllByAttributes(array('id'=>$user->id, 'status'=>'active'));
				if($status != null)
				{			/*	//Set parameters for buyer		*/	
				$buyer = UserRole::model()->findAllByAttributes(array('user_id'=>$user->id, 'value'=>'buyer'));
				if($buyer != null)
				{
					$url = CHtml::normalizeUrl(array('/user/buyersDashboard'));
					$this->setState('myDash', $url);
					$this->setState('isBuyer', true);
				}	
				/*	//Set parameters for seller	*/	
				$seller = UserRole::model()->findAllByAttributes(array('user_id'=>$user->id, 'value'=>'seller'));	
				if($seller != null)	
				{	
				$url = CHtml::normalizeUrl(array('/seller'));
				$this->setState('myDash', $url);
				$this->setState('isSeller', true);	
				/*	//Yii::app()->user->setReturnUrl($url);*/
				}
				/*	//Set parameters for admin		*/
				$admin = UserRole::model()->findAllByAttributes(array('user_id'=>$user->id, 'value'=>'admin'));
				if($admin != null)
				{				/*	//set him as admin.*/	
				$this->username = 'admin';
				$url = CHtml::normalizeUrl(array('/seller/dashboard'));	
				$this->setState('myDash', $url);
				$this->setState('isAdmin', true);
				/*//Yii::app()->user->setReturnUrl($url);*/	
				}
				$nonprofit = UserRole::model()->findAllByAttributes(array('user_id'=>$user->id, 'value'=>'nonprofitadmin'));
				if($nonprofit != null)
				{	
				/*//set him as admin.*/	
				 $url = CHtml::normalizeUrl(array('/seller'));	
				 $this->setState('myDash', $url);
				 $this->setState('isNonprofit', true);	
				 /*//Yii::app()->user->setReturnUrl($url);*/
				 }
				 /* Last login time, make changes here in future.*/
				 /*	if(null===$user->last_login_time)
				 $lastLogin = time();
				 else	
				 {	
				 	$lastLogin = strtotime($user->last_login_time);	
				 }	
				 $this->setState('lastLoginTime', $lastLogin);
				 $user->last_login_time = date('Y-m-d H:i:s');	
				 */	
				 $this->errorCode=self::ERROR_NONE; 
				 }
				 }
				 }	
				 return !$this->errorCode;
				 }
				 public function authenticate2($x = 0)	{		/*		$users=array(			 username => password			'demo'=>'demo',			'admin'=>'admin',		);		if(!isset($users[$this->username]))			$this->errorCode=self::ERROR_USERNAME_INVALID;		else if($users[$this->username]!==$this->password)			$this->errorCode=self::ERROR_PASSWORD_INVALID;		else			$this->errorCode=self::ERROR_NONE;		return !$this->errorCode;		*/		if($x == 0)		{			$user = User::model()->findByAttributes(array('email' => $this->username));		}				if($user === null)		{/*			//No such user registered.*/			$this->errorCode=self::ERROR_USERNAME_INVALID;		}		else		{							$this->setState('id', $user->id);				$this->setState('email', $user->email);				$this->setState('myName', $user->fname.' '.$user->lname);/*				//Set parameters for buyer				*/				$buyer = UserRole::model()->findAllByAttributes(array('user_id'=>$user->id, 'value'=>'buyer'));				if($buyer != null)				{					$url = CHtml::normalizeUrl(array('/user/buyersDashboard'));					$this->setState('myDash', $url);					$this->setState('isBuyer', true);				}/*				//Set parameters for seller				*/				$seller = UserRole::model()->findAllByAttributes(array('user_id'=>$user->id, 'value'=>'seller'));				if($seller != null)				{					$url = CHtml::normalizeUrl(array('/seller'));					$this->setState('myDash', $url);					$this->setState('isSeller', true);/*					//Yii::app()->user->setReturnUrl($url);*/				}/*				//Set parameters for admin				*/				$admin = UserRole::model()->findAllByAttributes(array('user_id'=>$user->id, 'value'=>'admin'));				if($admin != null)				{/*					//set him as admin.*/					$this->username = 'admin';					$url = CHtml::normalizeUrl(array('/seller/dashboard'));					$this->setState('myDash', $url);					$this->setState('isAdmin', true);/*					Yii::app()->user->setReturnUrl($url);*/				}								/* Last login time, make changes here in future.*/				/*				if(null===$user->last_login_time)					$lastLogin = time();				else				{					$lastLogin = strtotime($user->last_login_time);				}				$this->setState('lastLoginTime', $lastLogin);				$user->last_login_time = date('Y-m-d H:i:s');				*/				$this->errorCode=self::ERROR_NONE; 		return !$this->errorCode;		}	}}