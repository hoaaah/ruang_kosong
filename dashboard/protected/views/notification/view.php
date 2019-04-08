<?php
/* @var $this NotificationController */
/* @var $model Notification */

$this->breadcrumbs=array(
	'Notifications'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Notification', 'url'=>array('index')),
	array('label'=>'Create Notification', 'url'=>array('create')),
	array('label'=>'Update Notification', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Notification', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Notification', 'url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		[
                    'label'=> 'Kampus',
                    'value'=> ISSET($model->kampusid['name']) ? $model->kampusid['name'] : 'Global Notification'
                ],            
		[
                    'label'=> 'User',
                    'value'=> $model->userid['name'],
                ],  
		'tag',
		'content',
		'tgl_mulai',
		'tgl_selesai',
	),
)); ?>
