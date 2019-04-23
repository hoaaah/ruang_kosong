<?php
/* @var $this PakaiRuangController */
/* @var $model RGuna */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rguna-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'approver'); ?>
		<?php echo $form->textField($model,'approver',array('class' => 'form form-control', 'size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'approver'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'approval_date'); ?>
		<?php echo $form->textField($model,'approval_date', ['class' => 'form form-control']); ?>
		<?php echo $form->error($model,'approval_date'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->