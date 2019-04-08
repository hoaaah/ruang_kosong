<div class ="container">
                            <div class="panel-heading">                                
                                <div class="row-fluid user-row">
                                </div>
                            </div>  
                            <div class="panel-heading">                                
                                <div class="row-fluid user-row">
                                </div>
                            </div>       
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="wrap">
            <?php //<form accept-charset="UTF-8" role="form" class="form-signin">
            $form=$this->beginWidget('CActiveForm', array(
            'id'=>'login-form',
            'enableClientValidation'=>true,
            'htmlOptions'=>array(
                    'class'=>'login',
            ),				
            'clientOptions'=>array(
            'validateOnSubmit'=>true,
            ),
            )); ?>                 
                <p class="form-title">
                    KelasKosong.net</p>
				<?php echo $form->textField($model,'username',array('placeholder' => 'Username')); ?>
				<?php echo $form->passwordField($model,'password',array('placeholder' => 'Password')); ?>
                                <?php echo CHtml::submitButton('Login', array('class'=>'btn btn-success btn-sm')); ?>                
                <div class="remember-forgot">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="checkbox">
                                <label>
                                    <?php echo $form->checkBox($model,'rememberMe'); ?> RememberMe
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <?php echo $form->error($model,'password'); ?>
                                </label>
                            </div>                            
                        </div>
                    </div>
                </div>
				<?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
    <div class="posted-by">Photo From: <a href="http://www.pknstan.ac.id">PKN-STAN</a></div>
</div>
