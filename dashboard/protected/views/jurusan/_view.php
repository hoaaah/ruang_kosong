<?php
/* @var $this JurusanController */
/* @var $data Jurusan */
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
        <?php echo CHtml::encode($data->kampusid->name); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
        <?php echo CHtml::encode($data->name); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('abbr')); ?>:</b>
        <?php echo CHtml::encode($data->abbr); ?>
        <br />
       </div>

    </div><!--/row-fluid-->

</div>
