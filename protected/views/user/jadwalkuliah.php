<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'User'=>array('mine'),
	'Buat Jadwal',
);
$day = $tanggal->format('D');
IF($day == 'Sun'){
	$hari = 'Minggu';
}ELSEIF($day == 'Mon'){
	$hari = 'Senin';
}ELSEIF($day == 'Tue'){
	$hari = 'Selasa';
}ELSEIF($day == 'Wed'){
	$hari = 'Rabu';
}ELSEIF($day == 'Thu'){
	$hari = 'Kamis';
}ELSEIF($day == 'Fri'){
	$hari = 'Jumat';
}ELSEIF($day == 'Sat'){
	$hari = 'Sabtu';
}ELSE{
	$hari = 'Hari-Hari Bahagia';
}

/* ---------------------------- AWAL BAGIAN FWD ------------------------------*/

$gridDataProvider = new CArrayDataProvider($fwdtbl, array('keyField' => 'id','pagination'=>array('pageSize'=> 8,)));
// $gridColumns
$gridColumns = array(
	array('name'=>'tanggal_guna', 'header'=>'Tanggal', 'value' =>'date_format(date_create($data["tanggal_guna"]), "l, d F Y")'),
	array('name'=>'jam', 'header'=>'Sesi'),
	array('name'=>'mata_kuliah', 'header'=>'Mata Kuliah'),
	array('name'=>'kelas', 'header'=>'Ruang'),
	
	
);
ob_start();
$this->widget(
    'booster.widgets.TbGridView',
    array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $gridDataProvider,
        'template' => "{items}\n{pager}",
        'columns' => $gridColumns,
    )
);
$fwd = ob_get_contents();
ob_end_clean();
/* ---------------------------- AKHIR BAGIAN FWD------------------------------*/

$this->widget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Jadwal Kelas',
    	'context' => 'primary',
        'headerIcon' => 'signal',
        'content' => $fwd
    )
);
?>
<style>
.Table
{
	display: table;
}
.Title
{
	display: table-caption;
	text-align: center;
	font-weight: bold;
	font-size: larger;
}
.Heading
{
	display: table-row;
	font-weight: bold;
	text-align: center;
}
.Row
{
	display: table-row;
}
.Cellhead
{
	
	display: table-cell;
	border: solid;
	border-color:#FFF;
	background-color:#999;
	border-width: thin;
	text-align: center;	
	font-weight: bold;
	width: 50px;
	min-width: 50px;
	max-width: 50px;	
}

.Cell
{
	display: table-cell;
	border: solid;
	border-color:#FFF;
	background-color:#d0e9c6;
	border-width: thin;
	text-align: center;	
	width: 50px;
	min-width: 50px;
	max-width: 50px;	
}
.Row :hover
{
	background-color:#CFF;
}
.Cellblock
{
	display: table-cell;
	border: solid;
	border-color:#FFF;
	background-color:#999;
	text-align: center;	
	border-width: thin;
	width: 50px;
	min-width: 50px;
	max-width: 50px;	
}
</style>

<div class="span6 well">
	<h1>Jadwal Baru</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Jadwal diisi tiap <span class="required">awal periode </span> perkuliahan. Jumlah minggu diisi dengan berapa minggu dari awal sampai akhir periode perkuliahan (contoh satu semester 16w, 2w UTS, dan 2w PEKMA, maka diisi 20)</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'tanggal_guna'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
							array(
								'attribute' => 'tanggal_guna',
								'language' => 'id',
								'model' => $model,
								'options' => array(
												'mode' => 'focus',
												'dateFormat' => 'yy-mm-dd',
												'showAnim' => 'slideDown',
												'changeMonth'=>'true', 
                       							'changeYear'=>'true',
											),
								'htmlOptions' => array('size' => 30, 'class' => 'date'),)
							); ?>
		<?php echo $form->error($model,'tanggal_guna'); ?>
	</div>

	<div class="row">
        <?php echo CHtml::activeLabelEx($model,'gedung_id', array('label' => 'Detail')); ?>
        <?php // echo CHtml::activeDropDownList($model, 'kampus_id', CHtml::listData(Kampus::model()->findAll(), 'id', 'name'), array('prompt'=>'--pilih Universitas--'));
			echo CHtml::dropDownList('Bookguna[gedung_id]','', 
			CHtml::listData(Building::model()->findAll('kampus_id=:kampus_id', 
	   array(':kampus_id'=>(int) $this->user_log['kampus_id'])), 'id', 'name'),
				  array(
					'prompt'=>'--pilih Gedung--',
					'ajax' => array(
						'type'=>'POST', 
						'url'=>Yii::app()->createUrl('User/loadkelas'), //or $this->createUrl('loadcities') if '$this' extends CController
						'update'=>'#Bookguna_kelas_id', //or 'success' => 'function(data){...handle the data in the way you want...}',
						'data'=>array('gedung_id'=>'js:this.value'),
				  		)
					)); 			
		
		?>
		<?php echo $form->error($model,'gedung_id'); ?> 
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kelas_id'); ?>
		<?php
				echo CHtml::dropDownList('Bookguna[kelas_id]','', array(), array('prompt'=>'--Kelas--'));
