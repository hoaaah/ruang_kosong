<?php
/* @var $this BuildingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Building'=>array('building/index'),
        $gedung->name,
        
);

$this->menu=array(
	array('label'=>'Create Kelas', 'url'=>array('create')),
);
?>

<?php 
/*
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
*/
$gridColumns = array(
	array('name'=>'id', 'header'=>'Id'),
        array('name'=>'name', 'header'=>'name', 'type' => 'raw',  'value' =>'CHtml::link($data["kelas"],Yii::app()->createUrl("kelas/view", array("id"=>$data["id"])))', 'htmlOptions'=>array('nowrap' =>'nowrap')),    
	//array('name'=>'alias', 'header'=>'Alias'),
        array('name'=>'alias', 'header'=>'Alias', 'type' => 'raw',  'value' =>'CHtml::link($data["alias"],Yii::app()->createUrl("kelas/view", array("id"=>$data["id"])))', 'htmlOptions'=>array('nowrap' =>'nowrap')),    
        array('name'=>'Fasilitas', 'header'=>'Fasilitas', 'value' => ''),
        //array('name'=>'action', 'header'=>'Aksi', 'type' => 'raw',  'value' =>'CHtml::link("+Fasilitas",Yii::app()->createUrl("Kelas/view", array("id"=>$data["id"])))." - ".CHtml::link("View ".CHtml::image(Yii::app()->request->baseUrl."/images/delete.png"),Yii::app()->createUrl("Kelas/view", array("id"=>$data["id"])))', 'htmlOptions'=>array('nowrap' =>'nowrap'/*, 'onclick' =>"return confirm('Anda yakin?');"*/)),	
	array(
		'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'booster.widgets.TbButtonColumn',
		'viewButtonUrl'=> 'Yii::app()->createUrl("kelas/view", array("id"=>$data["id"]))',
		'updateButtonUrl'=> 'Yii::app()->createUrl("kelas/update", array("id"=>$data["id"]))',
		'deleteButtonUrl'=> 'Yii::app()->createUrl("kelas/delete", array("id"=>$data["id"]))',
	)	
	
	
);
$this->widget(
    'booster.widgets.TbGridView',
    array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $dataProvider,
        'template' => "{items}\n{pager}",
        'columns' => $gridColumns,
    )
);
?>