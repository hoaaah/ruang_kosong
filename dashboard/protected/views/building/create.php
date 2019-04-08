<?php
/* @var $this BuildingController */
/* @var $model Building */

$this->breadcrumbs=array(
	'Buildings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Building', 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>