<?php
/* @var $this ComKelasController */
/* @var $model ComKelas */

$this->breadcrumbs=array(
	'Com Kelases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ComKelas', 'url'=>array('index')),
	array('label'=>'Create ComKelas', 'url'=>array('create')),
	array('label'=>'View ComKelas', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ComKelas', 'url'=>array('admin')),
);
?>

<h1>Update ComKelas <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>