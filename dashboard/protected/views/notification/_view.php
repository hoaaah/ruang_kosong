<?php
/* @var $this NotificationController */
/* @var $data Notification */
?>

<div class="view">
    <div class="panel panel-green">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo CHtml::link(CHtml::encode($data->tag).' oleh '.CHtml::encode($data->userid['name']), array('view', 'id'=>$data->id)); ?></h3>
            Ditampilkan pada <?php echo CHtml::encode(date("d-m-Y", strtotime($data->tgl_mulai))).' s/d '.
                    CHtml::encode(date("d-m-Y", strtotime($data->tgl_selesai))); ?>
        </div>
        <div class="panel-body"><?php echo $data->content; ?></div>
    </div>
</div>