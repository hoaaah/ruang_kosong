<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
    	array('label'=>'Ubah Pwd User Ini', 'url'=>array('ubahpwd', 'id'=>$model->id)),
);
?>

<h1>View User #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'kampus_id',
		'username',
		'password',
		'name',
		'keterangan',
		'salt',
	),
)); ?>
