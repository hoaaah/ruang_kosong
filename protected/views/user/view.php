<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model['name'],
);

$this->menu=array(
	array('label'=>'Ubah Data', 'url'=>array('update', 'id'=>$model->id)),
        array('label'=>'Ubah Password', 'url'=>array('ubahpwd', 'id'=>$model->id)),
	//array('label'=>'Preferensi Gedung', 'url'=>array('pr', 'id'=>$model->id)),
);
?>

<h1>View User #<?php echo $model->id; ?></h1>

<?php 
    IF($this->user_log['kampus_id'] != 0){  
        $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		[
                    'label'=> 'Kampus',
                    'value'=> $model->kampusid['name'],
                ],
		[
                    'label'=> 'Jurusan',
                    'value'=> $model->jurusanid['name'],
                ],
                'semester',
                //'kampus_id',
                //'jurusan_id',
		//'preferred_building',
		[
                    'label'=> 'Gedung Favorit',
                    'value'=> $model->buildingid == null ? "Not Set" : $model->buildingid['name'],
                ],
		'username',
		'email',
		'name',
		'sex',
		'kota_lahir',
		'tgl_lahir',
		'keterangan',
		'kelas',
		'image',
		'r_count',
	),));
    }ELSE{
          $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
                'kampus_id',
                'jurusan_id',
                'semester',
		'preferred_building',
		'username',
		'email',
		'name',
		'sex',
		'kota_lahir',
		'tgl_lahir',
		'keterangan',
		'kelas',
		'image',
		'r_count',
	),  ));    
    }
 ?>
<div class="form">
<?php IF($this->user_log['kampus_id']  != 0 ): ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'com-kelas-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Pilih Preferensi Gedung Anda, Gedung ini akan tampil dalam tampilan awal anda.</p>

	<?php echo $form->errorSummary($model); ?>
    
	
	<div class="row">
        <?php echo CHtml::activeDropDownList($model, 'preferred_building', CHtml::listData(Building::model()->findAll("kampus_id=".$model->kampus_id), 'id', 'name'), array('prompt'=>'--Preferred Building--')); ?>
		<?php echo $form->error($model,'preferred_building'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget();
ENDIF; ?>

</div><!-- form -->