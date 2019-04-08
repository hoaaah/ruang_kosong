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
/*bakal jalan
$fwdtbl= Yii::app()->db->createCommand('SELECT a.id, a.tanggal_guna,a.session_start, CONCAT(LEFT(b.name,2),".",MID(b.name,3,2)) AS jam, a.user_id, a.kelas_id, c.kelas, a.mata_kuliah AS id_kuliah, d.name AS mata_kuliah FROM
(SELECT a.*, SUBSTRING_INDEX(a.session_length,".", 1) AS session_start
FROM r_guna a 
WHERE a.tanggal_guna >= "'.date('Y-m-d').'" AND a.tanggal_guna <= DATE_ADD("'.date('Y-m-d').'", INTERVAL 2 WEEK) AND user_id = '.Yii::app()->user->Id.' AND a.status = 1)
a
INNER JOIN r_session b ON a.session_start = b.id
INNER JOIN r_kelas c ON a.kelas_id = c.id
INNER JOIN r_mata_kuliah d ON a.mata_kuliah = d.id
ORDER BY tanggal_guna ASC, session_start ASC')->queryAll();
 Saat ini yg dibawah nampilin semua jadwal sampe banyak banget
 
$fwdtbl= Yii::app()->db->createCommand('SELECT a.id, a.tanggal_guna,a.session_start, CONCAT(LEFT(b.name,2),".",MID(b.name,3,2)) AS jam, a.user_id, a.kelas_id, c.kelas, a.mata_kuliah AS id_kuliah, d.name AS mata_kuliah FROM
(SELECT a.*, SUBSTRING_INDEX(a.session_length,".", 1) AS session_start
FROM r_guna a 
WHERE a.tanggal_guna >= "'.date('Y-m-d').'"  AND user_id = '.Yii::app()->user->Id.' AND a.status = 1)
a
INNER JOIN r_session b ON a.session_start = b.id
INNER JOIN r_kelas c ON a.kelas_id = c.id
INNER JOIN r_mata_kuliah d ON a.mata_kuliah = d.id
ORDER BY tanggal_guna ASC, session_start ASC')->queryAll();
$gridDataProvider = new CArrayDataProvider($fwdtbl, array('keyField' => 'id','pagination'=>array('pageSize'=> 200,)));
// $gridColumns
$gridColumns = array(
	array('name'=>'tanggal_guna', 'header'=>'Tanggal', 'value' =>'date_format(date_create($data["tanggal_guna"]), "l, d-m-Y")'),
	array('name'=>'jam', 'header'=>'Sesi'),
	array('name'=>'mata_kuliah', 'header'=>'Mata Kuliah'),
	array('name'=>'kelas', 'header'=>'Ruang'),
//	array('name'=>'hapus', 'header'=>'Aksi', 'type' => 'raw',  'value' =>'CHtml::link("Bantal ".CHtml::image(Yii::app()->request->baseUrl."/images/delete.png"),Yii::app()->createUrl("user/bantal", array("id"=>$data["id"])))', 'htmlOptions'=>array('nowrap' =>'nowrap')),
	array('name'=>'hapus', 'header'=>'Aksi', 'type' => 'raw',  'value' =>'CHtml::link("Bantal ".CHtml::image(Yii::app()->request->baseUrl."/images/delete.png"),Yii::app()->createUrl("user/bantal", array("id"=>$data["id"])))', 'htmlOptions'=>array('nowrap' =>'nowrap', 'onclick' =>"return confirm('Anda yakin?');")),	
	
	
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
$fwd = ob_get_contents();
ob_end_clean();
 ---------------------------- AKHIR BAGIAN FWD------------------------------

$this->widget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Jadwal Ke Depan',
    	'context' => 'primary',
        'headerIcon' => 'signal',
        'content' => $fwd
    )
);

 ---------------------------- AWAL BAGIAN PRV ------------------------------*/

$gridDataProvider = new CArrayDataProvider($prvtbl, array('keyField' => 'id','pagination'=>array('pageSize'=> 20,)));
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