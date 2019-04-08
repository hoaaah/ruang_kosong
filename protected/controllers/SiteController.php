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


	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		IF(isset(Yii::app()->user->Id))
		{
			$model=new Bookguna;		
			$tanggal = new DateTime(date('Y-m-d H:i:s'));
                        //$tanggal = date('Y-m-d H:i:s');
                        $pg = new User;
                        //awal bagian membawa isi tabel
                        $fwdtbl= Yii::app()->db->createCommand('SELECT a.id, a.tanggal_guna,a.session_start, CONCAT(LEFT(b.name,2),".",MID(b.name,3,2)) AS jam, a.user_id, a.kelas_id, c.kelas, a.mata_kuliah AS id_kuliah, d.name AS mata_kuliah FROM
                        (SELECT a.*, SUBSTRING_INDEX(a.session_length,".", 1) AS session_start
                        FROM r_guna a 
                        WHERE a.tanggal_guna = "'.$tanggal->format('Y-m-d').'" AND user_id = '.Yii::app()->user->Id.' AND a.status = 1)
                        a
                        INNER JOIN r_session b ON a.session_start = b.id
                        INNER JOIN r_kelas c ON a.kelas_id = c.id
                        INNER JOIN r_mata_kuliah d ON a.mata_kuliah = d.id
                        ORDER BY tanggal_guna ASC, session_start ASC')->queryAll();
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
                        $notif = Yii::app()->db->createCommand('
                        SELECT * FROM notification WHERE kampus_id = '.$this->user_log['kampus_id'].' AND tgl_mulai <= "'.$tanggal->format('Y-m-d').'" AND tgl_selesai >= "'.$tanggal->format('Y-m-d').'" ORDER BY id DESC
                        ')->queryAll();
                        $gd = Building::model()->findAll();
                        $mk = CHtml::listData(MataKuliah::model()->findAll(), 'id', 'name');
                        IF(isset($this->user_log['preferred_building'])) $gd = Building::model()->findAll("id=".$this->user_log['preferred_building'] );
                        IF(ISSET($this->user_log['jurusan_id']) && ISSET($this->user_log['semester'])){
                                $mk = CHtml::listData(MataKuliah::model()->findAll(array("condition"=>"jurusan_id = ".$this->user_log['jurusan_id'] ." AND semester = ".$this->user_log['semester'])), 'id', 'name');
                        }
                        IF($this->user_log['kampus_id'] == 0 ){
                                $t= Yii::app()->db->createCommand("CALL sp_timetable(1, '".$tanggal->format('Y-m-d')."')")->queryAll();
                        }ELSEIF(ISSET($this->user_log['preferred_building'])){
                                $t= Yii::app()->db->createCommand("CALL sp_timetablepr(".$this->user_log['kampus_id'].", '".$tanggal->format('Y-m-d')."', ".$this->user_log['preferred_building'].")")->queryAll();
                        }ELSE{
                                $t= Yii::app()->db->createCommand("CALL sp_timetable(".$this->user_log['kampus_id'].", '".$tanggal->format('Y-m-d')."')")->queryAll();
                        }
                        //akhir bagian isi tabel
                        if(isset($_POST['User']))
                        {
                                $pg->attributes=$_POST['User'];
                                Yii::app()->db->createCommand()
                                        ->update('t_users', array(
                                                'preferred_building'=>$pg->preferred_building,
                                        ), 'id=:id', array(':id'=>Yii::app()->user->Id));                                
                                Yii::app()->session['preferred_building'] = $pg->preferred_building;
                                $this->redirect(Yii::app()->request->urlReferrer);
                        }                       
			if(isset($_POST['Bookguna']) && Yii::app()->session['peran'] < 4)
			{
				$model->attributes=$_POST['Bookguna'];
				IF($model->mata_kuliah != ''){                              
                                    $session_length = array();
                                    IF($model->col1 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 1,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));	
                                    $session_length[] = 1;					
                                    }
                                    IF($model->col2 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 2,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));	
                                    $session_length[] = 2;					
                                    }
                                    IF($model->col3 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 3,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 3;	
                                    }
                                    IF($model->col4 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 4,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 4;	
                                    }
                                    IF($model->col5 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 5,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 5;	
                                    }
                                    IF($model->col6 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 6,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 6;
                                    }
                                    IF($model->col7 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 7,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 7;
                                    }
                                    IF($model->col8 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 8,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 8;
                                    }
                                    IF($model->col9 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 9,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 9;
                                    }
                                    IF($model->col10 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 10,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 10;
                                    }
                                    IF($model->col11 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 11,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 11;
                                    }
                                    IF($model->col12 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 12,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 12;
                                    }
                                    IF($model->col13 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 13,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 13;
                                    }
                                    IF($model->col14 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 14,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 14;
                                    }
                                    IF($model->col15 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 15,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 15;
                                    }
                                    IF($model->col16 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 16,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 16;
                                    }
                                    IF($model->col17 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 17,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 17;
                                    }
                                    IF($model->col18 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 18,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 18;
                                    }
                                    IF($model->col19 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 19,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 19;
                                    }
                                    IF($model->col20 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 20,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 20;
                                    }
                                    IF($model->col21 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 21,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 21;
                                    }
                                    IF($model->col22 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 22,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 22;
                                    }
                                    Yii::app()->db->createCommand()
                                    ->insert('r_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_length'=> implode(".", $session_length),
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            'status' =>1,
                                                                            ));		
                                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
                                }
                        }
                        
			$this->render('index', [
				'model'=>$model,'tanggal'=>$tanggal, 'pg' => $pg, 'fwdtbl' => $fwdtbl, 'c' => $c,
                                'gd' => $gd, 'mk' => $mk, 't' => $t, 'notif' => $notif,
                        ]);
		}ELSE{
			$this->render('home');			
		}
        }
        
	public function actionDay($id)
	{
		IF(isset(Yii::app()->user->Id))
		{
                    //Yii::app()->request->urlReferrer
                    $model=new Bookguna;		
                    $tanggal = new DateTime(date('Y-m-d H:i:s'));
                    $tanggal->modify('+'.$id.' day');                 
                    $pg = new User;
                        //awal bagian membawa isi tabel
                        $fwdtbl= Yii::app()->db->createCommand('SELECT a.id, a.tanggal_guna,a.session_start, CONCAT(LEFT(b.name,2),".",MID(b.name,3,2)) AS jam, a.user_id, a.kelas_id, c.kelas, a.mata_kuliah AS id_kuliah, d.name AS mata_kuliah FROM
                        (SELECT a.*, SUBSTRING_INDEX(a.session_length,".", 1) AS session_start
                        FROM r_guna a 
                        WHERE a.tanggal_guna = "'.$tanggal->format('Y-m-d').'" AND user_id = '.Yii::app()->user->Id.' AND a.status = 1)
                        a
                        INNER JOIN r_session b ON a.session_start = b.id
                        INNER JOIN r_kelas c ON a.kelas_id = c.id
                        INNER JOIN r_mata_kuliah d ON a.mata_kuliah = d.id
                        ORDER BY tanggal_guna ASC, session_start ASC')->queryAll();
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
                        $notif = Yii::app()->db->createCommand('
                        SELECT * FROM notification WHERE kampus_id = '.$this->user_log['kampus_id'].' AND tgl_mulai <= "'.$tanggal->format('Y-m-d').'" AND tgl_selesai >= "'.$tanggal->format('Y-m-d').'" ORDER BY id DESC
                        ')->queryAll();
                        
                        $gd = Building::model()->findAll();
                        $mk = CHtml::listData(MataKuliah::model()->findAll(), 'id', 'name');
                        IF(isset($this->user_log['preferred_building'])) $gd = Building::model()->findAll("id=".$this->user_log['preferred_building'] );
                        IF(ISSET($this->user_log['jurusan_id']) && ISSET($this->user_log['semester'])){
                                $mk = CHtml::listData(MataKuliah::model()->findAll(array("condition"=>"jurusan_id = ".$this->user_log['jurusan_id'] ." AND semester = ".$this->user_log['semester'])), 'id', 'name');
                        }
                        IF($this->user_log['kampus_id'] == 0 ){
                                $t= Yii::app()->db->createCommand("CALL sp_timetable(1, '".$tanggal->format('Y-m-d')."')")->queryAll();
                        }ELSEIF(ISSET($this->user_log['preferred_building'])){
                                $t= Yii::app()->db->createCommand("CALL sp_timetablepr(".$this->user_log['kampus_id'].", '".$tanggal->format('Y-m-d')."', ".$this->user_log['preferred_building'].")")->queryAll();
                        }ELSE{
                                $t= Yii::app()->db->createCommand("CALL sp_timetable(".$this->user_log['kampus_id'].", '".$tanggal->format('Y-m-d')."')")->queryAll();
                        }
                        //akhir bagian isi tabel                    
                        if(isset($_POST['User']))
                        {
                                $pg->attributes=$_POST['User'];
                                Yii::app()->db->createCommand()
                                        ->update('t_users', array(
                                                'preferred_building'=>$pg->preferred_building,
                                        ), 'id=:id', array(':id'=>Yii::app()->user->Id));                                      
                                Yii::app()->session['preferred_building'] = $pg->preferred_building;
                                $this->redirect(Yii::app()->request->urlReferrer);
                        }        
			if(isset($_POST['Bookguna']) && Yii::app()->session['peran'] < 4)
			{
				$model->attributes=$_POST['Bookguna'];
                                IF($model->mata_kuliah != ''){
                                    $session_length = array();
                                    IF($model->col1 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 1,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));	
                                    $session_length[] = 1;					
                                    }
                                    IF($model->col2 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 2,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));	
                                    $session_length[] = 2;					
                                    }
                                    IF($model->col3 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 3,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 3;	
                                    }
                                    IF($model->col4 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 4,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 4;	
                                    }
                                    IF($model->col5 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 5,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 5;	
                                    }
                                    IF($model->col6 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 6,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 6;
                                    }
                                    IF($model->col7 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 7,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 7;
                                    }
                                    IF($model->col8 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 8,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 8;
                                    }
                                    IF($model->col9 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 9,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 9;
                                    }
                                    IF($model->col10 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 10,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 10;
                                    }
                                    IF($model->col11 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 11,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 11;
                                    }
                                    IF($model->col12 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 12,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 12;
                                    }
                                    IF($model->col13 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 13,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 13;
                                    }
                                    IF($model->col14 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 14,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 14;
                                    }
                                    IF($model->col15 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 15,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 15;
                                    }
                                    IF($model->col16 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 16,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 16;
                                    }
                                    IF($model->col17 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 17,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 17;
                                    }
                                    IF($model->col18 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 18,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 18;
                                    }
                                    IF($model->col19 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 19,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 19;
                                    }
                                    IF($model->col20 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 20,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 20;
                                    }
                                    IF($model->col21 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 21,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 21;
                                    }
                                    IF($model->col22 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 22,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 22;
                                    }
                                    Yii::app()->db->createCommand()
                                    ->insert('r_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_length'=> implode(".", $session_length),
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            'status' =>1,
                                                                            ));		
                                    $this->redirect(Yii::app()->request->urlReferrer);
                                }
			}
			$this->render('index',array(
				'model'=>$model,'tanggal'=>$tanggal, 'id'=>$id,  'pg' => $pg, 'fwdtbl' => $fwdtbl, 'c' => $c,
                                'gd' => $gd, 'mk' => $mk, 't' => $t, 'notif' => $notif,
				));
		}ELSE{
			$this->render('home');			
		}
        }
        
	public function actionIndexg()
	{
		IF(isset(Yii::app()->user->Id))
		{
			$model=new Bookguna;		
			$tanggal = new DateTime(date('Y-m-d H:i:s'));
			//$tanggal = date('Y-m-d H:i:s');
			if(isset($_POST['Bookguna']) && Yii::app()->session['peran'] < 4)
			{
				$model->attributes=$_POST['Bookguna'];	
                                IF($model->mata_kuliah != ''){
                                    $session_length = array();
                                    IF($model->col1 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 1,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));	
                                    $session_length[] = 1;					
                                    }
                                    IF($model->col2 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 2,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));	
                                    $session_length[] = 2;					
                                    }
                                    IF($model->col3 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 3,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 3;	
                                    }
                                    IF($model->col4 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 4,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 4;	
                                    }
                                    IF($model->col5 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 5,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 5;	
                                    }
                                    IF($model->col6 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 6,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 6;
                                    }
                                    IF($model->col7 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 7,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 7;
                                    }
                                    IF($model->col8 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 8,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 8;
                                    }
                                    IF($model->col9 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 9,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 9;
                                    }
                                    IF($model->col10 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 10,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 10;
                                    }
                                    IF($model->col11 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 11,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 11;
                                    }
                                    IF($model->col12 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 12,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 12;
                                    }
                                    IF($model->col13 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 13,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 13;
                                    }
                                    IF($model->col14 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 14,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 14;
                                    }
                                    IF($model->col15 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 15,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 15;
                                    }
                                    IF($model->col16 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 16,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 16;
                                    }
                                    IF($model->col17 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 17,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 17;
                                    }
                                    IF($model->col18 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 18,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 18;
                                    }
                                    IF($model->col19 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 19,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 19;
                                    }
                                    IF($model->col20 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 20,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 20;
                                    }
                                    IF($model->col21 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 21,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 21;
                                    }
                                    IF($model->col22 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 22,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 22;
                                    }
                                    Yii::app()->db->createCommand()
                                    ->insert('r_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_length'=> implode(".", $session_length),
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            'status' =>1,
                                                                            ));		
                                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('indexg'));
                                }
			}
			$this->render('indexg',array(
				'model'=>$model,'tanggal'=>$tanggal
			));
		}ELSE{
			$this->render('home');			
		}
        }
        
	public function actionDayg($id)
	{
		//Yii::app()->request->urlReferrer
		$model=new Bookguna;		
		$tanggal = new DateTime(date('Y-m-d H:i:s'));
		$tanggal->modify('+'.$id.' day');
		IF(isset(Yii::app()->user->Id))
		{
			if(isset($_POST['Bookguna']) && Yii::app()->session['peran'] < 4)
			{
				$model->attributes=$_POST['Bookguna'];
                                IF($model->mata_kuliah != ''){
                                    $session_length = array();
                                    IF($model->col1 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 1,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));	
                                    $session_length[] = 1;					
                                    }
                                    IF($model->col2 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 2,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));	
                                    $session_length[] = 2;					
                                    }
                                    IF($model->col3 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 3,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 3;	
                                    }
                                    IF($model->col4 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 4,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 4;	
                                    }
                                    IF($model->col5 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 5,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 5;	
                                    }
                                    IF($model->col6 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 6,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 6;
                                    }
                                    IF($model->col7 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 7,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 7;
                                    }
                                    IF($model->col8 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 8,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 8;
                                    }
                                    IF($model->col9 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 9,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 9;
                                    }
                                    IF($model->col10 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 10,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 10;
                                    }
                                    IF($model->col11 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 11,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 11;
                                    }
                                    IF($model->col12 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 12,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 12;
                                    }
                                    IF($model->col13 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 13,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 13;
                                    }
                                    IF($model->col14 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 14,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 14;
                                    }
                                    IF($model->col15 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 15,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 15;
                                    }
                                    IF($model->col16 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 16,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 16;
                                    }
                                    IF($model->col17 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 17,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 17;
                                    }
                                    IF($model->col18 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 18,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 18;
                                    }
                                    IF($model->col19 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 19,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 19;
                                    }
                                    IF($model->col20 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 20,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 20;
                                    }
                                    IF($model->col21 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 21,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 21;
                                    }
                                    IF($model->col22 == 1){
                                    Yii::app()->db->createCommand()
                                    ->insert('t_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_id'=> 22,
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            ));						
                                    $session_length[] = 22;
                                    }
                                    Yii::app()->db->createCommand()
                                    ->insert('r_guna', array(
                                                                            'DateCreate'=>date('Y-m-d H:i:s'),
                                                                            'user_id'=> Yii::app()->user->Id,
                                                                            'kelas_id'=> $model->kelas_id,
                                                                            'tanggal_guna'=> $tanggal->format('Y-m-d'),
                                                                            'session_length'=> implode(".", $session_length),
                                                                            'mata_kuliah' =>$model->mata_kuliah,
                                                                            'status' =>1,
                                                                            ));		
                                    $this->redirect(Yii::app()->request->urlReferrer);
                                }
			}
			$this->render('indexg',array(
				'model'=>$model,'tanggal'=>$tanggal, 'id'=>$id,
				));
		}ELSE{
			$this->render('home');			
		}
        }
        
	public function actionDel($id)
	{
		list($kelas_id, $session, $y, $m, $d) = explode('-', $id);
		$mk=mktime(0, 0, 0, $m, $d, $y);
                $tanggal = date ('Y-m-d', $mk);
		$t= Yii::app()->db->createCommand("SELECT user_id FROM t_guna WHERE kelas_id =".$kelas_id." AND session_id=".$session." AND tanggal_guna='".$tanggal."'")->queryAll();
		IF($t['0']['user_id'] == Yii::app()->user->Id){
			Yii::app()->db->createCommand()->delete('t_guna', 'kelas_id=:kelas_id AND session_id=:session AND tanggal_guna=:tanggal', array(':kelas_id'=>$kelas_id, ':session'=>$session, ':tanggal'=>$tanggal));
		}
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