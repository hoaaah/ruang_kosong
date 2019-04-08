<?php
/* @var $this SourcesController */
/* @var $model Sources */
$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'links'  => array('User'),
    )
);

$this->menu=array(
	array('label'=>'Ubah Password', 'url'=>array('ubahpwd&id='.Yii::app()->user->Id)),
	array('label'=>'Daftar User', 'url'=>array('index')),
	array('label'=>'Tambah User', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#sources-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manajemen User</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sources-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		#'id',
		array(
				'name'=>'id',
				'htmlOptions'=>array('width'=>'20px'),
		),	
		array(
				'name'=>'username',
				'htmlOptions'=>array('width'=>'40px'),
		),	
		array(
				'name'=>'name',
				'htmlOptions'=>array('width'=>'40px'),
		),	
		array(
				'name'=>'keterangan',
				'htmlOptions'=>array('width'=>'40px'),
		),			
		array(
				'name'=>'password',
				'htmlOptions'=>array('width'=>'50px'),
		),						
		#'username',
		#'password',
		array(
			'class'=>'CButtonColumn',
				'htmlOptions'=>array('width'=>'30px'),			
		),
	),
)); ?>
