<?php
/* @var $this MataKuliahController */
/* @var $model MataKuliah */

$this->breadcrumbs=array(
	'Mata Kuliah'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MataKuliah', 'url'=>array('index')),
);
?>

<h1>Create MataKuliah</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>