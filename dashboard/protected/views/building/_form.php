<?php
/* @var $this BuildingController */
/* @var $model Building */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'building-form',
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
		<?php echo $form->labelEx($model,'kampus_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'kampus_id', CHtml::listData(Kampus::model()->findAll(), 'id', 'name'), array('class' => 'form-control', 'prompt'=>'--pilih Universitas--'));?>
		<?php echo $form->error($model,'kampus_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alias'); ?>
		<?php echo $form->textField($model,'alias',array('size'=>60,'maxlength'=>100, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'alias'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->