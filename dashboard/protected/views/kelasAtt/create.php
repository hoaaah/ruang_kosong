<?php
/* @var $this KelasAttController */
/* @var $model KelasAtt */

$this->breadcrumbs=array(
	'Kelas Atts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List KelasAtt', 'url'=>array('index')),
	array('label'=>'Manage KelasAtt', 'url'=>array('admin')),
);
?>
 
<?php $this->renderPartial('_form', array('model'=>$model)); ?>