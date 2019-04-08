<?php
/* @var $this KampusController */
/* @var $model Kampus */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kampus-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'kode_ptn'); ?>
		<?php echo $form->textField($model,'kode_ptn',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kode_ptn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'inisial'); ?>
		<?php echo $form->textField($model,'inisial',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'inisial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'established'); ?>
		<?php echo $form->textField($model,'established'); ?>
		<?php echo $form->error($model,'established'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rektor'); ?>
		<?php echo $form->textField($model,'rektor',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'rektor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kota'); ?>
		<?php echo $form->textField($model,'kota',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'kota'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alamat'); ?>
		<?php echo $form->textField($model,'alamat',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'alamat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'website'); ?>
		<?php echo $form->textField($model,'website',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'website'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'keterangan'); ?>
		<?php echo $form->textField($model,'keterangan',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'keterangan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'logo'); ?>
		<?php echo $form->textField($model,'logo',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'logo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'akreditasi'); ?>
		<?php echo $form->textField($model,'akreditasi',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'akreditasi'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->