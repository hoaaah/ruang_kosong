<?php
/* @var $this ComBuildingController */
/* @var $model ComBuilding */

$this->breadcrumbs=array(
	'Com Buildings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ComBuilding', 'url'=>array('index')),
	array('label'=>'Create ComBuilding', 'url'=>array('create')),
	array('label'=>'Update ComBuilding', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ComBuilding', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ComBuilding', 'url'=>array('admin')),
);
?>

<h1>View ComBuilding #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'building_id',
		'user_id',
		'created',
		'updated',
		'comment',
		'image',
		'attend_id',
	),
)); ?>
