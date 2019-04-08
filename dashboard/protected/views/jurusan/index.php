<?php
/* @var $this JurusanController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Jurusan',
);

$this->menu=array(
	array('label'=>'Create Jurusan', 'url'=>array('create')),
);
?>
 

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
