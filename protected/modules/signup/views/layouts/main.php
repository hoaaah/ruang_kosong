<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<!-- tambahan heru -->    
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.tabs.css" />         
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/datatable/demo_table_jui.css" />   
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/datatable/jquery-ui-1.8.4.custom.css" /> 
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/datatable/demo_page.css" />           
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery-ui-1.7.3.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>//js/jquery/jquery.dataTables.min.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
//				array('label'=>'Home', 'url'=>array('/')),
				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				//array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Ubah PWD', 'url'=>array('/User/ubahpwd&id='.Yii::app()->user->Id), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Data Keuangan', 'url'=>array('/sources'), 'visible'=>!Yii::app()->user->isGuest),				
//				array('label'=>'User', 'url'=>array('/User/index'), 'visible'=>Yii::app()->session['group_user']['bidang_id'] == 0),
//				array('label'=>'APBD', 'url'=>array('/Lra/index'), 'visible'=>!Yii::app()->user->isGuest),				
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
//				array('label'=>'HELP', 'url'=>Yii::app()->request->baseUrl.'/images/help.pdf', 'linkOptions'=>array('target'=>'_blank')),				
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
	<!--	Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>footer -->
	</div>

</div><!-- page -->

</body>
</html>
