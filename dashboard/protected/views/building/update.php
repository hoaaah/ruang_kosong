<?php
/* @var $this BuildingController */
/* @var $model Building */

$this->breadcrumbs=array(
	'Buildings'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Building', 'url'=>array('index')),
	array('label'=>'View Building', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>