<?php
/* @var $this KelasAttController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Kelas Atts',
);

$this->menu=array(
	array('label'=>'Create KelasAtt', 'url'=>array('create')),
	array('label'=>'Manage KelasAtt', 'url'=>array('admin')),
);
?>
 
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
