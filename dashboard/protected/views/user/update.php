<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Update User <?php echo $model->id; ?></h1>

<?php //$this->renderPartial('_form', array('model'=>$model)); ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'semester'); ?>
		<?php
                        $r=MataKuliah::model()->findAllBySql('SELECT jurusan_id, semester FROM r_mata_kuliah WHERE jurusan_id = :jurusan_id GROUP BY jurusan_id, semester',  array(':jurusan_id'=>(int) $model->jurusan_id));
                        echo CHtml::activeDropDownList($model, 'semester', CHtml::listData($r, 'semester', 'semester'), array('prompt'=>'-Semester-'));
//				echo $form->textField($model,'semester',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'semester'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sex'); ?>
		<?php echo CHtml::activeDropDownList($model, 'sex', array('L'=> 'Laki-Laki', 'P' => 'Perempuan'), array('prompt'=>'--no setengah botol--')); ?>
		<?php echo $form->error($model,'sex'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'peran'); ?>
		<?php
        $jk = array('3'=> 'Ketua Kelas', '4' => 'Ordinary');
		echo CHtml::activeDropDownList($model, 'peran', $jk, array('prompt'=>'--peran--')); 
		#echo CHtml::activeDropDownList($model, 'peran', array('3'=> 'Ketua Kelas', '4' => 'Ordinary'), array('prompt'=>'--peran--')); 
		?>
		<?php echo $form->error($model,'peran'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'kota_lahir'); ?>
		<?php echo $form->textField($model,'kota_lahir',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'kota_lahir'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tgl_lahir'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
							array(
								'attribute' => 'tgl_lahir',
								'language' => 'id',
								'model' => $model,
								'options' => array(
												'mode' => 'focus',
												'dateFormat' => 'yy-mm-dd',
												'showAnim' => 'slideDown',
												'changeMonth'=>'true',
												'yearRange'=>'1980:2020', 
                       							'changeYear'=>'true',
											),
								'htmlOptions' => array('size' => 30, 'class' => 'date'),)
							); ?>
		<?php echo $form->error($model,'tgl_lahir'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact'); ?>
		<?php echo $form->textField($model,'contact',array('size'=>20,'maxlength'=>20)); ?>
        <i><span class="required">Nomor anda hanya dapat dilihat oleh user dengan peran Ketua Kelas.</span></i>		
		<?php echo $form->error($model,'kelas'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kelas'); ?>
		<?php echo $form->textField($model,'kelas',array('size'=>6,'maxlength'=>6)); ?>
        <i><span class="required">Only 6 char allowed.</span></i>		
		<?php echo $form->error($model,'kelas'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'keterangan'); ?>
		<?php echo $form->textField($model,'keterangan',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'keterangan'); ?>
	</div>
	<div class="row">
		<?php // echo $form->checkBox($model,'tos'); echo '   ';?>
        <i><span class="required">Dengan ini saya menyetujui .</span></i>
	</div>    
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->