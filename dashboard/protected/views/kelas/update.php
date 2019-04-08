<?php
/* @var $this KelasController */
/* @var $model Kelas */

$this->breadcrumbs=array(
	'Building'=>array('building/index'),    
	'Kelases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'View Kelas', 'url'=>array('view', 'id'=>$model->id)),
);
?>
 

<?php $this->renderPartial('_form', array('model'=>$model)); ?>