<?php
$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
	array('label'=>'Ubah Password Saya', 'url'=>array('ubahpwd', 'id' => Yii::app()->user->Id)),
        array('label'=>'Create User', 'url'=>array('register')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>