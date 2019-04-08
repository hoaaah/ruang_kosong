<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">
    <div class="row-fluid">
       <div class="span12">
                    <h3 class="header"><?php echo CHtml::link(/*CHtml::encode($data->peranid['name']).'-'.*/CHtml::encode($data->kelas).': '.CHtml::encode($data['name']), array('view', 'id'=>$data->id)); ?>
                <span class="header-line"></span> 
            </h3>
           
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kampus_id')); ?>:</b>
	<?php echo CHtml::encode($data->kampus_id == 0 || $data->kampus_id == NULL ? "" : $data->kampusid['name']); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jurusan_id')); ?>:</b>
	<?php echo CHtml::encode($data->jurusan_id == 0 || $data->jurusan_id == NULL ? "" : $data->jurusanid['name']); ?>
	<br />

        
	<b><?php echo CHtml::encode($data->getAttributeLabel('semester')); ?>:</b>
	<?php echo CHtml::encode($data->semester); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data['name']); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sex')); ?>:</b>
	<?php echo CHtml::encode($data->sex); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kota_lahir')); ?>:</b>
	<?php echo CHtml::encode($data->kota_lahir); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tgl_lahir')); ?>:</b>
	<?php echo CHtml::encode($data->tgl_lahir); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keterangan')); ?>:</b>
	<?php echo CHtml::encode($data->keterangan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kelas')); ?>:</b>
	<?php echo CHtml::encode($data->kelas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::encode($data->image); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('peran')); ?>:</b>
	<?php echo CHtml::encode($data->peran); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('approval')); ?>:</b>
	<?php echo CHtml::encode($data->approval); ?>
	<br />
    </div><!--/row-fluid-->

</div>