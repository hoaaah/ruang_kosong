<?php
/* @var $this ComBuildingController */
/* @var $model ComBuilding */

$this->breadcrumbs=array(
	'Com Buildings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ComBuilding', 'url'=>array('index')),
	array('label'=>'Create ComBuilding', 'url'=>array('create')),
	array('label'=>'View ComBuilding', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ComBuilding', 'url'=>array('admin')),
);
?>

<h1>Update ComBuilding <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>