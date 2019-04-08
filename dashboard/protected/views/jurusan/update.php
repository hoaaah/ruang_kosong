<?php
/* @var $this JurusanController */
/* @var $model Jurusan */

$this->breadcrumbs=array(
	'Jurusan'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Jurusan', 'url'=>array('index')),
	array('label'=>'View Jurusan', 'url'=>array('view', 'id'=>$model->id)),
);
?>
 

<?php $this->renderPartial('_form', array('model'=>$model)); ?>