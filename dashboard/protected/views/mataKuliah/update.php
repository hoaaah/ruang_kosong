<?php
/* @var $this MataKuliahController */
/* @var $model MataKuliah */

$this->breadcrumbs=array(
	'Mata Kuliah'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MataKuliah', 'url'=>array('index')),
	array('label'=>'Create MataKuliah', 'url'=>array('create')),
	array('label'=>'View MataKuliah', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Update MataKuliah <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>