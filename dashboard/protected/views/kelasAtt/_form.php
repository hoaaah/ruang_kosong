<?php
/* @var $this KelasAttController */
/* @var $model KelasAtt */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kelas-att-form',
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
		<?php echo $form->labelEx($model,'kelas_id'); ?>
		<?php echo $form->textField($model,'kelas_id', array('class' => 'form-control')); ?>
                <?php echo CHtml::activeDropDownList($model, 'kelas_id', CHtml::listData(Kelas::model()->findAll(), 'id', 'name'), array('prompt'=>'--Pilih Kelas--', 'class' => 'form-control'));?>
		<?php echo $form->error($model,'kelas_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'attrib_id'); ?>
		<?php echo $form->textField($model,'attrib_id', array('class' => 'form-control')); ?>
		<?php echo $form->error($model,'attrib_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DateCreate'); ?>
		<?php echo $form->textField($model,'DateCreate'); ?>
		<?php echo $form->error($model,'DateCreate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->