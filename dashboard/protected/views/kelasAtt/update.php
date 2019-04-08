<?php
/* @var $this KelasAttController */
/* @var $model KelasAtt */

$this->breadcrumbs=array(
	'Kelas Atts'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List KelasAtt', 'url'=>array('index')),
	array('label'=>'Create KelasAtt', 'url'=>array('create')),
	array('label'=>'View KelasAtt', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage KelasAtt', 'url'=>array('admin')),
);
?>
 
<?php $this->renderPartial('_form', array('model'=>$model)); ?>