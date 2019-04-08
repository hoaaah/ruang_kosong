<?php
/* @var $this AttributeController */
/* @var $data Attribute */
?>

<div class="view">
    <div class="row-fluid">
       <div class="span12">
                    <h3 class="header"><?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)); ?>
                <span class="header-line"></span> 
            </h3>

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kampus_id')); ?>:</b>
	<?php echo CHtml::encode($data->kampusid->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kd_attrib')); ?>:</b>
	<?php echo CHtml::encode($data->kd_attrib); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('abbr')); ?>:</b>
	<?php echo CHtml::encode($data->abbr); ?>
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

	*/ ?>
    </div><!--/row-fluid-->
</div>