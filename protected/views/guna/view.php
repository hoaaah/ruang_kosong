<?php
/* @var $this GunaController */
/* @var $model Guna */

$this->breadcrumbs=array(
	'Gunas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Guna', 'url'=>array('index')),
	array('label'=>'Create Guna', 'url'=>array('create')),
	array('label'=>'Update Guna', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Guna', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Guna', 'url'=>array('admin')),
);
?>

<h1>View Guna #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'kelas_id',
		'DateCreate',
		'tanggal_guna',
		'session_id',
		'mata_kuliah',
	),
)); ?>
