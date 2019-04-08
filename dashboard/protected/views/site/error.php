<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error '.$code,
);
?>
<div class="row">
  <div class="span12">
    <div class="alert alert-danger">
        <h1>Page Not Found <small><font face="Tahoma" color="red">Error <?php echo $code; ?></font></small></h1>
        <p>Whatever you are trying to look is <font face="Tahoma" color="red">NOT HERE!</font></p>
        <p>Dude, are you trying to break our site or something? I mean - what is the deal? We develop this site for free to help, and you just sneaking around and ruin our help?</p>
        <p><b>You could just press this neat little button to back on the track:</b> <?php echo CHtml::link('<button type="button" class="btn btn-xs btn-info">Kembali ke jalan yang benar</button>',Yii::app()->createUrl('/')); ?></p>
       
      </div>
</div>
<div class="error">
<?php echo CHtml::encode($message); ?>
</div>