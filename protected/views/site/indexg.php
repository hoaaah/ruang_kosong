<?php
$day = $tanggal->format('D');
IF($day == 'Sun'){
	$hari = 'Minggu';
}ELSEIF($day == 'Mon'){
	$hari = 'Senin';
}ELSEIF($day == 'Tue'){
	$hari = 'Selasa';
}ELSEIF($day == 'Wed'){
	$hari = 'Rabu';
}ELSEIF($day == 'Thu'){
	$hari = 'Kamis';
}ELSEIF($day == 'Fri'){
	$hari = 'Jumat';
}ELSEIF($day == 'Sat'){
	$hari = 'Sabtu';
}ELSE{
	$hari = 'Hari-Hari Bahagia';
}
IF(ISSET(Yii::app()->session['jurusan_id']) && ISSET(Yii::app()->session['semester'])){
	$mk = CHtml::listData(MataKuliah::model()->findAll(array("condition"=>"jurusan_id = ".Yii::app()->session['jurusan_id'] ." AND semester = ".Yii::app()->session['semester'])), 'id', 'name');
}
?><style>
.Table
{
	display: table;
}
.Title
{
	display: table-caption;
	text-align: center;
	font-weight: bold;
	font-size: larger;
}
.Heading
{
	display: table-row;
	font-weight: bold;
	text-align: center;
}
.Row
{
	display: table-row;
}
.Cellhead
{
	
	display: table-cell;
	border: solid;
	border-color:#FFF;
	background-color:#999;
	border-width: thin;
	text-align: center;	
	font-weight: bold;
	width: 50px;
	min-width: 50px;
	max-width: 50px;	
}

.Cell
{
	display: table-cell;
	border: solid;
	border-color:#FFF;
	background-color:#d0e9c6;
	border-width: thin;
	text-align: center;	
	width: 50px;
	min-width: 50px;
	max-width: 50px;	
}
.Row :hover
{
	background-color:#CFF;
}
.Cellblock
{
	display: table-cell;
	border: solid;
	border-color:#FFF;
	background-color:#999;
        color: #FFF;
	text-align: center;	
	border-width: thin;
	width: 50px;
	min-width: 50px;
	max-width: 50px;	
}
</style>
<?php echo CHtml::button('Tampilkan Favorit', array('onclick' => 'js:document.location.href="index.php"')); 
?>
<div class="Table">
	<div class="Title">
		<p>POLITEKNIK KEUANGAN NEGARA - STAN</p>
	</div>
	<div class ="row">
	  <?php 
      IF(isset($id)){
          echo'
		  <div class="col-md-4" style="text-align:center">';
			$this->widget(
				'booster.widgets.TbButtonGroup',
				array(
					'buttons' => array(
						array('label' => '2w','buttonType'=> 'link', 'url' => array('dayg', 'id' => ($id-14))),
						array('label' => '1w','buttonType'=> 'link', 'url' => array('dayg', 'id' => ($id-7))),
						array('label' => '3d','buttonType'=> 'link', 'url' => array('dayg', 'id' => ($id-3))),
						array('label' => '<','buttonType'=> 'link', 'url' => array('dayg', 'id' => ($id-1))),
					),
				)
			);
			echo '</div>';

	  }ELSE{
		  echo'
          <div class="col-md-4" style="text-align:center">';
			$this->widget(
				'booster.widgets.TbButtonGroup',
				array(
					'buttons' => array(
						array('label' => '2w','buttonType'=> 'link', 'url' => array('dayg', 'id' => (-14))),
						array('label' => '1w','buttonType'=> 'link', 'url' => array('dayg', 'id' => (-7))),
						array('label' => '3d','buttonType'=> 'link', 'url' => array('dayg', 'id' => (-3))),
						array('label' => '<','buttonType'=> 'link', 'url' => array('dayg', 'id' => (-1))),
					),
				)
			);
			echo '</div>';
		  
	  }
	  ?>
	  
		  <div class="col-md-4" style="text-align:center"><?php 
		  echo $hari.','.$tanggal->format(' d M Y');?></div>
	  <?php 
      IF(isset($id)){
		  echo'
          <div class="col-md-4" style="text-align:center">';
			$this->widget(
				'booster.widgets.TbButtonGroup',
				array(
					'buttons' => array(
						array('label' => '>','buttonType'=> 'link', 'url' => array('dayg', 'id' => ($id+1))),
						array('label' => '3d','buttonType'=> 'link', 'url' => array('dayg', 'id' => ($id+3))),
						array('label' => '1w','buttonType'=> 'link', 'url' => array('dayg', 'id' => ($id+7))),
						array('label' => '2w','buttonType'=> 'link', 'url' => array('dayg', 'id' => ($id+14))),
					),
				)
			);
			echo '</div>';

	  }ELSE{
		  echo'
          <div class="col-md-4" style="text-align:center">';
			$this->widget(
				'booster.widgets.TbButtonGroup',
				array(
					'buttons' => array(
						array('label' => '>','buttonType'=> 'link', 'url' => array('dayg', 'id' => (1))),
						array('label' => '3d','buttonType'=> 'link', 'url' => array('dayg', 'id' => (3))),
						array('label' => '1w','buttonType'=> 'link', 'url' => array('dayg', 'id' => (7))),
						array('label' => '2w','buttonType'=> 'link', 'url' => array('dayg', 'id' => (14))),
					),
				)
			);
			echo '</div>';
		  
	  }
	  ?>
	</div>
