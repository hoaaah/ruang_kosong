<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'User'=>array('index'),
	'Contact List',
);

$this->menu=array(
	array('label'=>'Contact List', 'url'=>array('call')),
	//array('label'=>'Create User', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Contact List Ketua Kelas</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'kelas',
		'username',
		'name',
		'contact',
	),
)); ?>
