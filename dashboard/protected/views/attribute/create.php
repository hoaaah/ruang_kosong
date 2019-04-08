<?php
/* @var $this AttributeController */
/* @var $model Attribute */

$this->breadcrumbs=array(
	'Attributes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Attribute', 'url'=>array('index')),
	array('label'=>'Manage Attribute', 'url'=>array('admin')),
);
?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>