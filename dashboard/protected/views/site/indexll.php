<?php
$this->menu=array(
	array('label'=>'Tambah Parameter Server', 'url'=>array('Create')),
	array('label'=>'Manajemen Parameter Server', 'url'=>array('admin')),
);
$Th = date("Y");
/* ---------------------------- AWAL BAGIAN APBD0 ------------------------------*/
$APBD0= Yii::app()->db->createCommand('CALL Rpt_apbd('.($Th).')')->queryAll();
$gridDataProvider = new CArrayDataProvider($APBD0, array('keyField' => 'Kd_Rek','pagination'=>array('pageSize'=> 50,)));
// $gridColumns
$gridColumns = array(
	array('name'=>'Kd_Rek', 'header'=>'Kode', 'htmlOptions'=>array('style'=>'width: 60px')),
	array('name'=>'Nm_Rek', 'header'=>'Uraian'),
	array('name'=>'Total', 'header'=>'Anggaran', 'value' => 'number_format($data["Total"],2,",",".")',  'htmlOptions'=>array('style'=>'text-align:right')),
);
ob_start();
$this->widget(
    'booster.widgets.TbGridView',
    array(
        'type' => 'condensed',
        'dataProvider' => $gridDataProvider,
        'template' => "{items}\n{pager}",
        'columns' => $gridColumns,
    )
);
$table_anggaran0 = ob_get_contents();
ob_end_clean();
/* ---------------------------- AKHIR BAGIAN APBD0 ------------------------------*/
/* ---------------------------- AWAL BAGIAN APBD1 ------------------------------*/
$APBD1= Yii::app()->db->createCommand('CALL Rpt_apbd('.($Th-1).')')->queryAll();
$gridDataProvider = new CArrayDataProvider($APBD1, array('keyField' => 'Kd_Rek','pagination'=>array('pageSize'=> 50,)));
// $gridColumns
$gridColumns = array(
	array('name'=>'Kd_Rek', 'header'=>'Kode', 'htmlOptions'=>array('style'=>'width: 60px')),
	array('name'=>'Nm_Rek', 'header'=>'Uraian'),
	array('name'=>'Total', 'header'=>'Anggaran', 'value' => 'number_format($data["Total"],2,",",".")',  'htmlOptions'=>array('style'=>'text-align:right')),
);
#$APBD1 = new APBD1();
ob_start();
$this->widget(
    'booster.widgets.TbGridView',
    array(
        'type' => 'condensed',
        'dataProvider' => $gridDataProvider,
        'template' => "{items}\n{pager}",
        'columns' => $gridColumns,
    )
);
$table_anggaran1 = ob_get_contents();
ob_end_clean();
/* ---------------------------- AKHIR BAGIAN APBD1 ------------------------------*/

/* ---------------------------- AWAL BAGIAN KURVA ------------------------------*/
$kurva= Yii::app()->db->createCommand('CALL rpt_kurva('.$Th.')')->queryAll();
ob_start();
$this->widget(
    'booster.widgets.TbHighCharts',
    array(
        'options' => array(
            'title' => array(
                'text' => 'Grafik Realisasi Anggaran Per Triwulan Tahun ',
                'x' => -20 //center
            ),
            'subtitle' => array(
                'text' => 'Source: Aplikasi SIMDA Keuangan Per',
                'x' -20
            ),
            'xAxis' => array(
                'categories' => ['TW I', 'TW II', 'TW III', 'TW IV']
            ),
            'yAxis' => array(
                'title' => array(
                    'text' =>  'Persentase (%)',
                ),
                'plotLines' => [
                    [
                        'value' => 0,
                        'width' => 1,
                        'color' => '#808080'
                    ]
                ],
            ),
            'tooltip' => array(
                'valueSuffix' => '%'
            ),
            'legend' => array(
                'layout' => 'vertical',
                'align' => 'right',
                'verticalAlign' => 'middle',
                'borderWidth' => 0
            ),
            'series' => array(
                [
                    'name' => $Th,
                    'data' => [(int)$kurva['0']['TI'],
								(int)$kurva['0']['TII'],
								(int)$kurva['0']['TIII'],
								(int)$kurva['0']['TIV']]
								
						#'data' => [3.7981947962551974,17.34180200170645,29.27891919955906,(int)$kurva['0']['TIV']]			
                ],
                [
                    'name' => $Th-1,
                    'data' => [(int)$kurva['1']['TI'],
								(int)$kurva['1']['TII'],
								(int)$kurva['1']['TIII'],
								(int)$kurva['1']['TIV']]
                ],
            )
        ),
        'htmlOptions' => array(
            'style' => 'min-width: 310px; height: 400px; margin: 0 auto'
        )
    )
);
$grafik = ob_get_contents();
ob_end_clean();
/* ---------------------------- AKHIR BAGIAN KURVA ------------------------------*/

$this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs'=>array(
		'APBD '.$Th=>array('content'=>$table_anggaran0, 'id'=>'Anggaran0'),
        'APBD '.($Th-1)=>array('content'=>$table_anggaran1, 'id'=>'Anggaran1'),
        'Grafik Realisasi'=>array('content'=>$grafik, 'id'=>'Grafik'),		
		'Postur APBD'=>array('content'=>'UNDER CONSTRUCTION', 'id'=>'Postur'),
        // panel 3 contains the content rendered by a partial view
        // 'AjaxTab'=>array('ajax'=>$ajaxUrl),
    ),
    // additional javascript options for the tabs plugin
    'options'=>array(
        'collapsible'=>true,
    ),
));
?>
