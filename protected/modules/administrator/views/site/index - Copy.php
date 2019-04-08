

<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$this->widget(
    'booster.widgets.TbButton',
    array(
        'label' => 'Confirm Modal',
        'context' => 'warning',
        'htmlOptions' => array(
            'onclick' => 'js:bootbox.confirm("Are you sure?", function(confirmed){console.log("Confirmed: "+confirmed);})'
        ),
    )
);
$this->widget(
    'booster.widgets.TbButton',
    array(
        'label' => 'Prompt Modal',
        'context' => 'success',
        'htmlOptions' => array(
            'style' => 'margin-left:3px',
            'onclick' => 'js:bootbox.prompt("What is your name?", function(result){console.log("Result: "+result);})'
        ),
    )
);
$this->widget(
    'booster.widgets.TbButton',
    array(
        'label' => 'Override Alert & Confirm Icons Modal',
        'context' => 'primary',
        'htmlOptions' => array(
            'style' => 'margin-left:3px',
            'onclick' => 'js:(function(){
	  	bootbox.setIcons({
            "OK"      : "icon-ok icon-white",
            "CANCEL"  : "icon-ban-circle",
            "CONFIRM" : "icon-ok-sign icon-white"
        });
 
        bootbox.confirm("This dialog invokes <b>bootbox.setIcons()</b> to set icons for the standard three labels of OK, CANCEL and CONFIRM, before calling a normal <b>bootbox.confirm</b>", function(result) {
            bootbox.alert("This dialog is just a standard <b>bootbox.alert()</b>. <b>bootbox.setIcons()</b> only needs to be set once to affect all subsequent calls", function() {
                bootbox.setIcons(null);
            });
        });
	  })();'
        ),
    )
);



$this->widget(
    'booster.widgets.TbButton',
    array(
        'label' => '2015',
        'context' => 'primary',
        'htmlOptions' => array(
            'data-title' => 'Tahun 2015',
            'data-placement' => 'top',
            'data-content' => "Ini adalah anggaran dan realisasi tahun 2015",
            'data-toggle' => 'popover'
        ),
    )
);
$this->widget('zii.widgets.jui.CJuiAccordion', array(
	'panels'=>array(
		'panel 1'=>'Sistem ini sangat membantu beberapa kegiatan berkaitan dengan masalah kepegawaian',
		'panel 2'=>'Penambahan Pegawai Baru',
		// panel 3 contains the content rendered by a partial view
		// 'panel 3'=>$this->renderPartial('_partial',null,true),
	),
	// additional javascript options for the accordion plugin
	'options'=>array(
		'animated'=>'bounceslide',
	),
));
?>
<br>
<br>
<br>
<div class="well">
<?php
$this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs'=>array(
        '2015'=>'Content for tab 1',
        '2014'=>array('content'=>'Content for tab 2', 'id'=>'tab2'),
        // panel 3 contains the content rendered by a partial view
        // 'AjaxTab'=>array('ajax'=>$ajaxUrl),
    ),
    // additional javascript options for the tabs plugin
    'options'=>array(
        'collapsible'=>true,
    ),
));
?>

  ...
</div>