//				echo $form->textField($model,'semester',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'kelas_id'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'mata_kuliah'); ?>
		<?php echo CHtml::activeDropDownList($model, 'mata_kuliah', $mk, array('prompt'=>'-Mata Kuliah-'));?>
		<?php echo $form->error($model,'mata_kuliah'); ?>
	</div>
    
	<div class="Row">
		<div class="Cellhead">
			07.30
		</div>
		<div class="Cellhead">
			08.00
		</div>
		<div class="Cellhead">
			08.30
		</div>
		<div class="Cellhead">
			09.00
		</div>
		<div class="Cellhead">
			09.30
		</div>
		<div class="Cellhead">
			10.00
		</div>
		<div class="Cellhead">
			10.30
		</div>
		<div class="Cellhead">
			11.00
		</div>
		<div class="Cellhead">
			11.30
		</div>
		<div class="Cellhead">
			12.00
		</div>
		<div class="Cellhead">
			12.30
		</div>
		<div class="Cellhead">
			13.00
		</div>
		<div class="Cellhead">
			13.30
		</div>
		<div class="Cellhead">
			14.00
		</div>
		<div class="Cellhead">
			14.30
		</div>
		<div class="Cellhead">
			15.00
		</div>
		<div class="Cellhead">
			15.30
		</div>
		<div class="Cellhead">
			16.00
		</div>
		<div class="Cellhead">
			16.30
		</div>
	</div>

	<div class="Row">
        <div class="Cell">
			<?php echo $form->checkBox($model,'col2');?>
		</div>
        <div class="Cell">
			<?php echo $form->checkBox($model,'col3');?>
		</div> 
        <div class="Cell">
			<?php echo $form->checkBox($model,'col4');?>
		</div> 
        <div class="Cell">
			<?php echo $form->checkBox($model,'col5');?>
		</div> 
        <div class="Cell">
			<?php echo $form->checkBox($model,'col6');?>
		</div> 
        <div class="Cell">
			<?php echo $form->checkBox($model,'col7');?>
		</div> 
        <div class="Cell">
			<?php echo $form->checkBox($model,'col8');?>
		</div> 
        <div class="Cell">
			<?php echo $form->checkBox($model,'col9');?>
		</div> 
        <div class="Cell">
			<?php echo $form->checkBox($model,'col10');?>
		</div> 
        <div class="Cell">
			<?php echo $form->checkBox($model,'col11');?>
		</div> 
        <div class="Cell">
			<?php echo $form->checkBox($model,'col12');?>
		</div> 
        <div class="Cell">
			<?php echo $form->checkBox($model,'col13');?>
		</div> 
        <div class="Cell">
			<?php echo $form->checkBox($model,'col14');?>
		</div> 
        <div class="Cell">
			<?php echo $form->checkBox($model,'col15');?>
		</div> 
        <div class="Cell">
			<?php echo $form->checkBox($model,'col16');?>
		</div> 
        <div class="Cell">
			<?php echo $form->checkBox($model,'col17');?>
		</div> 
        <div class="Cell">
			<?php echo $form->checkBox($model,'col18');?>
		</div> 
        <div class="Cell">
			<?php echo $form->checkBox($model,'col19');?>
		</div> 
        <div class="Cell">
			<?php echo $form->checkBox($model,'col20');?>
		</div>     
    </div> 
    
	<div class="row">
		<?php echo $form->labelEx($model,'weeks'); ?>
		<?php echo $form->textField($model,'weeks',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'weeks'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Book'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div><!--/span-->
