<?php
/* @var $this KelasAttController */
/* @var $model KelasAtt */

$this->breadcrumbs=array(
	'Kelas Atts'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List KelasAtt', 'url'=>array('index')),
	array('label'=>'Create KelasAtt', 'url'=>array('create')),
	array('label'=>'Update KelasAtt', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete KelasAtt', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage KelasAtt', 'url'=>array('admin')),
);
?>
 

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'kelas_id',
		'attrib_id',
		'name',
		'DateCreate',
		'user_id',
	),
)); ?>
