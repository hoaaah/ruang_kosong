<?php
/* ---------------------------- AWAL BAGIAN FWD ------------------------------*/
$gridDataProvider = new CArrayDataProvider($fwdtbl, array('keyField' => 'id','pagination'=>array('pageSize'=> 20,)));
// $gridColumns
$gridColumns = array(
	array('name'=>'jam', 'header'=>'Sesi'),
	array('name'=>'mata_kuliah', 'header'=>'Kegiatan'),
	array('name'=>'kelas', 'header'=>'Ruang'),
//	array('name'=>'hapus', 'header'=>'Aksi', 'type' => 'raw',  'value' =>'CHtml::link("Bantal ".CHtml::image(Yii::app()->request->baseUrl."/images/delete.png"),Yii::app()->createUrl("user/bantal", array("id"=>$data["id"])))', 'htmlOptions'=>array('nowrap' =>'nowrap', 'onclick' =>"js:alert('Yakin menghapus?')")),
	array('name'=>'hapus', 'header'=>'Aksi', 'type' => 'raw',  'value' =>'CHtml::link("Bantal ".CHtml::image(Yii::app()->request->baseUrl."/images/delete.png"),Yii::app()->createUrl("user/bantal", array("id"=>$data["id"])))', 'htmlOptions'=>array('nowrap' =>'nowrap', 'onclick' =>"return confirm('Anda yakin?');")),


//	array('name'=>'hapus', 'header'=>'Aksi', 'type' => 'raw',  'value' =>'CHtml::link("Bantal ".CHtml::image(Yii::app()->request->baseUrl."/images/delete.png"),"#")', 'htmlOptions'=>array('nowrap' =>'nowrap', 'onclick' =>"theVar=confirm('Do You Really Want to go to Google?');setTimeout('if(theVar){window.location=\'Yii::app()->createUrl(\'user/bantal\', array(\'id\' => \$data[\'id\']))\'}', 0);")),	
	
	
);
ob_start();
$this->widget(
    'booster.widgets.TbGridView',
    array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $gridDataProvider,
        'template' => "{items}\n{pager}",
        'columns' => $gridColumns,
    )
);
$fwd = ob_get_contents();
ob_end_clean();
/* ---------------------------- AKHIR BAGIAN FWD------------------------------*/
/* ---------------------------- AWAL BAGIAN Batal ------------------------------*/
$gridDataProvider = new CArrayDataProvider($c, array('keyField' => 'id','pagination'=>array('pageSize'=> 20,)));
// $gridColumns
$gridColumns = array(
	array('name'=>'kelas', 'header'=>'Kelas', 'htmlOptions'=>array('style'=>'width: 60px')),
	array('name'=>'ruang', 'header'=>'Ruang'),
        array('name'=>'jam', 'header'=>'Mulai'),
        array('name'=>'session_length', 'header'=>'Sesi'),
	//array('name'=>'created', 'header'=>'Tanggal', 'value' => 'number_format($data["created"],2,",",".")',  'htmlOptions'=>array('style'=>'text-align:right')),
);
ob_start();
$this->widget(
    'booster.widgets.TbGridView',
    array(
        'type' => 'condensed',
        'dataProvider' => $gridDataProvider,
        'template' => "{items}\n{pager}",
        'columns' => $gridColumns,
    )
);
echo '<p><em style="font-size:x-small; color:#00F; text-align:end">Sesi dimulai dari pukul 07.30 (Sesi 2). Jadwal yang dibatalkan dapat sudah digunakan oleh kelas lain. Pastikan kembali ketersediaan jadwal dengan menghubungi kelas bersangkutan melalui "contact list"</em><br>';
$table_anggaran0 = ob_get_contents();
ob_end_clean();
/* ---------------------------- AKHIR BAGIAN Batal------------------------------*/
/* ---------------------------- AWAL BAGIAN Reminder------------------------------*/
ob_start();
foreach ($notif as $notif){
    echo '<div class="alert alert-danger" role="alert">'.$notif['content'].'</div>';
}
$reminder = ob_get_contents();
ob_end_clean();
/* ---------------------------- AKHIR BAGIAN Reminder------------------------------*/
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
$this->widget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Jadwal '.$hari.', '.$tanggal->format('d M Y'),
    	'context' => 'success',
        'headerIcon' => 'refresh',
        'content' => $fwd
    )
);
$this->widget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Jadwal yang dibatalkan pada '.$hari.', '.$tanggal->format('d M Y'),
    	'context' => 'success',
        'headerIcon' => 'refresh',
        'content' => $table_anggaran0
    )
);
$this->widget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Reminder '.$hari.', '.$tanggal->format('d M Y'),
    	'context' => 'success',
        'headerIcon' => 'refresh',
        'content' => $reminder
    )
);
?>

