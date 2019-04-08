<?php
/* @var $this BuildingController */
/* @var $data Building */
?>

<div class="view">
    <div class="row-fluid">
       <div class="span12">
                    <h3 class="header"><?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)); ?>
                <span class="header-line"></span> 
            </h3>
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kampus_id')); ?>:</b>
	<?php echo CHtml::encode($data->kampus_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alias')); ?>:</b>
	<?php echo CHtml::encode($data->alias); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jurusan')); ?>:</b>
	<?php echo CHtml::encode($data->jurusan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::encode($data->image); ?>
	<br />
       </div>

    </div><!--/row-fluid-->

</div>