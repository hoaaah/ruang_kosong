<?php
/* @var $this GunaController */
/* @var $data Guna */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kelas_id')); ?>:</b>
	<?php echo CHtml::encode($data->kelas_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateCreate')); ?>:</b>
	<?php echo CHtml::encode($data->DateCreate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal_guna')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal_guna); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('session_id')); ?>:</b>
	<?php echo CHtml::encode($data->session_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mata_kuliah')); ?>:</b>
	<?php echo CHtml::encode($data->mata_kuliah); ?>
	<br />


</div>