<?php 
$form=$this->beginWidget('CActiveForm', array(
						'id'=>'Bookguna-form',
					));
echo'					
	<div class="Row">
		<div class="Cellhead">
			Ruang
		</div>
		<div class="Cellhead">
			07.30
		</div>
		<div class="Cellhead">
			08.00
		</div>
		<div class="Cellhead">
			08.30
		</div>
		<div class="Cellhead">
			09.00
		</div>
		<div class="Cellhead">
			09.30
		</div>
		<div class="Cellhead">
			10.00
		</div>
		<div class="Cellhead">
			10.30
		</div>
		<div class="Cellhead">
			11.00
		</div>
		<div class="Cellhead">
			11.30
		</div>
		<div class="Cellhead">
			12.00
		</div>
		<div class="Cellhead">
			12.30
		</div>
		<div class="Cellhead">
			13.00
		</div>
		<div class="Cellhead">
			13.30
		</div>
		<div class="Cellhead">
			14.00
		</div>
		<div class="Cellhead">
			14.30
		</div>
		<div class="Cellhead">
			15.00
		</div>
		<div class="Cellhead">
			15.30
		</div>
		<div class="Cellhead">
			16.00
		</div>
		<div class="Cellhead">
			16.30
		</div>	
		<div class="Cellhead">
			MK
		</div>
		<div class="Cellhead">
			Submit
		</div>
	</div>
    ';
	$this->endWidget();
	?>
<?php 
//$t= Yii::app()->db->createCommand("CALL sp_timetable(1, '".$tanggal->format('Y-m-d')."')")->queryAll();
IF(Yii::app()->session['kampus_id'] == 0 ){
	$t= Yii::app()->db->createCommand("CALL sp_timetable(1, '".$tanggal->format('Y-m-d')."')")->queryAll();
}ELSE{
	$t= Yii::app()->db->createCommand("CALL sp_timetable(".Yii::app()->session['kampus_id'].", '".$tanggal->format('Y-m-d')."')")->queryAll();
}
foreach($t as $t):;
$form=$this->beginWidget('CActiveForm', array(
						'id'=>'Bookguna-form',
					));
echo'				
	<div class="Row">
		<div class="Cell">
			'.CHtml::link($t['kelas'], array('/ComKelas/index', 'id'=>$t['kelas_id'])).$form->hiddenField($model,'kelas_id',array('value'=>$t['kelas_id'])).'
		</div>';
		
