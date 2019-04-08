<?php
/* @var $this ComKelasController */
/* @var $data ComKelas */
?>

<!--<div class="view">-->
<div class="span6 well">
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->userid->username);
	// echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />

</div>