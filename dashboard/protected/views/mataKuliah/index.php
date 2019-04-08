<?php
/* @var $this MataKuliahController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mata Kuliah',
);

$this->menu=array(
	array('label'=>'Create MataKuliah', 'url'=>array('create')),
);
?>

<h1>Mata Kuliahs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
