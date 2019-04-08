<?php
/* @var $this AttributeController */
/* @var $model Attribute */

$this->breadcrumbs=array(
	'Attributes'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Attribute', 'url'=>array('index')),
	array('label'=>'Create Attribute', 'url'=>array('create')),
	array('label'=>'Update Attribute', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Attribute', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Attribute', 'url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		[
                    'label'=> 'Kampus',
                    'value'=> $model->kampusid->name,
                ],
		'kd_attrib',
		'name',
		'abbr',
		'created',
		'updated',
		'user_id',
	),
)); ?>
