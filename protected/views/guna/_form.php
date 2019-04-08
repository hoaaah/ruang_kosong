<?php
/* @var $this GunaController */
/* @var $model Guna */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'guna-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kelas_id'); ?>
		<?php echo $form->textField($model,'kelas_id'); ?>
		<?php echo $form->error($model,'kelas_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DateCreate'); ?>
		<?php echo $form->textField($model,'DateCreate'); ?>
		<?php echo $form->error($model,'DateCreate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tanggal_guna'); ?>
		<?php echo $form->textField($model,'tanggal_guna'); ?>
		<?php echo $form->error($model,'tanggal_guna'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'session_id'); ?>
		<?php echo $form->textField($model,'session_id'); ?>
		<?php echo $form->error($model,'session_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mata_kuliah'); ?>
		<?php echo $form->textField($model,'mata_kuliah',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'mata_kuliah'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->