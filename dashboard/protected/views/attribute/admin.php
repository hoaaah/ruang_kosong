<?php
/* @var $this AttributeController */
/* @var $model Attribute */

$this->breadcrumbs=array(
	'Attributes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Atribut Kampus', 'url'=>array('kampus')),
        array('label'=>'Atribut Gedung', 'url'=>array('gedung')),
        array('label'=>'Atribut Ruang', 'url'=>array('kelas')),
	array('label'=>'Create Attribute', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#attribute-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<p>
Kd Attribute terdiri dari atribut level 1 untuk atribut kampus, atribut level 2 untuk atribut gedung, dan atribut level 3 untuk atribut kelas/ruang.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'attribute-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		[
			'name' => 'kd_attrib',
			'value' => function($model){
				if($model->kd_attrib == 1) return "Kampus";
				if($model->kd_attrib == 2) return "Gedung";
				if($model->kd_attrib == 3) return "Ruangan";
			},
			'filter' => [
				1 => 'Kampus',
				2 => 'Gedung',
				3 => 'Ruangan',
			]
		],
		'name',
		'abbr',
		[
			'name'=>'kampus_id',
			'value'=>'$data->kampusid == null ? "Not Set" : $data->kampusid->name',
			'filter'=>Chtml::listData(Kampus::model()->findAll(),'id', 'name'),			  			
		],
		array(
			'class'=>'CButtonColumn',
                        //'htmlOptions' => 'nowrap',
		),
	),
)); ?>
