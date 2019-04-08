<?php
/* @var $this ComBuildingController */
/* @var $model ComBuilding */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'com-building-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	
    <div class="row">
        <?php echo CHtml::activeLabelEx($model,'image'); ?>
        <?php echo $form->fileField($model,'image') ?>
		<?php echo $form->error($model,'image'); ?>        
    </div>  
	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>3, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->