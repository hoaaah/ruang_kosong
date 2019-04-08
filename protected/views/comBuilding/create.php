<?php
/* @var $this ComBuildingController */
/* @var $model ComBuilding */

$this->breadcrumbs=array(
	'Com Buildings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ComBuilding', 'url'=>array('index')),
	array('label'=>'Manage ComBuilding', 'url'=>array('admin')),
);
?>

<h1>Create ComBuilding</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>