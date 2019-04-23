<?php
/* @var $this PakaiRuangController */
/* @var $model RGuna */

$this->breadcrumbs=array(
	'Rgunas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RGuna', 'url'=>array('index')),
	array('label'=>'Create RGuna', 'url'=>array('create')),
	array('label'=>'View RGuna', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RGuna', 'url'=>array('admin')),
);
?>

<h1>Update RGuna <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>