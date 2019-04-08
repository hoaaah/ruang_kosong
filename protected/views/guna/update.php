<?php
/* @var $this GunaController */
/* @var $model Guna */

$this->breadcrumbs=array(
	'Gunas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Guna', 'url'=>array('index')),
	array('label'=>'Create Guna', 'url'=>array('create')),
	array('label'=>'View Guna', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Guna', 'url'=>array('admin')),
);
?>

<h1>Update Guna <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>