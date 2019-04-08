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
echo '<p><em style="font-size:x-small; color:#00F; text-align:end">Berikut adalah daftar seluruh ruang dan atributnya. Biru menunjukkan kondisi baik, merah menunjukkan kondisi rusak/bermasalah. Klik untuk merubah kondisi atribut ruang.</em><br>';                                
?>
<!--
<button type="button" id="btnExport" onclick="tableToExcel('dvData', 'W3C Example Table')" class="btn btn-L btn-info">Export to Spreadsheet</button>
-->
<input type="button" onclick="tableToExcel('testTable', 'W3C Example Table')" value="Export to Excel">
<?php
    $gridColumns = array(

        array('name'=>'jurusan', 'header'=>'Jurusan','htmlOptions'=>array('width' => '21%')),
        array('name'=>'semester', 'header'=>'Sem.','htmlOptions'=>array('width' => '21%')),
        array('name'=>'kelas', 'header'=>'Kelas','htmlOptions'=>array('width' => '21%')),
        array('name'=>'mata_kuliah', 'header'=>'Mata Kuliah','htmlOptions'=>array('width' => '21%')),
        array('name'=>'tanggal_guna', 'header'=>'Tanggal','htmlOptions'=>array('width' => '21%')),
        array('name'=>'ruang', 'header'=>'Ruang','htmlOptions'=>array('width' => '21%')),
        array('name'=>'session_length', 'header'=>'Sesi','htmlOptions'=>array('width' => '21%')),
        array('name'=>'name', 'header'=>'User','htmlOptions'=>array('width' => '21%')),
	//array('name'=>'attrib_id', 'header'=>'Attribut','value'=> 'Attribute::model()->findByPk($data["attrib_id"])["name"]'),
	//array('name'=>'name', 'header'=>'Name'),
	
    );
    $this->widget('booster.widgets.TbGridView', array(
            'id'=>'testTable',
            'type' => 'striped bordered condensed',
            'dataProvider' => $model,
            'template' => "{items}\n{pager}",
            'columns' => $gridColumns,
        ));

?>
<!--
<?php echo CHtml::button('Export', array('id'=>'export-button','class'=>'span-3 button')); ?>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped" id="testTable" summary="Code page support in different versions of MS Windows." rules="groups" frame="hsides">
        <thead>
            <tr>
                <th width="21%">Jurusan</th>
                <th width="7%">Semester</th>
                <th width="8%">Kelas</th>
                <th width="15%">Mata Kuliah</th>
                <th width="10%">Tanggal Pertemuan</th>
                <th width="8%">Ruang</th>
                <th width="10%">Sesi</th>
                <th width="21%">User</th>
            </tr>
        </thead>
        <tbody>

                <?php foreach($stats AS $c){
                    echo '<tr>';
                    echo '<td>'.$c['jurusan'].'</td>';
                    echo '<td>'.$c['semester'].'</td>';
                    echo '<td>'.$c['kelas'].'</td>';
                    echo '<td>'.$c['mata_kuliah'].'</td>';
                    echo '<td>'.$c['tanggal_guna'].'</td>';
                    echo '<td>'.$c['ruang'].'</td>';
                    echo '<td>'.$c['session_length'].'</td>';
                    echo '<td>'.$c['name'].'</td>';
                    echo '</tr>';
                }
                ?>

        </tbody>
    </table>
</div>
<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'a-grid-id',
    'dataProvider' => $model,
    'ajaxUpdate' => true, //false if you want to reload aentire page (useful if sorting has an effect to other widgets)
    'filter' => null, //if not exist search filters
    'columns' => array(
 
        array(
            'header' => 'Jurusan',
            'name' => 'jurusan',
            //'value'=>'$data["MAIN_ID"]', //in the case we want something custom
        ),
        array(
            'header' => 'Sem.',
            'name' => 'semester',
            //'value'=>'$data["title"]', //in the case we want something custom
        ),
 
        'kelas', //just use it in default way (but still we could use array(header,name)... )
        'mata_kuliah',
        'tanggal_guna',
        'ruang',
        'session_length',
        'name',
 /*
        array( //we have to change the default url of the button(s)(Yii by default use $data->id.. but $data in our case is an array...)
            'class' => 'CButtonColumn',
            'template' => '{delete}',
            'buttons' => array(
                'delete' => array('url' => '$this->grid->controller->createUrl("delete",array("id"=>$data["MAIN_ID"]))'),
            ),
        ),
*/        
    ),
));
?>
-->

<!--
$("#btnExport").click(function (e) {
    window.open('data:application/vnd.ms-excel,' + $('#dvData').html());
    e.preventDefault();
});


$('#export-button').on('click',function() {
    $.fn.yiiGridView.export();
});
$.fn.yiiGridView.export = function() {
    $.fn.yiiGridView.update('dates-grid',{ 
        success: function() {
            $('#dates-grid').removeClass('grid-view-loading');
            window.location = '". $this->createUrl('exportFile')  . "';
        },
        data: $('.search-form form').serialize() + '&export=true'
    });
}
-->