<?php

class PakaiRuangController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $Ctitle='Persetujuan Penggunaan Ruang'; //Ini akan ditampilkan sebagai judul page

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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view', 'create','update', 'tolak', 'setuju'),
				'users'=>array('@'),
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new RGuna;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RGuna']))
		{
			$model->attributes=$_POST['RGuna'];
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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RGuna']))
		{
			$model->attributes=$_POST['RGuna'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	
	public function actionTolak($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['RGuna']))
		{
			$model->attributes=$_POST['RGuna'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->renderPartial('_form',array(
			'model'=>$model,
		));
	}

	
	public function actionSetuju($id)
	{
		$id = explode(".", $id);
		$model=$this->loadModel($id[0]);
		$model->status = 2;

		if(isset($_POST['RGuna']))
		{
			$model->attributes=$_POST['RGuna'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->renderPartial('_form',array(
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
		$fwdtbl= Yii::app()->db->createCommand('SELECT GROUP_CONCAT(a.id SEPARATOR ".") AS id, a.status, GROUP_CONCAT(a.tanggal_guna SEPARATOR";") AS tanggal_guna,a.session_start, a.session_end, CONCAT(LEFT(b.name,2),".",MID(b.name,3,2)) AS jam, CONCAT(LEFT(e.name,2),".",MID(e.name,3,2)) AS jam_selesai, a.user_id, a.kelas_id, c.kelas, a.mata_kuliah AS id_kuliah, a.mata_kuliah AS mata_kuliah, a.jumlah_hari FROM
		(SELECT a.*, SUBSTRING_INDEX(a.session_length,".", 1) AS session_start, SUBSTRING_INDEX(a.session_length,".", -1) AS session_end
		FROM r_guna a 
		WHERE a.tanggal_guna >= "'.date('Y-m-d').'"  AND a.status = 1)
		a
		INNER JOIN r_session b ON a.session_start = b.id
		INNER JOIN r_kelas c ON a.kelas_id = c.id
		INNER JOIN r_session e ON a.session_end = e.id
		-- INNER JOIN r_mata_kuliah d ON a.mata_kuliah = d.id
		GROUP BY a.user_id, a.kelas_id, a.session_length, a.mata_kuliah, a.dari, a.jumlah_peserta, a.penanggung_jawab, a.konsumsi, a.tor_kak, a.yang_mengajukan, a.jumlah_hari
		ORDER BY tanggal_guna ASC, session_start ASC')->queryAll();
		$gridDataProvider = new CArrayDataProvider($fwdtbl, array('keyField' => 'id','pagination'=>array('pageSize'=> 8,)));

		$this->render('index',array(
			'fwdtbl' => $fwdtbl,
			'gridDataProvider' => $gridDataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new RGuna('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['RGuna']))
			$model->attributes=$_GET['RGuna'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return RGuna the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=RGuna::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param RGuna $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='rguna-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
