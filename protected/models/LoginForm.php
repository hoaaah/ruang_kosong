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
			if(!$this->_identity->authenticate())
				$this->addError('password','Incorrect username or password.');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
					$log_user=User::model()->find(array(
					'select'=>'*',
					'condition'=>'username=:username',
					'params'=>array(':username'=>$_POST['LoginForm']['username']),
				));		
				Yii::app()->session['nama_user'] = $_POST['LoginForm']['username'];
				Yii::app()->session['kampus_id'] = $log_user['kampus_id'];
				IF(ISSET($log_user['jurusan_id'])){
					Yii::app()->session['jurusan_id'] = $log_user['jurusan_id'];
				}
				IF(ISSET($log_user['semester'])){
					Yii::app()->session['semester'] = $log_user['semester'];
				}
				Yii::app()->session['peran'] = $log_user['peran'];
				IF(ISSET($log_user['preferred_building'])){
					Yii::app()->session['preferred_building'] = $log_user['preferred_building'];
				}
				Yii::app()->db->createCommand()
				->insert('log_user', array(
									'log_type'=> '1',
									'user_id'=>$log_user['id'],
									'log_user'=>date('Y-m-d H:i:s'),
									));			
			return true;
		}
		else
			return false;
	}
}
