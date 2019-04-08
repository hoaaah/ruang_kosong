<?php
/* @var $this NotificationController */
/* @var $model Notification */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'notification-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

<?php $this->widget('application.extensions.TheCKEditor.TheCKEditorWidget',array(
    'model'=>$model,                # Data-Model (form model)
    'attribute'=>'content',         # Attribute in the Data-Model
    'height'=>'200px',
    'width'=>'100%',
    'toolbarSet'=>'Basic',          # EXISTING(!) Toolbar (see: ckeditor.js)
    'ckeditor'=>Yii::app()->basePath.'/../ckeditor/ckeditor.php',
                                    # Path to ckeditor.php
    'ckBasePath'=>Yii::app()->baseUrl.'/ckeditor/',
                                    # Relative Path to the Editor (from Web-Root)
    'css' => Yii::app()->baseUrl.'/css/index.css',
                                    # Additional Parameters
) ); ?>  

	<div class="row">
		<?php echo $form->labelEx($model,'tgl_mulai'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
							array(
								'attribute' => 'tgl_mulai',
								'language' => 'id',
								'model' => $model,
								'options' => array(
												'mode' => 'focus',
												'dateFormat' => 'yy-mm-dd',
												'showAnim' => 'slideDown',
												'changeMonth'=>'true',
												'yearRange'=>'1980:2020', 
                       							'changeYear'=>'true',
											),
								'htmlOptions' => array('size' => 30, 'class' => 'form-control'),)
							); ?>
		<?php echo $form->error($model,'tgl_mulai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tgl_selesai'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
							array(
								'attribute' => 'tgl_selesai',
								'language' => 'id',
								'model' => $model,
								'options' => array(
												'mode' => 'focus',
												'dateFormat' => 'yy-mm-dd',
												'showAnim' => 'slideDown',
												'changeMonth'=>'true',
												'yearRange'=>'1980:2020', 
                       							'changeYear'=>'true',
											),
								'htmlOptions' => array('size' => 30, 'class' => 'form-control'),)
							); ?>
		<?php echo $form->error($model,'tgl_selesai'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tag'); ?>
		<?php echo $form->textField($model,'tag',array('size'=>20,'maxlength'=>20, 'class' => 'form-control')); 
                IF($this->user_log['peran']==0 ) echo CHtml::activeDropDownList($model, 'kampus_id', CHtml::listData(Kampus::model()->findAll(), 'id', 'name'), array('prompt'=>'--pilih Universitas--', 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'tag'); ?>
	</div>        

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->