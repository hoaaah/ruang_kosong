<?php

class ComKelasController extends Controller
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
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','create','update', 'broken'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'broken'),
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
		$model=new ComKelas;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ComKelas']))
		{
			$model->attributes=$_POST['ComKelas'];
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

		if(isset($_POST['ComKelas']))
		{
			$model->attributes=$_POST['ComKelas'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
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
        
	/**
	 * Lists all models.
	 */
	public function actionIndex($id)
	{
		
		$dataProvider=new CActiveDataProvider('ComKelas');
		$model=new ComKelas;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ComKelas']))
		{
			$model->attributes=$_POST['ComKelas'];
			$model->kelas_id = $id;
			$model->user_id = Yii::app()->user->Id;
			$model->created = date('Y-m-d H:i:s');
			if($model->save())
				$this->redirect(Yii::app()->request->urlReferrer);
		}
		$dataProvider = new CActiveDataProvider( // declare a new dataprovider
		  'ComKelas', // declare the type of Model you want to query and display
		  array( // here we build the SQL 'where' clause
			'criteria' => array( // this is just building a CDbCriteria object
			  'condition' => 'kelas_id=:id', // look for content with the user_id we pass in
			  'params' => array(':id' => $id), // pass in (bind) user's id to the query
			  //'order'=>'date_modified DESC', // add your sort order if you want?
			  //'with'=>'commentCount', // join in your commentCount table?
			)
		  )
		);
                //Bagian Untuk Condition and complaint
                $count=Yii::app()->db->createCommand('SELECT COUNT(a.id) 
                    FROM
                    (SELECT * FROM r_kelas_att WHERE kelas_id = '.$id.')
                    a
                    LEFT OUTER JOIN
                    (
                    SELECT a.kelas_attrib, a.condition, a.detail, a.DateCreate, a.user_id FROM t_kelas_att a 
                    WHERE a.DateCreate = (SELECT MAX(b.DateCreate) FROM t_kelas_att b WHERE a.kelas_attrib = b.kelas_attrib )
                    )
                    b ON a.id = b.kelas_attrib
                    INNER JOIN r_kelas c ON a.kelas_id = c.id
                    INNER JOIN r_building d ON c.building_id = d.id
                    ORDER BY a.id')->queryScalar();
                $sql='SELECT a.id,d.kampus_id, c.building_id, d.name AS building, a.kelas_id, c.kelas, a.attrib_id, a.name, IFNULL(b.condition,0) AS kondisi, 
                    IFNULL(b.detail,"") AS detail, b.DateCreate, b.user_id 
                    FROM
                    (SELECT * FROM r_kelas_att WHERE kelas_id = '.$id.')
                    a
                    LEFT OUTER JOIN
                    (
                    SELECT a.kelas_attrib, a.condition, a.detail, a.DateCreate, a.user_id FROM t_kelas_att a 
                    WHERE a.DateCreate = (SELECT MAX(b.DateCreate) FROM t_kelas_att b WHERE a.kelas_attrib = b.kelas_attrib )
                    )
                    b ON a.id = b.kelas_attrib
                    INNER JOIN r_kelas c ON a.kelas_id = c.id
                    INNER JOIN r_building d ON c.building_id = d.id
                    ORDER BY a.id';
                $att=new CSqlDataProvider($sql, array(
                    'totalItemCount'=>$count,
                    'sort'=>array(
                        'attributes'=>array(
                             'a.id',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>50,
                    ),
                ));
                
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'kelasi'=>$id,
                        'att' => $att,
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ComKelas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ComKelas']))
			$model->attributes=$_GET['ComKelas'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ComKelas the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ComKelas::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ComKelas $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='com-kelas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
