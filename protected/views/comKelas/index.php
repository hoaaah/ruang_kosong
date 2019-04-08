<?php
/* @var $this ComBuildingController */
/* @var $dataProvider CActiveDataProvider */
$l=Kelas::model()->find(array(
	'select'=>'*',
	'condition'=>'id=:kelasi',
	'params'=>array(':kelasi'=>$kelasi),
));	
				
$this->breadcrumbs=array(
	'Kelas '.$l['kelas'],
);

$this->menu=array(
	//array('label'=>'Create ComBuilding', 'url'=>array('create')),
);
?>

<h1>Kelas <?php echo $l['kelas']?> </h1>
<?php
    //$gridDataProvider = $att;
    $gridColumns = array(
        array('name'=>'id', 'header'=>'Id'),
	array('name'=>'attrib_id', 'header'=>'Attribut','value'=> 'Attribute::model()->findByPk($data["attrib_id"])["name"]'),
	array('name'=>'name', 'header'=>'Name'),
        array('name' => 'kondisi', 'header' => 'Kondisi', 'type' => 'raw', 'value' => '$data["kondisi"] == 1 ? "Rusak ".CHtml::image(Yii::app()->request->baseUrl."/images/delete.png") : "Baik" ' ),
        //array('name' => 'detail', 'header' => 'Detail Kondisi'),
	array('name'=>'Rusak', 'header'=>'Aksi', 'type' => 'raw',  'value' =>'$data["kondisi"] == 0 ? CHtml::link("Infokan Rusak ".CHtml::image(Yii::app()->request->baseUrl."/images/delete.png"),Yii::app()->createUrl("ComKelas/broken", array("id"=>$data["id"]))) : ""', 'htmlOptions'=>array('nowrap' =>'nowrap', 'onclick' =>"return confirm('Yakin benar bermasalah?');")),	
/*        array(
		'htmlOptions' => array('nowrap'=>'nowrap'),
		'class'=>'booster.widgets.TbButtonColumn',
		'viewButtonUrl'=> 'Yii::app()->createUrl("KelasAtt/view", array("id"=>$data["id"]))',
		'updateButtonUrl'=> 'Yii::app()->createUrl("KelasAtt/update", array("id"=>$data["id"]))',
		'deleteButtonUrl'=> 'Yii::app()->createUrl("KelasAtt/delete", array("id"=>$data["id"]))',
	)
*/	
    );
    echo '<p><em style="font-size:x-small; color:#00F; text-align:end">Berikut adalah daftar atribut ruang. Klik "infokan rusak" untuk menginfokan atribut ruang yang bermasalah.</em><br>';                                    
    $this->widget('booster.widgets.TbGridView', array(
            'type' => 'striped bordered condensed',
            'dataProvider' => $att,
            'template' => "{items}\n{pager}",
            //'filter' => $person->search(),
            'columns' => $gridColumns,
        ));

?>
<div class="span6 well">
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
</div><!--/span-->
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>'{pager}<div>{items}</div>{summary}'
)); ?>


