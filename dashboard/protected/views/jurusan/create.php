<?php
/* @var $this JurusanController */
/* @var $model Jurusan */

$this->breadcrumbs=array(
	'Jurusan'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Jurusan', 'url'=>array('index')),
);
?>
 

<?php $this->renderPartial('_form', array('model'=>$model)); ?>