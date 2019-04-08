<?php
$this->breadcrumbs=array(
        'Stats',
);
echo '<p><em style="font-size:x-small; color:#00F; text-align:end">Berikut adalah daftar pertemuan yang diselenggarakan pada tanggal '.date('d M Y').'.</em><br>';                                
?>
<?php
    $gridColumns = array(

        array('name'=>'jurusan', 'header'=>'Jurusan','htmlOptions'=>array('width' => '21%')),
        array('name'=>'semester', 'header'=>'Sem.','htmlOptions'=>array('width' => '7%')),
        array('name'=>'kelas', 'header'=>'Kelas','htmlOptions'=>array('width' => '8%')),
        array('name'=>'mata_kuliah', 'header'=>'Mata Kuliah','htmlOptions'=>array('width' => '15%')),
        array('name'=>'tanggal_guna', 'header'=>'Tanggal','htmlOptions'=>array('width' => '10%')),
        array('name'=>'ruang', 'header'=>'Ruang','htmlOptions'=>array('width' => '8%')),
        array('name'=>'session_length', 'header'=>'Sesi','htmlOptions'=>array('width' => '10%')),
        array('name'=>'name', 'header'=>'User','htmlOptions'=>array('width' => '15%')),
	
    );
    $this->widget('booster.widgets.TbGridView', array(
            'id'=>'testTable',
            'type' => 'striped bordered condensed',
            'dataProvider' => $model,
            'template' => "{pager}\n{items}\n{pager}",
            'columns' => $gridColumns,
        ));

?>