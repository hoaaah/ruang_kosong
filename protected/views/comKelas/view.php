<?php
/* @var $this ComKelasController */
/* @var $model ComKelas */

$this->breadcrumbs=array(
	'Com Kelases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ComKelas', 'url'=>array('index')),
	array('label'=>'Create ComKelas', 'url'=>array('create')),
	array('label'=>'Update ComKelas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ComKelas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ComKelas', 'url'=>array('admin')),
);
?>

<h1>View ComKelas #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'kelas_id',
		'user_id',
		'created',
		'updated',
		'comment',
		'image',
		'attend_id',
	),
)); ?>
