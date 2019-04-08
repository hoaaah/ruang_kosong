<?php
/* @var $this AttributeController */
/* @var $model Attribute */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'attribute-form',
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
		<?php // echo $form->textField($model,'kampus_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'kampus_id', CHtml::listData(Kampus::model()->findAll(), 'id', 'name'), array('prompt'=>'--pilih Universitas--', 'class' => 'form-control'));?>
		<?php echo $form->error($model,'kampus_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kd_attrib'); ?>
		<?php echo $form->textField($model,'kd_attrib', array('class' => 'form-control')); ?>
                <i><span class="required">Level 1 (Universitas), 2(Gedung), 3(ruangan)</span></i>
		<?php echo $form->error($model,'kd_attrib'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'abbr'); ?>
		<?php echo $form->textField($model,'abbr',array('size'=>5,'maxlength'=>5, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'abbr'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->