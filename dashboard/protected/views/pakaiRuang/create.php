<?php
/* @var $this PakaiRuangController */
/* @var $model RGuna */

$this->breadcrumbs=array(
	'Rgunas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RGuna', 'url'=>array('index')),
	array('label'=>'Manage RGuna', 'url'=>array('admin')),
);
?>

<h1>Create RGuna</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>