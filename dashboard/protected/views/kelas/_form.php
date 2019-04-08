<?php
/* @var $this KelasController */
/* @var $model Kelas */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kelas-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form-group',
	),    
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'building_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'building_id', CHtml::listData(Building::model()->findAll(), 'id', 'name'), array('prompt'=>'--Pilih Gedung--', 'class' => 'form-control'));?>
		<?php echo $form->error($model,'building_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kelas'); ?>
		<?php echo $form->textField($model,'kelas',array('size'=>20,'maxlength'=>20, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'kelas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alias'); ?>
		<?php echo $form->textField($model,'alias',array('size'=>50,'maxlength'=>50, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'alias'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->