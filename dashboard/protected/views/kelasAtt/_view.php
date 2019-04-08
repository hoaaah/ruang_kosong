<?php
/* @var $this KelasAttController */
/* @var $data KelasAtt */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kelas_id')); ?>:</b>
	<?php echo CHtml::encode($data->kelas_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attrib_id')); ?>:</b>
	<?php echo CHtml::encode($data->attrib_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateCreate')); ?>:</b>
	<?php echo CHtml::encode($data->DateCreate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />


</div>