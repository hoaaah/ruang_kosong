<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Create User</h1>

<?php
print_r($this->log_pegawai);

 ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'bidang_id'); ?>
		<?php echo $form->textField($model,'bidang_id',array('size'=>2,'maxlength'=>2, 'disabled' => true, 'value'=> $data_user['0']['bidang_id'],)); ?>
		<?php echo $form->error($model,'bidang_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>40,'maxlength'=>40, 'disabled' => true, 'value'=> $data_user['0']['nip'],
		//'readonly' => true , 'disabled' => true
		)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>40,'maxlength'=>40, 'disabled' => true, 'value'=> $data_user['0']['name'],)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'keterangan'); ?>
		<?php echo $form->textField($model,'keterangan',array('size'=>50,'maxlength'=>50, 'disabled' => true, 'value'=> $data_user['0']['jabatan'],)); ?>
		<?php echo $form->error($model,'keterangan'); ?>
	</div>
<!--
	<div class="row">
		<?php echo $form->labelEx($model,'salt'); ?>
		<?php echo $form->textField($model,'salt',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'salt'); ?>
	</div>
  -->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form --> 