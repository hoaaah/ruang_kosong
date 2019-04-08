<?php
/* @var $this KelasController */
/* @var $model Kelas */

$this->breadcrumbs=array(
	'Building'=>array('building/index'),
        $gedung->name => array('kelas/list', 'id' => $gedung->id),
	$model->kelas,
);

$this->menu=array(
//	array('label'=>'List Kelas', 'url'=>array('index')),
//	array('label'=>'Manage Kelas', 'url'=>array('admin')),
);
?>
 
<div class="col-lg-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Info Ruang</h3>
        </div>
        <div class="panel-body">
          <?php $this->widget('zii.widgets.CDetailView', array(
                  'data'=>$model,
                  'attributes'=>array(
                          'id',
                          [
                              'label'=> 'Building',
                              'value'=> $model->buildingid->name,
                          ],
                          'kelas',
                          'alias',
                          'image',
                          'keterangan',
                  ),
          )); 
          ?>
        </div>
    </div>
</div>

    <?php $this->beginWidget(
        'booster.widgets.TbModal',
        array('id' => 'TambahAtt')
    ); ?>
     
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h4>Tambah Attribut</h4>
        </div>
     
        <div class="modal-body">
            <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'kelas-att-form',
                    // Please note: When you enable ajax validation, make sure the corresponding
                    // controller action is handling ajax validation correctly.
                    // There is a call to performAjaxValidation() commented in generated controller code.
                    // See class documentation of CActiveForm for details on this.
                    'enableAjaxValidation'=>false,
                    'htmlOptions'=>array(
                            'class'=>'form-group',
                            'width' => '800px',
                    ),    
            )); ?>

                    <p class="note">Fields with <span class="required">*</span> are required.</p>

                    <?php echo $form->errorSummary($KelasAtt); ?>

                    <div class="row">
                            <?php echo $form->labelEx($KelasAtt,'attrib_id'); ?>
                            <?php echo CHtml::activeDropDownList($KelasAtt, 'attrib_id', CHtml::listData(Attribute::model()->findAll(), 'id', 'name'), array('prompt'=>'--Pilih Att--', 'class' => 'form-control'));?>
                            <?php echo $form->error($KelasAtt,'attrib_id'); ?>
                    </div>

                    <div class="row">
                            <?php echo $form->labelEx($KelasAtt,'name'); ?>
                            <?php echo $form->textField($KelasAtt,'name',array('size'=>50,'maxlength'=>50, 'class' => 'form-control')); ?>
                            <?php echo $form->error($KelasAtt,'name'); ?>
                    </div>

                    <div class="row buttons">
                            <?php echo CHtml::submitButton($KelasAtt->isNewRecord ? 'Tambah' : 'Simpan'); ?>
                    </div>

            <?php $this->endWidget(); ?>
        </div>
     
        <div class="modal-footer">
            <?php $this->widget(
                'booster.widgets.TbButton',
                array(
                    'context' => 'danger',
                    'label' => 'Close',
                    'url' => '#',
                    'htmlOptions' => array('data-dismiss' => 'modal'),
                )
            ); ?>
        </div>
     
    <?php $this->endWidget(); ?>
    <?php $this->widget(
        'booster.widgets.TbButton',
        array(
            'label' => 'Tambah Atribut',
            'context' => 'primary',
            'htmlOptions' => array(
                'data-toggle' => 'modal',
                'data-target' => '#TambahAtt',
            ),
        )
    );
    ?>
<?php
    //$gridDataProvider = $att;
    $gridColumns = array(
//	array('name'=>'tanggal_guna', 'header'=>'Tanggal', 'value' =>'date_format(date_create($data["tanggal_guna"]), "l, d-m-Y")'),
        array('name'=>'id', 'header'=>'Id'),
//	array('name'=>'kelas_id', 'header'=>'ruang'),
	array('name'=>'attrib_id', 'header'=>'Attribut','value'=> 'Attribute::model()->findByPk($data["attrib_id"])["name"]'),
	array('name'=>'name', 'header'=>'Name'),
        array('name' => 'kondisi', 'header' => 'Kondisi', 'type' => 'raw', 'value' => '$data["kondisi"] == 1 ? CHtml::image(Yii::app()->request->baseUrl."/images/delete.png") : "" ' ),
        array('name' => 'detail', 'header' => 'Detail Kondisi'),
	//array('name'=>'hapus', 'header'=>'Aksi', 'type' => 'raw',  'value' =>'CHtml::link("Bantal ".CHtml::image(Yii::app()->request->baseUrl."/images/delete.png"),Yii::app()->createUrl("user/bantal", array("id"=>$data["id"])))', 'htmlOptions'=>array('nowrap' =>'nowrap', 'onclick' =>"return confirm('Anda yakin?');")),	
        array(
		'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'booster.widgets.TbButtonColumn',
		'viewButtonUrl'=> 'Yii::app()->createUrl("KelasAtt/view", array("id"=>$data["id"]))',
		'updateButtonUrl'=> 'Yii::app()->createUrl("KelasAtt/update", array("id"=>$data["id"]))',
		'deleteButtonUrl'=> 'Yii::app()->createUrl("KelasAtt/delete", array("id"=>$data["id"]))',
	)
	
    );
    $this->widget('booster.widgets.TbGridView', array(
            'type' => 'striped bordered condensed',
            'dataProvider' => $att,
            'template' => "{items}\n{pager}",
            //'filter' => $person->search(),
            'columns' => $gridColumns,
        ));

?>
