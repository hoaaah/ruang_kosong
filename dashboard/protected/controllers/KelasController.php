<?php

class KelasController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
        public $Ctitle='Ruang Kelas'; //Ini akan ditampilkan sebagai judul page
        
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
				'actions'=>array('index','create', 'list', 'update'),
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
                $building = Kelas::model()->findByPk($id);
                $gedung = Building::model()->findByPk($building->building_id);
                //$att = KelasAtt::model()->findAll('kelas_id=:id', array(':id' => $id));
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
                $dataProvider=new CSqlDataProvider($sql, array(
                    'totalItemCount'=>$count,
                    'sort'=>array(
                        'attributes'=>array(
                             'a.id',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>30,
                    ),
                ));
                // $dataProvider->getData() will return a list of arrays.
                
                $att= $dataProvider;// new CActiveDataProvider('KelasAtt', array('criteria' => array('condition' => 'kelas_id=' . $id,)));
                
                $KelasAtt=new KelasAtt;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['KelasAtt']))
		{
			$KelasAtt->attributes=$_POST['KelasAtt'];
                        $KelasAtt['kelas_id'] = $id;
			if($KelasAtt->save())
				$this->redirect(array('view','id'=>$id));
		}
                
		$this->render('view',array(
			'model'=>$this->loadModel($id),
                        'att' => $att,
                        'KelasAtt' => $KelasAtt,
                        'gedung' => $gedung
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Kelas;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Kelas']))
		{
			$model->attributes=$_POST['Kelas'];
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

		if(isset($_POST['Kelas']))
		{
			$model->attributes=$_POST['Kelas'];
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Kelas');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
        
	public function actionList($id)
	{
                $gedung = Building::model()->findByPk($id);
		$dataProvider=new CActiveDataProvider('Kelas', array(
                    'criteria' => array('condition' => 'building_id=' . $id,))
                    );
		$this->render('list',array(
			'dataProvider'=>$dataProvider, 'id' => $id,
                        'gedung'=>$gedung,
		));
	}
        
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Kelas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Kelas']))
			$model->attributes=$_GET['Kelas'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Kelas the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Kelas::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Kelas $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='kelas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
