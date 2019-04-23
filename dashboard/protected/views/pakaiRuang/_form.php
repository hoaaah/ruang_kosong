<?php
/* @var $this PakaiRuangController */
/* @var $model RGuna */
/* @var $form CActiveForm */
?>
<div class="row">
<div class="form col-md-12">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rguna-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php
			$statuses = [
				0 => "Tolak",
				1 => "Diajukan",
				2 => "Setuju"
			];
			$this->widget('ext.select2.ESelect2', [
				'model'=>$model,
				'attribute'=>'status',
				'data'=> $statuses,
				'htmlOptions' => [
					'class' => 'form form-control col-md-6',
					'disabled' => true,
				]
			]);
		?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'approver'); ?>
		<?php echo $form->textField($model,'approver',array('class' => 'form form-control', 'size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'approver'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'approval_date'); ?>
		<?php echo $form->textField($model,'approval_date', ['class' => 'form form-control', 'readonly' => true]); ?>
		<?php echo $form->error($model,'approval_date'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Simpan', ['class' => 'btn btn-xs btn-info']); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->