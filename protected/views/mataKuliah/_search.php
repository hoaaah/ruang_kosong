<?php
/* @var $this MataKuliahController */
/* @var $model MataKuliah */
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
		<?php echo $form->label($model,'kampus_id'); ?>
		<?php echo $form->textField($model,'kampus_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jurusan_id'); ?>
		<?php echo $form->textField($model,'jurusan_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'semester'); ?>
		<?php echo $form->textField($model,'semester'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated'); ?>
		<?php echo $form->textField($model,'updated'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dosen'); ?>
		<?php echo $form->textField($model,'dosen',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kategori'); ?>
		<?php echo $form->textField($model,'kategori'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dasar_hukum'); ?>
		<?php echo $form->textField($model,'dasar_hukum',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->