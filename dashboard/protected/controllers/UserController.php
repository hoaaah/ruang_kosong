<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('login'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index', 'register', 'registsucces', 'update', 'view', 'call', 'mine', 'bantal', 'jadwal', 'jadwalkuliah', 'jadwalg', 'loadjurusan', 'loadsemester', 'loadkelas','ubahpwd'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create', 'index', 'admin', 'jadwalkuliah','delete', 'loadjurusan', 'loadsemester','ubahpwd'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
        public $Ctitle='User';
        
	public function actionView($id)
	{

		IF($id != Yii::app()->user->Id && User::model()->findAll('id=:id', array(':id'=>$id))['0']['peran'] <= $this->user_log['peran'] ) {
                        $this->redirect(array('view','id'=> Yii::app()->user->Id));
                }
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			Yii::app()->db->createCommand()
				->update('t_users', array(
					'preferred_building'=>$model->preferred_building,
				), 'id=:id', array(':id'=>$id));
                        Yii::app()->session['preferred_building'] = $model->preferred_building;
			//if($model->save())
			$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionRegister()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->approval = 1;
			$model->DateCreate = date('Y-m-d H:i:s');
			$model-> r_count = 0;			
			if($model->save())
				$this->redirect(array('Registsucces','id'=>$model->id));
		}

		$this->render('Regist',array(
			'model'=>$model,
		));
	}
	public function actionRegistsucces($id)
	{
		$this->render('Regses',array(
			'model'=>$this->loadModel($id),
		));
	}	
	 public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		IF($id != Yii::app()->user->Id && User::model()->findAll('id=:id', array(':id'=>$id))['0']['peran'] <= $this->user_log['peran'] ) {
                        $this->redirect(array('view','id'=> Yii::app()->user->Id));
                }
                $model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			Yii::app()->db->createCommand()
				->update('t_users', array(
					'semester'=>$model->semester,
                                        'name'=>$model->name,
                                        'sex'=>$model->sex,
                                        'peran'=>$model->peran,
                                        'kota_lahir'=>$model->kota_lahir,
                                        'tgl_lahir'=>$model->tgl_lahir,
                                        'contact'=>$model->contact,  
                                        'kelas'=>$model->kelas,
                                        'keterangan'=>$model->keterangan,
				), 'id=:id', array(':id'=>$id));
                        
                        //if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionUbahpwd($id)
	{
		IF($id != Yii::app()->user->Id && User::model()->findAll('id=:id', array(':id'=>$id))['0']['peran'] <= $this->user_log['peran'] ) {
                        $this->redirect(array('view','id'=> Yii::app()->user->Id));
                }
                $model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('ubahpwd',array(
			'model'=>$model,
		));
	}        
        
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User', array('criteria'=>array('condition'=>'peran>='.$this->user_log->peran)));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionCall()
	{
		IF(Yii::app()->session['peran'] >3){
			$this->redirect(Yii::app()->request->urlReferrer);
		}ELSE{
			
			$model=new User('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['User']))
				$model->attributes=$_GET['User'];
	
			$this->render('call',array(
				'model'=>$model,
			));
		}
		
	}

	public function actionMine()
	{
		IF(Yii::app()->session['peran'] >3){
			$this->redirect(Yii::app()->request->urlReferrer);
		}ELSE{

                        //awal bagian isi tabel
                        /*bakal jalan
                        $fwdtbl= Yii::app()->db->createCommand('SELECT a.id, a.tanggal_guna,a.session_start, CONCAT(LEFT(b.name,2),".",MID(b.name,3,2)) AS jam, a.user_id, a.kelas_id, c.kelas, a.mata_kuliah AS id_kuliah, d.name AS mata_kuliah FROM
                        (SELECT a.*, SUBSTRING_INDEX(a.session_length,".", 1) AS session_start
                        FROM r_guna a 
                        WHERE a.tanggal_guna >= "'.date('Y-m-d').'" AND a.tanggal_guna <= DATE_ADD("'.date('Y-m-d').'", INTERVAL 2 WEEK) AND user_id = '.Yii::app()->user->Id.' AND a.status = 1)
                        a
                        INNER JOIN r_session b ON a.session_start = b.id
                        INNER JOIN r_kelas c ON a.kelas_id = c.id
                        INNER JOIN r_mata_kuliah d ON a.mata_kuliah = d.id
                        ORDER BY tanggal_guna ASC, session_start ASC')->queryAll();
                         Saat ini yg dibawah nampilin semua jadwal sampe banyak banget
                         */
                        $fwdtbl= Yii::app()->db->createCommand('SELECT a.id, a.tanggal_guna,a.session_start, CONCAT(LEFT(b.name,2),".",MID(b.name,3,2)) AS jam, a.user_id, a.kelas_id, c.kelas, a.mata_kuliah AS id_kuliah, d.name AS mata_kuliah FROM
                        (SELECT a.*, SUBSTRING_INDEX(a.session_length,".", 1) AS session_start
                        FROM r_guna a 
                        WHERE a.tanggal_guna >= "'.date('Y-m-d').'"  AND user_id = '.Yii::app()->user->Id.' AND a.status = 1)
                        a
                        INNER JOIN r_session b ON a.session_start = b.id
                        INNER JOIN r_kelas c ON a.kelas_id = c.id
                        INNER JOIN r_mata_kuliah d ON a.mata_kuliah = d.id
                        ORDER BY tanggal_guna ASC, session_start ASC')->queryAll();  
                        $prvtbl= Yii::app()->db->createCommand('SELECT a.id, a.tanggal_guna,a.session_start, CONCAT(LEFT(b.name,2),".",MID(b.name,3,2)) AS jam, a.user_id, a.kelas_id, c.kelas, a.mata_kuliah AS id_kuliah, d.name AS mata_kuliah, CASE WHEN a.status = 0 THEN "Batal" END AS status FROM
                        (SELECT a.*, SUBSTRING_INDEX(a.session_length,".", 1) AS session_start
                        FROM r_guna a 
                        WHERE (a.tanggal_guna < "'.date('Y-m-d').'" OR status = 0) AND user_id = '.Yii::app()->user->Id.' LIMIT 0,20)
                        a
                        INNER JOIN r_session b ON a.session_start = b.id
                        INNER JOIN r_kelas c ON a.kelas_id = c.id
                        INNER JOIN r_mata_kuliah d ON a.mata_kuliah = d.id
                        ORDER BY tanggal_guna DESC, session_start ASC')->queryAll();                        
                        //akhir bagian isi tabel
                    
			$model=new User('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['User']))
				$model->attributes=$_GET['User'];
	
			$this->render('mine',array(
				'model'=>$model, 'fwdtbl' => $fwdtbl, 'prvtbl' => $prvtbl,
			));
		}
		
	}

	public function actionBantal($id)
	{
		$t= Yii::app()->db->createCommand("SELECT * FROM r_guna WHERE id=:id");
		$v=array(':id'=>$id);
		$t->execute($v);
		$t = $t->queryAll();

		list($y, $m, $d) = explode('-', $t['0']['tanggal_guna']);
		$mk=mktime(0, 0, 0, $m, $d, $y);
        $tanggal = date ('Y-m-d', $mk);
		$session_length = explode('.', $t['0']['session_length']);
		
		IF($t['0']['user_id'] == Yii::app()->user->Id){
			Yii::app()->db->createCommand()->update('r_guna', array('status'=>0), 'id= :id', array(':id'=>$id));
			foreach($session_length as $session_length){
				Yii::app()->db->createCommand()->delete('t_guna', 'kelas_id=:kelas_id AND session_id=:session AND tanggal_guna=:tanggal', array(':kelas_id'=>$t['0']['kelas_id'], ':session'=>$session_length, ':tanggal'=>$tanggal));
			}
		}
			$this->redirect(Yii::app()->request->urlReferrer);
	}	
	

	public function actionLoadkelas()
	{
	   $data=Kelas::model()->findAll('building_id=:gedung_id', 
	   array(':gedung_id'=>(int) $_POST['gedung_id']));
	 
	   $data=CHtml::listData($data,'id','kelas');
	 
	   echo "<option value=''>--Kelas--</option>";
	   foreach($data as $value=>$Bookguna_kelas_id)
	   echo CHtml::tag('option', array('value'=>$value),CHtml::encode($Bookguna_kelas_id),true);
	}	

	public function actionLoadjurusan()
	{
	   $data=Jurusan::model()->findAll('kampus_id=:kampus_id', 
	   array(':kampus_id'=>(int) $_POST['kampus_id']));
	 
	   $data=CHtml::listData($data,'id','name');
	 
	   echo "<option value=''>--Jurusan(opsional bagi non-STAN)--</option>";
	   foreach($data as $value=>$User_jurusan_id)
	   echo CHtml::tag('option', array('value'=>$value),CHtml::encode($User_jurusan_id),true);
	}	

	public function actionLoadsemester()
	{
	   $data=MataKuliah::model()->findAllBySql('SELECT jurusan_id, semester FROM r_mata_kuliah WHERE jurusan_id = :jurusan_id GROUP BY jurusan_id, semester',  array(':jurusan_id'=>(int) $_POST['jurusan_id']));
	 
	   $data=CHtml::listData($data,'semester','semester');
	 
	   echo "<option value=''>--Jurusan(opsional bagi non-STAN)--</option>";
	   foreach($data as $value=>$User_jurusan_id)
	   echo CHtml::tag('option', array('value'=>$value),CHtml::encode($User_jurusan_id),true);
	}	
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
