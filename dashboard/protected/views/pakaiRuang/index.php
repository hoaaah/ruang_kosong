<?php
/* @var $this PakaiRuangController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	$this->Ctitle,
);

$this->menu=array(
	array('label'=>'Create RGuna', 'url'=>array('create')),
	array('label'=>'Manage RGuna', 'url'=>array('admin')),
);
?>

<?php
ob_start();
$this->widget(
    'booster.widgets.TbGridView',
    array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $gridDataProvider,
        'template' => "{items}\n{pager}",
        'columns' => [
			[
				'name'=>'tanggal_guna', 
				'header'=>'Tanggal', 
				'type' => 'raw',
				'value' => function($model) {
					$date = explode(';', $model['tanggal_guna']);
					$length = count($date);
					if($model['jumlah_hari'] == 1 || $model['jumlah_hari'] == 0)
					{
						return date_format(date_create($model['tanggal_guna']), "l, d-m-Y");
					}
					$dateReturn = "";
					foreach($date as $date){
						$dateReturn .= date_format(date_create($date), "l, d-m-Y")."</br>";
					}
					return $dateReturn;
				}
			],
			[
				'name'=>'jam', 
				'header'=>'Sesi',
				'value' => function($model){
					return $model['jam']."-".$model['jam_selesai'];
				}
			],
			array('name'=>'mata_kuliah', 'header'=>'Mata Kuliah'),
			array('name'=>'kelas', 'header'=>'Ruang'),
			[
				'name' => 'status',
				'type' => 'raw',
				'value' => function($model){
					switch ($model['status']) {
						case 0:
							$status = '<i class="fa fa-times"></i> Ditolak';
							break;
						
						case 2:
							$status = '<i class="fa fa-check"></i> Disetujui';
							break;
						
						case 1:
							$status = '<i class="fa fa-print"></i> Diajukan';
							break;
						default:
							# code...
							break;
					}
					return $status;
				}
			],
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
					CHtml::link("Tolak <i class='fa fa-times'></i>", false, [
						'class' => 'btn btn-xs btn-danger', 
						// 'confirm' => "Yakin membatalkan ini?",
						'method' => 'POST',
						'data-toggle' => 'modal',
						'data-target' => '#myModal',
						'data-href' => Yii::app()->createUrl('pakaiRuang/tolak', ['id' => $model['id']])
					]).
					CHtml::link("Setuju <i class='fa fa-check'></i>", false, [
						'class' => 'btn btn-xs btn-info', 
						// 'confirm' => "Yakin membatalkan ini?",
						'method' => 'POST',
						'data-toggle' => 'modal',
						'data-target' => '#myModal',
						'data-href' => Yii::app()->createUrl('pakaiRuang/setuju', ['id' => $model['id']])
					]).
					'</div>'
					;
				},
			],
		],
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

?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Form Persetujuan</h4>
      </div>
      <div class="modal-body" id="myModalBody">
        ...
      </div>
    </div>
  </div>
</div>

<?php 
Yii::app()->clientScript->registerScript('myjquery', <<<JS
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        // var title = button.data('title') 
        var href = button.data('href') 
        // modal.find('.modal-title').html(title)
        modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>')
        $.post(href)
            .done(function( data ) {
                modal.find('.modal-body').html(data)
            });
        // $("#myModalLabel").html(title)
        // $("#myModalBody").html('<i class=\"fa fa-spinner fa-spin\"></i>')
        // $.post(href)
        //     .done(function( data ) {
        //         $("#myModalBody").html(data)
        //     });
	})
JS
// , CClientScript::POS_END
);
?>