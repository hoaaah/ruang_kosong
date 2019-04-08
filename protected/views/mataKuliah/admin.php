<?php
/* @var $this MataKuliahController */
/* @var $model MataKuliah */

$this->breadcrumbs=array(
	'Mata Kuliahs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List MataKuliah', 'url'=>array('index')),
	array('label'=>'Create MataKuliah', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#mata-kuliah-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Mata Kuliah</h1>

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

<?php   
        $pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
        $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'mata-kuliah-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(            // display 'author.username' using an expression
                        'name'=>'kampus_id',
                        'value'=>'$data->kampusid->name',
			'filter'=>Chtml::listData(Kampus::model()->findAll(),'id', 'name'),			  
                     ),
                //'kampus_id',
		array(            // display 'author.username' using an expression
                        'name'=>'jurusan_id',
                        'value'=>'$data->jurusanid->name',
			'filter'=>Chtml::listData(Jurusan::model()->findAll(),'id', 'name'),			  
                     ),            
		//'jurusan_id',
		'semester',
		'name',
                'dasar_hukum',
                /*
		'created',
		'updated',
		'user_id',
		'dosen',
		'kategori',
		
		*/
		array(
			'class'=>'CButtonColumn',
                        //'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,50=>50,100=>100),array(
                        //          'onchange'=>"$.fn.yiiGridView.update('file-grid',{ data:{pageSize: $(this).val() }})",
                        //)),
		),
	),
)); ?>
