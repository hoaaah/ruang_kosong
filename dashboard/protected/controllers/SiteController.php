<?php

class SiteController extends Controller
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
				'actions'=>array('login', 'error'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index', 'complaint' , 'error', 'contact', 'tentang', 'logout'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index', 'error', 'contact', 'tentang', 'logout'),
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
        public $Ctitle='Dashboard';
        
	public function actionIndex()
	{
		IF(!isset(Yii::app()->user->Id)) $this->redirect(array('login'));
                $tanggal = new DateTime(date('Y-m-d H:i:s'));
                $complaint = Yii::app()->db->createCommand('CALL sp_cekcondition()')->queryAll();
                $tscheduled = Yii::app()->db->createCommand('CALL sp_cektodayscheduled('.$this->user_log->kampus_id.', "'.$tanggal->format('Y-m-d').'")')->queryAll();
                $tcanceled = Yii::app()->db->createCommand('CALL sp_cektodaycanceled('.$this->user_log->kampus_id.', "'.$tanggal->format('Y-m-d').'")')->queryAll();
                // $tstats = Yii::app()->db->createCommand('CALL sp_cekstats('.$this->user_log->kampus_id.', "'.$tanggal->format('Y-m-d').'")')->queryAll();
                $c= Yii::app()->db->createCommand('
                SELECT  a.id, a.user_id, c.kelas, a.tanggal_guna, a.session_length,
                CONCAT(LEFT(d.name,2),".",MID(d.name,3,2)) AS jam, b.kelas AS ruang
                FROM
                (SELECT a.id, a.kelas_id, a.user_id, a.tanggal_guna, a.session_length, SUBSTRING_INDEX(a.session_length,".", 1) AS session_start
                FROM r_guna a WHERE a.status = 0 AND a.tanggal_guna = "'.$tanggal->format('Y-m-d').'" ) a
                INNER JOIN r_kelas b ON a.kelas_id = b.id 
                INNER JOIN t_users c ON a.user_id =  c.id
                INNER JOIN r_session d ON a.session_start = d.id
                ')->queryAll();                
		$this->render('index', array('complaint' => $complaint,'tscheduled' => $tscheduled, 'tcanceled' => $tcanceled /*, 'tstats' => $tstats*/, 'c' => $c));
	}

	public function actionComplaint()
	{
		IF(!isset(Yii::app()->user->Id)) $this->redirect(array('login'));
        if($this->user_log["kampus_id"] == 0){
			$kampusId = Kampus::model()->find()->id;
			$this->user_log["kampus_id"] = $kampusId;
		}
		$complaint = Yii::app()->db->createCommand('CALL sp_complaint('.$this->user_log["kampus_id"].')')->queryAll();  
                
		$this->render('complaint', array('complaint' => $complaint));
	}        
        
	public function actionScheduled()
	{
		IF(!isset(Yii::app()->user->Id)) $this->redirect(array('login'));
                
                $sql = 'SELECT c.name AS jurusan, b.semester, b.kelas, 
                        d.name AS mata_kuliah, a.tanggal_guna, e.kelas AS ruang, a.session_length,
                        b.name
                        FROM r_guna a
                        INNER JOIN t_users b ON a.user_id = b.id
                        INNER JOIN r_jurusan c ON b.jurusan_id = c.id
                        INNER JOIN r_mata_kuliah d ON a.mata_kuliah = d.id
                        INNER JOIN r_kelas e ON a.kelas_id = e.id
                        INNER JOIN r_building f ON e.building_id = f.id
                        WHERE a.tanggal_guna = "'.DATE('Y-m-d').'" AND a.status = 1 AND f.kampus_id = '.$this->user_log->kampus_id.'
                        ORDER BY b.jurusan_id, b.semester, b.kelas';
                $rawData = Yii::app()->db->createCommand($sql); //or use ->queryAll(); in CArrayDataProvider
                $count = Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar(); //the count


                $model = new CSqlDataProvider($rawData, array( //or $model=new CArrayDataProvider($rawData, array(... //using with querAll...
                            'keyField' => 'name', 
                            'totalItemCount' => $count,

                            //if the command above use PDO parameters
                            //'params'=>array(
                            //':param'=>$param,
                            //),

                            'sort' => array(
                                'attributes' => array(
                                    'name','jurusan', 'semester', 'kelas', 'mata_kuliah', 'tanggal_guna', 'ruang','session_length'
                                ),
/*                                
                                'defaultOrder' => array(
                                    'MAIN_ID' => CSort::SORT_ASC, //default sort value
                                ),
 */
                            ),
                            'pagination' => array(
                                'pageSize' => 1000,
                            ),
                        ));                
		$this->render('scheduled', array('model' => $model));
	}           

	public function actionStats()
	{
		IF(!isset(Yii::app()->user->Id)) $this->redirect(array('login'));              
                $sql = 'SELECT c.name AS jurusan, b.semester, b.kelas, 
                        d.name AS mata_kuliah, a.tanggal_guna, e.kelas AS ruang, a.session_length,
                        b.name
                        FROM r_guna a
                        INNER JOIN t_users b ON a.user_id = b.id
                        INNER JOIN r_jurusan c ON b.jurusan_id = c.id
                        INNER JOIN r_mata_kuliah d ON a.mata_kuliah = d.id
                        INNER JOIN r_kelas e ON a.kelas_id = e.id
                        WHERE a.tanggal_guna < NOW() AND a.status = 1
                        ORDER BY b.jurusan_id, b.semester, b.kelas';
                $rawData = Yii::app()->db->createCommand($sql); //or use ->queryAll(); in CArrayDataProvider
                $count = Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar(); //the count


                $model = new CSqlDataProvider($rawData, array( //or $model=new CArrayDataProvider($rawData, array(... //using with querAll...
                            'keyField' => 'name', 
                            'totalItemCount' => $count,

                            //if the command above use PDO parameters
                            //'params'=>array(
                            //':param'=>$param,
                            //),

                            'sort' => array(
                                'attributes' => array(
                                    'name','jurusan', 'semester', 'kelas', 'mata_kuliah', 'tanggal_guna', 'ruang','session_length'
                                ),
/*                                
                                'defaultOrder' => array(
                                    'MAIN_ID' => CSort::SORT_ASC, //default sort value
                                ),
 */
                            ),
                            'pagination' => array(
                                'pageSize' => 1000,
                            ),
                        ));                
                //$stats = Yii::app()->db->createCommand('CALL sp_stats()')->queryAll();  
                $stats = null;
                
		$this->render('stats', array('stats' => $stats, 'model' => $model));
	}            
     
        
	public function actionBroken($id)
	{
                Yii::app()->db->createCommand()
                        ->insert('t_kelas_att', array(
                                'kelas_attrib'=> $id,
                                'condition'=> 1,
                                //'detail'=>'belum bos ntar yah',
                                'DateCreate'=>date('Y-m-d H:i:s'),
                                'user_id'=> Yii::app()->user->Id,
                        ));              
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		$this->redirect(Yii::app()->request->urlReferrer);
	}

	public function actionFixed($id)
	{
                Yii::app()->db->createCommand()
                        ->insert('t_kelas_att', array(
                                'kelas_attrib'=> $id,
                                'condition'=> 0,
                                //'detail'=>'belum bos ntar yah',
                                'DateCreate'=>date('Y-m-d H:i:s'),
                                'user_id'=> Yii::app()->user->Id,
                        ));              
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		$this->redirect(Yii::app()->request->urlReferrer);
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

	public function actionTa($id)
	{
		$this->render('tahan',array('tahun'=>$id));
	}
	
		public function actionSkpd($id)
	{
		list($tahun, $kdskpd) = explode('~', $id);
		$update0 = Yii::app()->db->createCommand('CALL rpt_progker_skpd("'.($kdskpd).'",'.($tahun).')')->queryAll();
		$nmskpd = $update0['0']['nm_sub_unit'];
		$this->render('rskpd',array('tahun'=>$tahun, 'kdskpd' => $kdskpd, 'nmskpd' => $nmskpd));
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
	public function actionTentang()
	{
		$this->render('about');
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
								

		
										
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		$this->layout = 'login';
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