<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo Yii::app()->theme->baseUrl;?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo Yii::app()->theme->baseUrl;?>/css/parallax.css" rel="stylesheet">

</head>

<body>

   
	<!-- Include content pages -->
	<?php echo $content; ?>	

    <!-- jQuery -->
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/parallax.js"></script>

</body>

</html>
