<script type="text/javascript">
var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>
<?php
$this->breadcrumbs=array(
        'Stats',
);
echo '<p><em style="font-size:x-small; color:#00F; text-align:end">Berikut adalah daftar pertemuan yang telah dilaksanakan per tanggal '.date('d M Y').', tekan Export untuk mengekspor data ke excel, halaman yang akan terekspor adalah yang tampil. Tekan nextpage untuk mengekspor kembali.</em><br>';                                
?>
<input type="button" onclick="tableToExcel('testTable', 'W3C Example Table')" value="Export to Excel">
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
	//array('name'=>'attrib_id', 'header'=>'Attribut','value'=> 'Attribute::model()->findByPk($data["attrib_id"])["name"]'),
	//array('name'=>'name', 'header'=>'Name'),
	
    );
    $this->widget('booster.widgets.TbGridView', array(
            'id'=>'testTable',
            'type' => 'striped bordered condensed',
            'dataProvider' => $model,
            'template' => "{pager}\n{items}\n{pager}",
            'columns' => $gridColumns,
        ));

?>