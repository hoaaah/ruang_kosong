<?php
/* @var $this ComBuildingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Com Buildings',
);

$this->menu=array(
	array('label'=>'Create ComBuilding', 'url'=>array('create')),
);
?>

<h1>Gedung X</h1>
<div class="span6 well">
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div><!--/span-->
<div class="span6 well">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div><!--/span-->

