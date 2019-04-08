<?php
/* @var $this GunaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gunas',
);

$this->menu=array(
	array('label'=>'Create Guna', 'url'=>array('create')),
	array('label'=>'Manage Guna', 'url'=>array('admin')),
);
?>

<h1>Gunas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
