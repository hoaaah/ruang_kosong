<?php
/* @var $this AttributeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Attributes',
);

$this->menu=array(
	array('label'=>'Atribut Kampus', 'url'=>array('kampus')),
        array('label'=>'Atribut Gedung', 'url'=>array('gedung')),
        array('label'=>'Atribut Ruang', 'url'=>array('kelas')),
	array('label'=>'Create Attribute', 'url'=>array('create')),
);
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