/*	IF($t['col1'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col1').'
		</div>';
		}ELSE{
		echo'
		<div class="Cellblock">
			'.$form->checkBox($model,'col1',array('disabled'=>'true')).'
		</div>';
	}
*/	
	IF($t['col2'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col2').'
		</div>';
		}ELSE{
			//$form->checkBox($model,'col2',array('disabled'=>'true'))
		echo'
		<div class="Cellblock">
			'.substr($t['col2'],0,6).'
		</div>';
	}
	IF($t['col3'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col3').'
		</div>';
		}ELSE{
			//$form->checkBox($model,'col2',array('disabled'=>'true'))
		echo'
		<div class="Cellblock">
			'.substr($t['col3'],0,6).'
		</div>';
	}
	IF($t['col4'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col4').'
		</div>';
		}ELSE{
			//$form->checkBox($model,'col2',array('disabled'=>'true'))
		echo'
		<div class="Cellblock">
			'.substr($t['col4'],0,6).'
		</div>';
	}
	IF($t['col5'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col5').'
		</div>';
		}ELSE{
			//$form->checkBox($model,'col2',array('disabled'=>'true'))
		echo'
		<div class="Cellblock">
			'.substr($t['col5'],0,6).'
		</div>';
	}
	IF($t['col6'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col6').'
		</div>';
		}ELSE{
			//$form->checkBox($model,'col2',array('disabled'=>'true'))
		echo'
		<div class="Cellblock">
			'.substr($t['col6'],0,6).'
		</div>';
	}
	IF($t['col7'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col7').'
		</div>';
		}ELSE{
			//$form->checkBox($model,'col2',array('disabled'=>'true'))
		echo'
		<div class="Cellblock">
			'.substr($t['col7'],0,6).'
		</div>';
	}
	IF($t['col8'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col8').'
		</div>';
		}ELSE{
			//$form->checkBox($model,'col2',array('disabled'=>'true'))
		echo'
		<div class="Cellblock">
			'.substr($t['col8'],0,6).'
		</div>';
	}
	IF($t['col9'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col9').'
		</div>';
		}ELSE{
			//$form->checkBox($model,'col2',array('disabled'=>'true'))
		echo'
		<div class="Cellblock">
			'.substr($t['col9'],0,6).'
		</div>';
	}
	IF($t['col10'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col10').'
		</div>';
		}ELSE{
			//$form->checkBox($model,'col2',array('disabled'=>'true'))
		echo'
		<div class="Cellblock">
			'.substr($t['col10'],0,6).'
		</div>';
	}
	IF($t['col11'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col11').'
		</div>';
		}ELSE{
			//$form->checkBox($model,'col2',array('disabled'=>'true'))
		echo'
		<div class="Cellblock">
			'.substr($t['col11'],0,6).'
		</div>';
	}
	IF($t['col12'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col12').'
		</div>';
		}ELSE{
			//$form->checkBox($model,'col2',array('disabled'=>'true'))
		echo'
		<div class="Cellblock">
			'.substr($t['col12'],0,6).'
		</div>';
	}
	IF($t['col13'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col13').'
		</div>';
		}ELSE{
			//$form->checkBox($model,'col2',array('disabled'=>'true'))
		echo'
		<div class="Cellblock">
			'.substr($t['col13'],0,6).'
		</div>';
	}
	IF($t['col14'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col14').'
		</div>';
		}ELSE{
			//$form->checkBox($model,'col2',array('disabled'=>'true'))
		echo'
		<div class="Cellblock">
			'.substr($t['col14'],0,6).'
		</div>';
	}
	IF($t['col15'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col15').'
		</div>';
		}ELSE{
			//$form->checkBox($model,'col2',array('disabled'=>'true'))
		echo'
		<div class="Cellblock">
			'.substr($t['col15'],0,6).'
		</div>';
	}
	IF($t['col16'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col16').'
		</div>';
		}ELSE{
			//$form->checkBox($model,'col2',array('disabled'=>'true'))
		echo'
		<div class="Cellblock">
			'.substr($t['col16'],0,6).'
		</div>';
	}
	IF($t['col17'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col17').'
		</div>';
		}ELSE{
			//$form->checkBox($model,'col2',array('disabled'=>'true'))
		echo'
		<div class="Cellblock">
			'.substr($t['col17'],0,6).'
		</div>';
	}
	IF($t['col18'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col18').'
		</div>';
		}ELSE{
			//$form->checkBox($model,'col2',array('disabled'=>'true'))
		echo'
		<div class="Cellblock">
			'.substr($t['col18'],0,6).'
		</div>';
	}
	IF($t['col19'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col19').'
		</div>';
		}ELSE{
			//$form->checkBox($model,'col2',array('disabled'=>'true'))
		echo'
		<div class="Cellblock">
			'.substr($t['col19'],0,6).'
		</div>';
	}
	IF($t['col20'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col20').'
		</div>';
		}ELSE{
			//$form->checkBox($model,'col2',array('disabled'=>'true'))
		echo'
		<div class="Cellblock">
			'.substr($t['col20'],0,6).'
		</div>';
	}
/*	IF($t['col21'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col21').'
		</div>';
		}ELSE{
			//$form->checkBox($model,'col2',array('disabled'=>'true'))
		echo'
		<div class="Cellblock">
			'.CHtml::link(substr($t['col21'],0,6), array('del', 'id'=>$t['kelas_id'].'-21-'.$tanggal->format('Y-m-d'))).'
		</div>';
	}
	IF($t['col22'] == NULL){
		echo'
		<div class="Cell">
			'.$form->checkBox($model,'col22').'
		</div>';
		}ELSE{
			//$form->checkBox($model,'col2',array('disabled'=>'true'))
		echo'
		<div class="Cellblock">
			'.CHtml::link(substr($t['col22'],0,6), array('del', 'id'=>$t['kelas_id'].'-22-'.$tanggal->format('Y-m-d'))).'
		</div>';
	}
*/
		IF(ISSET(Yii::app()->session['jurusan_id']) && ISSET(Yii::app()->session['semester'])){
			echo CHtml::activeDropDownList($model, 'mata_kuliah', $mk, array('prompt'=>'--', 'style'=>'width:50px'));
		}ELSE{
			echo'
			<div class="Cell">
				'.$form->textField($model,'mata_kuliah', array('style'=>'width:50px')).'
			</div>';
		}
		
		echo'
		<div class="Cell">
			'.CHtml::submitButton('Book').'
		</div>
	</div>
';
$this->endWidget();
endforeach;?>
</div>