<?php
/* @var $this NotificationController */
/* @var $model Notification */

$this->breadcrumbs=array(
	'Notifications'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Notification', 'url'=>array('index')),
	array('label'=>'Manage Notification', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>