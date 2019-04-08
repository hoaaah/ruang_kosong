<?php
/* @var $this MataKuliahController */
/* @var $model MataKuliah */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mata-kuliah-form',
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
			echo CHtml::dropDownList('MataKuliah[kampus_id]','', 
			CHtml::listData(Kampus::model()->findAll(), 'id', 'name'),
				  array(
                                        'class' => 'form-control',
					'prompt'=>'--pilih Universitas--',
					'ajax' => array(
						'type'=>'POST', 
						'url'=>Yii::app()->createUrl('MataKuliah/loadjurusan'), //or $this->createUrl('loadcities') if '$this' extends CController
						'update'=>'#MataKuliah_jurusan_id', //or 'success' => 'function(data){...handle the data in the way you want...}',
						'data'=>array('kampus_id'=>'js:this.value'),
				  		)
					)); 			
		
		?>
		<?php echo $form->error($model,'kampus_id'); ?> 
	</div>

	<div class="row">
        <?php echo CHtml::activeLabelEx($model,'jurusan_id', array('label' => 'Jurusan')); ?>
        <?php // echo CHtml::activeDropDownList($model, 'jurusan_id', CHtml::listData(Jurusan::model()->findAll(), 'id', 'name'), array('prompt'=>'--Jurusan(opsional bagi non-STAN)--'));
				echo CHtml::dropDownList('MataKuliah[jurusan_id]','', array(),
							array(
                                                                'class' => 'form-control',
								'prompt'=>'--Jurusan(opsional bagi non-STAN)--',
								'ajax' => array(
									'type'=>'POST', 
									'url'=>Yii::app()->createUrl('MataKuliah/loadsemester'), //or $this->createUrl('loadcities') if '$this' extends CController
									'update'=>'#MataKuliah_semester', //or 'success' => 'function(data){...handle the data in the way you want...}',
									'data'=>array('jurusan_id'=>'js:this.value'),	
								)							
							));
		
		 ?>
		<?php echo $form->error($model,'kampus_id'); ?> 
	</div>	

	<div class="row">
		<?php echo $form->labelEx($model,'semester'); ?>
		<?php
				echo CHtml::dropDownList('MataKuliah[semester]','', array(), array('class' => 'form-control','prompt'=>'--Semester--'));
//				echo $form->textField($model,'semester',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'semester'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('class' => 'form-control', 'size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'dasar_hukum'); ?>
		<?php echo $form->textField($model,'dasar_hukum',array('class' => 'form-control', 'size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'dasar_hukum'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->