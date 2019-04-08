<?php
/* @var $this AttributeController */
/* @var $model Attribute */

$this->breadcrumbs=array(
	'Attributes'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Attribute', 'url'=>array('index')),
	array('label'=>'Create Attribute', 'url'=>array('create')),
	array('label'=>'View Attribute', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Attribute', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>