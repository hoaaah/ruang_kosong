<?php
/* @var $this PakaiRuangController */
/* @var $data RGuna */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('session_length')); ?>:</b>
	<?php echo CHtml::encode($data->session_length); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mata_kuliah')); ?>:</b>
	<?php echo CHtml::encode($data->mata_kuliah); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dari')); ?>:</b>
	<?php echo CHtml::encode($data->dari); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jumlah_peserta')); ?>:</b>
	<?php echo CHtml::encode($data->jumlah_peserta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('penanggung_jawab')); ?>:</b>
	<?php echo CHtml::encode($data->penanggung_jawab); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('konsumsi')); ?>:</b>
	<?php echo CHtml::encode($data->konsumsi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tor_kak')); ?>:</b>
	<?php echo CHtml::encode($data->tor_kak); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('approver')); ?>:</b>
	<?php echo CHtml::encode($data->approver); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('approval_date')); ?>:</b>
	<?php echo CHtml::encode($data->approval_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('catatan')); ?>:</b>
	<?php echo CHtml::encode($data->catatan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('yang_mengajukan')); ?>:</b>
	<?php echo CHtml::encode($data->yang_mengajukan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jumlah_hari')); ?>:</b>
	<?php echo CHtml::encode($data->jumlah_hari); ?>
	<br />

	*/ ?>

</div>