<?php
/* @var $this PakaiRuangController */
/* @var $model RGuna */
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
		<?php echo $form->label($model,'session_length'); ?>
		<?php echo $form->textField($model,'session_length',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mata_kuliah'); ?>
		<?php echo $form->textField($model,'mata_kuliah',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dari'); ?>
		<?php echo $form->textField($model,'dari',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jumlah_peserta'); ?>
		<?php echo $form->textField($model,'jumlah_peserta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'penanggung_jawab'); ?>
		<?php echo $form->textField($model,'penanggung_jawab',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'konsumsi'); ?>
		<?php echo $form->textField($model,'konsumsi'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tor_kak'); ?>
		<?php echo $form->textField($model,'tor_kak'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'approver'); ?>
		<?php echo $form->textField($model,'approver',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'approval_date'); ?>
		<?php echo $form->textField($model,'approval_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'catatan'); ?>
		<?php echo $form->textField($model,'catatan',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'yang_mengajukan'); ?>
		<?php echo $form->textField($model,'yang_mengajukan',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jumlah_hari'); ?>
		<?php echo $form->textField($model,'jumlah_hari'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->