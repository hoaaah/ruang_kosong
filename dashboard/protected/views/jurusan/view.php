<?php
/* @var $this JurusanController */
/* @var $model Jurusan */

$this->breadcrumbs=array(
	'Jurusan'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Jurusan', 'url'=>array('index')),
	array('label'=>'Create Jurusan', 'url'=>array('create')),
	array('label'=>'Update Jurusan', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Jurusan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>
 

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
                [
                    'label'=> 'Universitas',
                    'value'=> $model->kampusid->name,
                ],            
		'kampus_id',
		'name',
		'abbr',
	),
)); ?>
