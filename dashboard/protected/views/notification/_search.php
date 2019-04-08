<?php
/* @var $this NotificationController */
/* @var $model Notification */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tag'); ?>
		<?php echo $form->textField($model,'tag',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'content'); ?>
		<?php echo $form->textField($model,'content',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgl_mulai'); ?>
		<?php echo $form->textField($model,'tgl_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tgl_selesai'); ?>
		<?php echo $form->textField($model,'tgl_selesai'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->