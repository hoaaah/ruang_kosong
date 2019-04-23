<?php
/* @var $this PakaiRuangController */
/* @var $model RGuna */

$this->breadcrumbs=array(
	'Rgunas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RGuna', 'url'=>array('index')),
	array('label'=>'Create RGuna', 'url'=>array('create')),
	array('label'=>'Update RGuna', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RGuna', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RGuna', 'url'=>array('admin')),
);
?>

<h1>View RGuna #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'kelas_id',
		'DateCreate',
		'tanggal_guna',
		'session_length',
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
	),
)); ?>
