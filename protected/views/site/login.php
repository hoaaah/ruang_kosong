<?php

$this->pageTitle=Yii::app()->name . ' - Login';

$this->breadcrumbs=array(

	'Login',

);

?>







<div class="panel panel-primary" style="width: 400px; position: static; left: 35%"><div class="panel-heading">

        <span class="glyphicon glyphicon-signal"></span> 

        <h3 class="panel-title" style="display: inline;">Login</h3>

        <div class="clearfix"></div></div>

        <div class="panel-body" id="yw2">

           <div class="form">

           <?php $form=$this->beginWidget('CActiveForm', array(

                   'id'=>'login-form',

                   'enableClientValidation'=>true,

                   'clientOptions'=>array(

                           'validateOnSubmit'=>true,

                   ),

           )); ?>



                   <p class="note">Masukkan <span class="required">username & password</span> anda.</p>



                   <div class="row">

                           <?php // echo $form->labelEx($model,'username'); ?>

                           <?php echo $form->textField($model,'username',array('class' => 'form-control', 'placeholder' =>'username')); ?>

                           <?php echo $form->error($model,'username'); ?>

                   </div>



                   <div class="row">

                           <?php // echo $form->labelEx($model,'password'); ?>

                           <?php echo $form->passwordField($model,'password',array('class' => 'form-control', 'placeholder' =>'password')); ?>

                           <?php echo $form->error($model,'password'); ?>

                           <p class="hint">

                           </p>

                   </div>



                   <div class="row rememberMe">

                           <?php echo $form->checkBox($model,'rememberMe'); ?>

                           <?php echo $form->label($model,'Selalu Ingat Saya'); ?>

                           <?php echo $form->error($model,'rememberMe'); ?>

                   </div>



                   <div class="row buttons">

                           <?php echo CHtml::submitButton('Login'); ?>

                   </div>



           <?php $this->endWidget(); ?>

           </div><!-- form -->       

        </div>

</div>