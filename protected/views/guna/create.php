<?php
/* @var $this GunaController */
/* @var $model Guna */

$this->breadcrumbs=array(
	'Gunas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Guna', 'url'=>array('index')),
	array('label'=>'Manage Guna', 'url'=>array('admin')),
);
?>

<h1>Create Guna</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>