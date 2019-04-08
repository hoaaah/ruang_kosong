<?php
$this->menu=array(
	array('label'=>'Login', 'url'=>array('/site/login')),
);
?>
<div class="span6 well">
	<h1>Registrasi Sukses, Silahkan Login!</h1>
	
	<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		'name',
		'sex',
		'kota_lahir',
		'tgl_lahir',
		'kelas',
		'keterangan',		
	),
)); ?>
</div><!--/span-->

