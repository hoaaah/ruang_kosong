<?php
/* @var $this PakaiRuangController */
/* @var $model RGuna */

$this->breadcrumbs=array(
	'Rgunas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List RGuna', 'url'=>array('index')),
	array('label'=>'Create RGuna', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#rguna-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Rgunas</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'rguna-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'kelas_id',
		'DateCreate',
		'tanggal_guna',
		'session_length',
		/*
		'mata_kuliah',
		'status',
		'dari',
		'jumlah_peserta',
		'penanggung_jawab',
		'konsumsi',
		'tor_kak',
		'approver',
		'approval_date',
		'catatan',
		'yang_mengajukan',
		'jumlah_hari',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
