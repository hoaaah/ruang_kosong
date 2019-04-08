<?php
/* @var $this MataKuliahController */
/* @var $data MataKuliah */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kampus_id')); ?>:</b>
	<?php echo CHtml::encode($data->kampus_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jurusan_id')); ?>:</b>
	<?php echo CHtml::encode($data->jurusan_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('semester')); ?>:</b>
	<?php echo CHtml::encode($data->semester); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated')); ?>:</b>
	<?php echo CHtml::encode($data->updated); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dosen')); ?>:</b>
	<?php echo CHtml::encode($data->dosen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kategori')); ?>:</b>
	<?php echo CHtml::encode($data->kategori); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dasar_hukum')); ?>:</b>
	<?php echo CHtml::encode($data->dasar_hukum); ?>
	<br />

	*/ ?>

</div>