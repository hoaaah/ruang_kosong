<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>
     <div class="row">
        <?php // echo CHtml::activeLabelEx($model,'files'); ?>
        <?php // echo $form->fileField($model,'files') ?>
		<?php // echo $form->error($model,'files'); ?>        
    </div> 	
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
        <?php echo CHtml::activeLabelEx($model,'kampus_id', array('label' => 'Universitas')); ?>
        <?php // echo CHtml::activeDropDownList($model, 'kampus_id', CHtml::listData(Kampus::model()->findAll(), 'id', 'name'), array('prompt'=>'--pilih Universitas--'));
			echo CHtml::dropDownList('User[kampus_id]','', 
			CHtml::listData(Kampus::model()->findAll(), 'id', 'name'),
				  array(
					'prompt'=>'--pilih Universitas--',
					'ajax' => array(
						'type'=>'POST', 
						'url'=>Yii::app()->createUrl('User/loadjurusan'), //or $this->createUrl('loadcities') if '$this' extends CController
						'update'=>'#User_jurusan_id', //or 'success' => 'function(data){...handle the data in the way you want...}',
						'data'=>array('kampus_id'=>'js:this.value'),
				  		)
					)); 			
		
		?>
        <i><span class="required">Belum ada? Silahkan mendaftar kampus anda.</span></i>
		<?php echo $form->error($model,'kampus_id'); ?> 
	</div>

	<div class="row">
        <?php echo CHtml::activeLabelEx($model,'jurusan_id', array('label' => 'Jurusan')); ?>
        <?php // echo CHtml::activeDropDownList($model, 'jurusan_id', CHtml::listData(Jurusan::model()->findAll(), 'id', 'name'), array('prompt'=>'--Jurusan(opsional bagi non-STAN)--'));
				echo CHtml::dropDownList('User[jurusan_id]','', array(),
							array(
								'prompt'=>'--Jurusan(opsional bagi non-STAN)--',
								'ajax' => array(
									'type'=>'POST', 
									'url'=>Yii::app()->createUrl('User/loadsemester'), //or $this->createUrl('loadcities') if '$this' extends CController
									'update'=>'#User_semester', //or 'success' => 'function(data){...handle the data in the way you want...}',
									'data'=>array('jurusan_id'=>'js:this.value'),	
								)							
							));
		
		 ?>
        <i><span class="required">Mahasiswa STAN wajib mengisi.</span></i>
		<?php echo $form->error($model,'kampus_id'); ?> 
	</div>	

	<div class="row">
		<?php echo $form->labelEx($model,'semester'); ?>
		<?php
				echo CHtml::dropDownList('User[semester]','', array(), array('prompt'=>'--Semester--'));
//				echo $form->textField($model,'semester',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'semester'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sex'); ?>
		<?php echo CHtml::activeDropDownList($model, 'sex', array('L'=> 'Laki-Laki', 'P' => 'Perempuan'), array('prompt'=>'--Jenis Kelamin--')); ?>
		<?php echo $form->error($model,'sex'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'peran'); ?>
		<?php
                IF($this->user_log['peran'] <= 1){
                    $jk = array('1' => 'Administrator Kampus', '2' => 'Supervisor Kampus','3'=> 'Ketua Kelas');
                }ELSE{
                    $jk = array('2' => 'Supervisor Kampus','3'=> 'Ketua Kelas');
                }
		echo CHtml::activeDropDownList($model, 'peran', $jk, array('prompt'=>'--peran--')); 
		#echo CHtml::activeDropDownList($model, 'peran', array('3'=> 'Ketua Kelas', '4' => 'Ordinary'), array('prompt'=>'--peran--')); 
		?>
		<?php echo $form->error($model,'peran'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'kota_lahir'); ?>
		<?php echo $form->textField($model,'kota_lahir',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'kota_lahir'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tgl_lahir'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
							array(
								'attribute' => 'tgl_lahir',
								'language' => 'id',
								'model' => $model,
								'options' => array(
												'mode' => 'focus',
												'dateFormat' => 'yy-mm-dd',
												'showAnim' => 'slideDown',
												'changeMonth'=>'true',
												'yearRange'=>'1980:2020', 
                       							'changeYear'=>'true',
											),
								'htmlOptions' => array('size' => 30, 'class' => 'date'),)
							); ?>
		<?php echo $form->error($model,'tgl_lahir'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact'); ?>
		<?php echo $form->textField($model,'contact',array('size'=>20,'maxlength'=>20)); ?>
        <i><span class="required">Nomor anda hanya dapat dilihat oleh user dengan peran Ketua Kelas.</span></i>		
		<?php echo $form->error($model,'kelas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kelas'); ?>
		<?php echo $form->textField($model,'kelas',array('size'=>6,'maxlength'=>6)); ?>
        <i><span class="required">Only 6 char allowed.</span></i>		
		<?php echo $form->error($model,'kelas'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->