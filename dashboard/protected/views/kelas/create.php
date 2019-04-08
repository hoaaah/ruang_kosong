<?php
/* @var $this KelasController */
/* @var $model Kelas */

$this->breadcrumbs=array(
	'Building'=>array('building/index'),    
	'Kelas'=>array('index'),
	'Create',
);

$this->menu=array(
//	array('label'=>'List Kelas', 'url'=>array('index')),
);
?>
 
<?php $this->renderPartial('_form', array('model'=>$model)); ?>