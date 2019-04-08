<?php
/* @var $this GunaController */
/* @var $model Guna */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kelas_id'); ?>
		<?php echo $form->textField($model,'kelas_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DateCreate'); ?>
		<?php echo $form->textField($model,'DateCreate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tanggal_guna'); ?>
		<?php echo $form->textField($model,'tanggal_guna'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'session_id'); ?>
		<?php echo $form->textField($model,'session_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mata_kuliah'); ?>
		<?php echo $form->textField($model,'mata_kuliah',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->