<style>
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
<div class="form">
<?php IF($this->user_log['kampus_id'] != 0 && isset($pg)  ): ?>  
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'com-kelas-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>	
	<div class="row">
        <?php echo CHtml::activeDropDownList($pg, 'preferred_building', CHtml::listData(Building::model()->findAll("kampus_id=".$this->user_log['kampus_id']), 'id', 'name'), array('prompt'=>'-Gedung-')); ?>
		<?php echo $form->error($pg,'preferred_building'); ?>
                <?php echo CHtml::submitButton($pg->isNewRecord ? 'Pilih' : 'Save'); ?>    
                <?php echo CHtml::button('Tampilkan Semua', array('onclick' => 'js:document.location.href="index.php?r=site/indexg"')); ?>
                <?php // echo $this->user_log['preferred_building']; ?>              
	</div>

<?php $this->endWidget();
ENDIF; ?>

</div><!-- form --> 
<div class="Table">
	<div class="Title">
		<p>POLITEKNIK KEUANGAN NEGARA - STAN <?php IF(isset($this->user_log['preferred_building'])) echo ' (Gedung '.$gd['0']['name'].')' ?></p>
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
						array('label' => '2w','buttonType'=> 'link', 'url' => array('day', 'id' => ($id-14))),
						array('label' => '1w','buttonType'=> 'link', 'url' => array('day', 'id' => ($id-7))),
						array('label' => '3d','buttonType'=> 'link', 'url' => array('day', 'id' => ($id-3))),
						array('label' => '<','buttonType'=> 'link', 'url' => array('day', 'id' => ($id-1))),
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
						array('label' => '2w','buttonType'=> 'link', 'url' => array('day', 'id' => (-14))),
						array('label' => '1w','buttonType'=> 'link', 'url' => array('day', 'id' => (-7))),
						array('label' => '3d','buttonType'=> 'link', 'url' => array('day', 'id' => (-3))),
						array('label' => '<','buttonType'=> 'link', 'url' => array('day', 'id' => (-1))),
					),
				)
			);
			echo '</div>';
		  
	  }
	  ?>
	  
		  <div class="col-md-4" style="text-align:center"><?php 
		  echo $hari.', '.$tanggal->format('d M Y');?></div>
	  <?php 
      IF(isset($id)){
		  echo'
          <div class="col-md-4" style="text-align:center">';
			$this->widget(
				'booster.widgets.TbButtonGroup',
				array(
					'buttons' => array(
						array('label' => '>','buttonType'=> 'link', 'url' => array('day', 'id' => ($id+1))),
						array('label' => '3d','buttonType'=> 'link', 'url' => array('day', 'id' => ($id+3))),
						array('label' => '1w','buttonType'=> 'link', 'url' => array('day', 'id' => ($id+7))),
						array('label' => '2w','buttonType'=> 'link', 'url' => array('day', 'id' => ($id+14))),
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
						array('label' => '>','buttonType'=> 'link', 'url' => array('day', 'id' => (1))),
						array('label' => '3d','buttonType'=> 'link', 'url' => array('day', 'id' => (3))),
						array('label' => '1w','buttonType'=> 'link', 'url' => array('day', 'id' => (7))),
						array('label' => '2w','buttonType'=> 'link', 'url' => array('day', 'id' => (14))),
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
foreach($t as $t):;
	$form=$this->beginWidget('CActiveForm', array(
							'id'=>'Bookguna-form',
						));
	echo'				
		<div class="Row">
			<div class="Cell">
				'.CHtml::link($t['kelas'], array('/ComKelas/index', 'id'=>$t['kelas_id'])).$form->hiddenField($model,'kelas_id',array('value'=>$t['kelas_id'])).'
			</div>';
			
	/*	IF($t['col1'] == NULL && !$checkRuangBidang){
			echo'
			<div class="Cell">
				'.$form->checkBox($model,'col1').'
			</div>';
			}ELSE{
			echo'
			<div class="Cellbalock">
				'.$form->checkBox($model,'col1',array('disabled'=>'true')).'
			</div>';
		}
	*/	
		$checkRuangBidang = RKelas::model()->find('ruang_bidang = 1 AND id = :kelas_id', [':kelas_id' => $t['kelas_id']]);
		
		IF($t['col2'] == NULL && !$checkRuangBidang){
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
		IF($t['col3'] == NULL && !$checkRuangBidang){
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
		IF($t['col4'] == NULL && !$checkRuangBidang){
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
		IF($t['col5'] == NULL && !$checkRuangBidang){
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
		IF($t['col6'] == NULL && !$checkRuangBidang){
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
		IF($t['col7'] == NULL && !$checkRuangBidang){
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
		IF($t['col8'] == NULL && !$checkRuangBidang){
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
		IF($t['col9'] == NULL && !$checkRuangBidang){
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
		IF($t['col10'] == NULL && !$checkRuangBidang){
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
		IF($t['col11'] == NULL && !$checkRuangBidang){
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
		IF($t['col12'] == NULL && !$checkRuangBidang){
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
		IF($t['col13'] == NULL && !$checkRuangBidang){
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
		IF($t['col14'] == NULL && !$checkRuangBidang){
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
		IF($t['col15'] == NULL && !$checkRuangBidang){
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
		IF($t['col16'] == NULL && !$checkRuangBidang){
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
		IF($t['col17'] == NULL && !$checkRuangBidang){
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
		IF($t['col18'] == NULL && !$checkRuangBidang){
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
		IF($t['col19'] == NULL && !$checkRuangBidang){
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
		IF($t['col20'] == NULL && !$checkRuangBidang){
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
		// IF(ISSET($this->user_log['jurusan_id']) && ISSET($this->user_log['semester'])){
		// 	echo CHtml::activeDropDownList($model, 'mata_kuliah', $mk, array('prompt'=>'--', 'style'=>'width:50px'));
		// }ELSE{
		// 	echo'
		// 	<div class="Cell">
		// 		'.$form->textField($model,'mata_kuliah', array('style'=>'width:50px')).'
		// 	</div>';
		// }
		echo'
				<!-- <div class="Cell">
					'.CHtml::submitButton('Book').'
				</div> -->
			</div>
		';
	$this->endWidget();
endforeach;?>
</div>
<?php 
Yii::app()->clientScript->registerScript('myjquery', <<<JS
	$('form#Bookguna-form').on('beforeSubmit',function(e)
	{
		// alert("data");
		// var \$form = $(this);
		// $.post(
		// 	\$form.attr("action"), //serialize Yii2 form 
		// 	\$form.serialize()
		// )
		// 	.done(function(result){
		// 		if(result == 1)
		// 		{
		// 			$("#myModalubah").modal('hide'); //hide modal after submit
		// 			//$(\$form).trigger("reset"); //reset form to reuse it to input
		// 			$.pjax.reload({container:'#sekolah-pjax'});
		// 		}else
		// 		{
		// 			$("#message").html(result);
		// 		}
		// 	}).fail(function(){
		// 		console.log("server error");
		// 	});
		// return false;
	});
JS
// , CClientScript::POS_END
);
?>
