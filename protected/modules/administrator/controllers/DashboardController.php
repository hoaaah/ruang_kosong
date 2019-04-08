<?php

class DashboardController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('admin'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('admin'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		IF( Yii::app()->session['group_user']['bidang_id'] > 1){
			return false;
		}
		$this->render('index',array());
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			Yii::app()->session['nama_user'] = $_POST['LoginForm']['username'];
				
//session User_id dan user_group		
			$log_user=User::model()->find(array(
				'select'=>'id',
				'condition'=>'username=:username',
				'params'=>array(':username'=>$_POST['LoginForm']['username']),
			));		
						
			Yii::app()->db->createCommand()
			->insert('log_user', array(
								'log_type'=> '1',
								'user_id'=>$log_user['id'],
								'log_user'=>date('Y-m-d H:i:s'),
								));
								
			$log_user_group=User::model()->find(array(
				'select'=>'bidang_id',
				'condition'=>'username=:username',
				'params'=>array(':username'=>$_POST['LoginForm']['username']),
			));	
			Yii::app()->session['group_user'] = $log_user_group;
			//If untuk store session ref_pegawai_id
			IF(Yii::app()->session['group_user']['bidang_id'] <> 0){
					$log_pegawai=RefPegawai::model()->find(array(
					'select'=>'*',
					'condition'=>'nip=:username',
					'params'=>array(':username'=>$_POST['LoginForm']['username']),
					));	
					Yii::app()->session['ref_pegawai'] = $log_pegawai;
				
			}ELSE{
					$log_pegawai=array('nip'=>0, 'id'=> 0);	
					Yii::app()->session['ref_pegawai'] = $log_pegawai;				
			}
		
		
										
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}