<?php
/* @var $this ComKelasController */
/* @var $model ComKelas */

$this->breadcrumbs=array(
	'Com Kelases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ComKelas', 'url'=>array('index')),
	array('label'=>'Manage ComKelas', 'url'=>array('admin')),
);
?>

<h1>Create ComKelas</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>