<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'User'=>array('index'),
	'Jadwal Saya',
);

$this->menu=array(
	array('label'=>'Buat Jadwal', 'url'=>array('jadwalkuliah')),
	//array('label'=>'Create User', 'url'=>array('create')),
);

?>

<h1>Upcoming Schedule</h1>

<?php
//echo date('Y-m-d');
/* ---------------------------- AWAL BAGIAN FWD ------------------------------*/
$gridDataProvider = new CArrayDataProvider($fwdtbl, array('keyField' => 'id','pagination'=>array('pageSize'=> 8,)));
// $gridColumns
$gridColumns = [
	array('name'=>'tanggal_guna', 'header'=>'Tanggal', 'value' =>'date_format(date_create($data["tanggal_guna"]), "l, d-m-Y")'),
	array('name'=>'jam', 'header'=>'Sesi'),
	array('name'=>'mata_kuliah', 'header'=>'Mata Kuliah'),
	array('name'=>'kelas', 'header'=>'Ruang'),
//	array('name'=>'hapus', 'header'=>'Aksi', 'type' => 'raw',  'value' =>'CHtml::link("Bantal ".CHtml::image(Yii::app()->request->baseUrl."/images/delete.png"),Yii::app()->createUrl("user/bantal", array("id"=>$data["id"])))', 'htmlOptions'=>array('nowrap' =>'nowrap')),
	[
		'name'=>'hapus', 
		'header'=>'Aksi', 
		'type' => 'raw',  
		'value' => function($model){
			return '<div class="btn-group" role="group" aria-label="Basic example">'.
			CHtml::link('<i class="fa fa-print"></i>', ['cetak', 'id' => $model['id']], [
				'class' => 'btn btn-xs btn-default',
				'onClick' => "return !window.open(this.href, 'Cetak', 'width=1024,height=768')"
			]).
			CHtml::link("Bantal ".CHtml::image(Yii::app()->request->baseUrl."/images/delete.png"), ['bantal', 'id'=> $model['id']], [
				'class' => 'btn btn-xs btn-default', 
				'confirm' => "Yakin membatalkan ini?",
				'method' => 'POST',
			]).
			'</div>'
			;
		},
	],
];
ob_start();
$this->widget(
    'booster.widgets.TbGridView',
    array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $gridDataProvider,
        'template' => "{items}\n{pager}",
        'columns' => $gridColumns,
    )
);
$fwd = ob_get_contents();
ob_end_clean();
/* ---------------------------- AKHIR BAGIAN FWD------------------------------*/

$this->widget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Jadwal Ke Depan',
    	'context' => 'primary',
        'headerIcon' => 'signal',
        'content' => $fwd
    )
);

/* ---------------------------- AWAL BAGIAN PRV ------------------------------*/
$gridDataProvider = new CArrayDataProvider($prvtbl, array('keyField' => 'id','pagination'=>array('pageSize'=> 8,)));
// $gridColumns
$gridColumns = array(
	array('name'=>'tanggal_guna', 'header'=>'Tanggal', 'value' =>'date_format(date_create($data["tanggal_guna"]), "l, d-m-Y")'),
	array('name'=>'jam', 'header'=>'Sesi'),
	array('name'=>'mata_kuliah', 'header'=>'Mata Kuliah'),
	array('name'=>'kelas', 'header'=>'Ruang'),
	array('name'=>'status', 'header'=>'Status'),
	
	
);
ob_start();
$this->widget(
    'booster.widgets.TbGridView',
    array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $gridDataProvider,
        'template' => "{items}\n{pager}",
        'columns' => $gridColumns,
    )
);
$prv = ob_get_contents();
ob_end_clean();
/* ---------------------------- AKHIR BAGIAN PRV------------------------------*/

$this->widget(
		'booster.widgets.TbPanel',
		array(
				'title' => 'Jadwal Berlalu',
				'context' => 'danger',
				'headerIcon' => 'camera',
				'content' => $prv
		)
);
?>