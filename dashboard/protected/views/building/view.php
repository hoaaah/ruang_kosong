<?php
/* @var $this BuildingController */
/* @var $model Building */

$this->breadcrumbs=array(
	'Buildings'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Building', 'url'=>array('index')),
	array('label'=>'Update Building', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Building', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
                [
                    'label'=> 'Universitas',
                    'value'=> $model->kampusid->name,
                ],            
		'name',
		'alias',
		'jurusan',
		'image',
	),
)); ?>
