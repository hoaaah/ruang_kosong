<?php
$this->menu=array(
	array('label'=>'Tambah Parameter Server', 'url'=>array('Create')),
	array('label'=>'Manajemen Parameter Server', 'url'=>array('admin')),
);
$Th = date("Y");
/* ---------------------------- AWAL BAGIAN Notifikasi ------------------------------*/
$APBD0= Yii::app()->db->createCommand('SELECT a.id, a.user_id, c.kelas, a.tanggal_guna, a.session_length, b.kelas AS ruang
FROM r_guna a 
INNER JOIN r_kelas b ON a.kelas_id = b.id 
INNER JOIN t_users c ON a.user_id =  c.id
WHERE a.status = 0 AND tanggal_guna = NOW() ')->queryAll();
$gridDataProvider = new CArrayDataProvider($APBD0, array('keyField' => 'id','pagination'=>array('pageSize'=> 20,)));
// $gridColumns
$gridColumns = array(
	array('name'=>'kelas', 'header'=>'Kelas', 'htmlOptions'=>array('style'=>'width: 60px')),
	array('name'=>'ruang', 'header'=>'Ruang'),
        array('name'=>'session_length', 'header'=>'Sesi'),
	//array('name'=>'created', 'header'=>'Tanggal', 'value' => 'number_format($data["created"],2,",",".")',  'htmlOptions'=>array('style'=>'text-align:right')),
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
/* ---------------------------- AKHIR BAGIAN Notifikasi ------------------------------*/
/* ---------------------------- AWAL BAGIAN Review User ------------------------------*/
$APBD1= Yii::app()->db->createCommand('SELECT a.jurusan_id, b.name, COUNT( a.id ) AS jumlah_user, SUM( a.jumlah ) AS jumlah_input
                            FROM (
                            SELECT b.jurusan_id, b.semester, b.id, b.username, b.contact, b.kelas, COUNT( a.session_length ) AS jumlah
                            FROM r_guna a
                            RIGHT OUTER JOIN t_users b ON a.user_id = b.id
                            GROUP BY a.user_id, b.username, b.contact, b.kelas
                            ORDER BY contact ASC
                            )a
                            INNER JOIN r_jurusan b ON a.jurusan_id = b.id
                            GROUP BY a.jurusan_id, b.name
                            ')->queryAll();
$gridDataProvider = new CArrayDataProvider($APBD1, array('keyField' => 'jurusan_id','pagination'=>array('pageSize'=> 50,)));
// $gridColumns
$gridColumns = array(
	array('name'=>'jurusan_id', 'header'=>'Kode', 'htmlOptions'=>array('style'=>'width: 60px')),
	array('name'=>'name', 'header'=>'Jurusan'),
        array('name'=>'jumlah_user', 'header'=>'User'),
        array('name'=>'jumlah_input', 'header'=>'Terjadwal'),
	//array('name'=>'Total', 'header'=>'Anggaran', 'value' => 'number_format($data["Total"],2,",",".")',  'htmlOptions'=>array('style'=>'text-align:right')),
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
$table_anggaran1 = ob_get_contents();
ob_end_clean();
#########################################
$APBD2= Yii::app()->db->createCommand('SELECT b.jurusan_id, c.name, b.semester, b.id, b.username, b.contact, b.kelas, COUNT( a.session_length ) AS jumlah
                            FROM r_guna a
                            RIGHT OUTER JOIN t_users b ON a.user_id = b.id
                            LEFT OUTER JOIN r_jurusan c ON b.jurusan_id = c.id
                            GROUP BY a.user_id, b.username, b.contact, b.kelas
                            ORDER BY jurusan_id ASC, semester ASC, kelas ASC, username ASC
                            ')->queryAll();
$gridDataProvider = new CArrayDataProvider($APBD2, array('keyField' => 'id','pagination'=>array('pageSize'=> 1000,)));
// $gridColumns
$gridColumns = array(
	array('name'=>'name', 'header'=>'Jurusan', 'htmlOptions'=>array('style'=>'width: 60px')),
	array('name'=>'semester', 'header'=>'Sem'),
        //array('name'=>'kelas', 'header'=>'kelas'),
        array('name'=>'kelas', 'header'=>'Kelas', 'type' => 'raw',  'value' =>'CHtml::link($data["kelas"],Yii::app()->createUrl("dashboard/review", array("id"=>$data["id"])))', 'htmlOptions'=>array('style'=>'width: 60px')),    
        array('name'=>'username', 'header'=>'User'),
        array('name'=>'contact', 'header'=>'HP'),
        array('name'=>'jumlah', 'header'=>'Terjadwal'),
	//array('name'=>'Total', 'header'=>'Anggaran', 'value' => 'number_format($data["Total"],2,",",".")',  'htmlOptions'=>array('style'=>'text-align:right')),
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
$table_anggaran2 = ob_get_contents();
ob_end_clean();
/* ---------------------------- AKHIR BAGIAN Review User ------------------------------*/
/* ---------------------------- AWAL BAGIAN Review User------------------------------*/
ob_start();
$this->widget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Monitoring User Per Jurusan',
    	'context' => 'primary',
        'headerIcon' => 'home',
        'content' => $table_anggaran1
    )
);
$this->widget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Monitoring User Per Jurusan',
    	'context' => 'warning',
        'headerIcon' => 'home',
        'content' => $table_anggaran2
    )
);
$grafik_unduh = ob_get_contents();
ob_end_clean();
/* ---------------------------- AKHIR Review User------------------------------*/

/* ---------------------------- AWAL BAGIAN KURVA ------------------------------
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
 ---------------------------- AKHIR BAGIAN KURVA ------------------------------*/

$this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs'=>array(
	'Notifikasi'=>array('content'=>$table_anggaran0, 'id'=>'Anggaran0'),
        'Review User '=>array('content'=>$grafik_unduh, 'id'=>'Anggaran1'),
        //'Traffic of Schedule'=>array('content'=>$grafik, 'id'=>'Grafik'),		
	//'Postur Kelas'=>array('content'=>'UNDER CONSTRUCTION', 'id'=>'Postur'),
        // panel 3 contains the content rendered by a partial view
        // 'AjaxTab'=>array('ajax'=>$ajaxUrl),
    ),
    // additional javascript options for the tabs plugin
    'options'=>array(
        'collapsible'=>true,
    ),
));
?>
