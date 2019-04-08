<?php
/* @var $this MataKuliahController */
/* @var $model MataKuliah */

$this->breadcrumbs=array(
	'Mata Kuliahs'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MataKuliah', 'url'=>array('index')),
	array('label'=>'Create MataKuliah', 'url'=>array('create')),
	array('label'=>'View MataKuliah', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MataKuliah', 'url'=>array('admin')),
);
?>

<h1>Update MataKuliah <?php echo $model->id; ?></h1>

<?php // $this->renderPartial('_form', array('model'=>$model)); ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mata-kuliah-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'kampus_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'kampus_id', CHtml::listData(Kampus::model()->findAll(), 'id', 'name'), array('prompt'=>'--pilih Universitas--')); ?>
		<?php echo $form->error($model,'kampus_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jurusan_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'jurusan_id', CHtml::listData(Jurusan::model()->findAll(), 'id', 'name'), array('prompt'=>'--pilih Jurusan--')); ?>
		<?php echo $form->error($model,'jurusan_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'semester'); ?>
		<?php echo $form->textField($model,'semester'); ?>
		<?php echo $form->error($model,'semester'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dosen'); ?>
		<?php echo $form->textField($model,'dosen',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'dosen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kategori'); ?>
		<?php echo $form->textField($model,'kategori'); ?>
		<?php echo $form->error($model,'kategori'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dasar_hukum'); ?>
		<?php echo $form->textField($model,'dasar_hukum',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'dasar_hukum'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->