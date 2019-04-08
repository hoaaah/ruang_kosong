<!-- 
 * parallax_login.html
 * @Author original @msurguy (tw) -> http://bootsnipp.com/snippets/featured/parallax-login-form
 * @Tested on FF && CH
 * @Reworked by @kaptenn_com (tw)
 * @package PARALLAX LOGIN.
-->
        <script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
        <body>
            <div class="container">
                <div class="row vertical-offset-100">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">                                
                                <div class="row-fluid user-row">
                                    <img src="images/logo.png" class="img-responsive" alt="Conxole Admin"/>
                                </div>
                            </div>
                            <div class="panel-body">
                                <?php //<form accept-charset="UTF-8" role="form" class="form-signin">
								$form=$this->beginWidget('CActiveForm', array(
								'id'=>'login-form',
								'enableClientValidation'=>true,
								'htmlOptions'=>array(
									'class'=>'form-signin',
								),				
								'clientOptions'=>array(
								'validateOnSubmit'=>true,
								),
								)); ?>     								
                                    <fieldset>
                                        <label class="panel-login">
                                            <div class="login_result"></div>
                                        </label>
                                        <?php echo $form->textField($model,'username',array('class'=>'form-control', 'placeholder' => 'Username')); ?>	
										<?php echo $form->passwordField($model,'password',array('class'=>'form-control', 'placeholder' => 'Password')); ?>
                                        <br></br>
										<?php echo $form->checkBox($model,'rememberMe'); ?>
										<?php echo $form->label($model,'rememberMe'); ?>
										<?php echo CHtml::submitButton('Login', array('class'=>'btn btn-lg btn-success btn-block')); ?>
                                    </fieldset>
								<?php $this->endWidget(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>