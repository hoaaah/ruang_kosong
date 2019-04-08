<?php  
  $baseUrl = Yii::app()->theme->baseUrl; 
  $cs = Yii::app()->getClientScript();
//  $cs->registerScriptFile('http://www.google.com/jsapi');
  $cs->registerCoreScript('jquery');
  $cs->registerScriptFile($baseUrl.'/js/jquery.gvChart-1.0.1.min.js');
  $cs->registerScriptFile($baseUrl.'/js/pbs.init.js');
  $cs->registerCssFile($baseUrl.'/css/jquery.css');

?>

<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i> Dashboard</h1>
<div class="span-23 showgrid">
<div class="dashboardIcons span-16">
    <div class="dashIcon span-3">
    <?php
		$image = CHtml::Image(Yii::app()->theme->baseUrl . '/images/big_icons/icon-contact.png', 'Data Pegawai');
		echo CHtml::Link($image, array('/RefPegawai'), array('target'=>'_blank', 'title'=>'Data Pegawai'));
		echo '<div class="dashIconText ">'.CHtml::Link('Data Pegawai', array('/RefPegawai'), array('target'=>'_blank', 'title'=>'Data Pegawai')).'</div>';
		
	?>

    </div>
    <div class="dashIcon span-3">
    <?php
		$image = CHtml::Image(Yii::app()->theme->baseUrl . '/images/big_icons/icon-digg4.png', 'Data User');
		echo CHtml::Link($image, array('/User'), array('target'=>'_blank', 'title'=>'Data_USER'));
		echo '<div class="dashIconText ">'.CHtml::Link('Data User', array('/User'), array('target'=>'_blank', 'title'=>'Data User')).'</div>';
		
	?>

    </div>    
    <div class="dashIcon span-3">
    <?php
		$image = CHtml::Image(Yii::app()->theme->baseUrl . '/images/big_icons/icon-plane.png', 'Cuti Tahunan');
		echo CHtml::Link($image, array('/TcutiTahunan'), array('target'=>'_blank', 'title'=>'Cuti Tahunan'));
		echo '<div class="dashIconText ">'.CHtml::Link('Cuti Tahunan', array('/TcutiTahunan'), array('target'=>'_blank', 'title'=>'Cuti Tahunan')).'</div>';
		
	?>

    </div>
  
    <div class="dashIcon span-3">
    <?php
		$image = CHtml::Image(Yii::app()->theme->baseUrl . '/images/big_icons/icon-chart2.png', 'Saldo Cuti');
		echo CHtml::Link($image, array('/TsaldoCuti'), array('target'=>'_blank', 'title'=>'Saldo Cuti'));
		echo '<div class="dashIconText ">'.CHtml::Link('Saldo Cuti', array('/TsaldoCuti'), array('target'=>'_blank', 'title'=>'Saldo Cuti')).'</div>';
		
	?>

    </div>
        
    <div class="dashIcon span-3">
    <?php
		$image = CHtml::Image(Yii::app()->theme->baseUrl . '/images/big_icons/icon-tshirt.png', 'Bidang-Sub');
		echo CHtml::Link($image, array('/RefBidang'), array('target'=>'_blank', 'title'=>'Bidang-Sub'));
		echo '<div class="dashIconText ">'.CHtml::Link('Bidang-Sub', array('/RefBidang'), array('target'=>'_blank', 'title'=>'Bidang-Sub')).'</div>';
		
	?>

    </div>
    
    <div class="dashIcon span-3">
    <?php
		$image = CHtml::Image(Yii::app()->theme->baseUrl . '/images/big_icons/icon-box-open.png', 'Category-PUUD');
		echo CHtml::Link($image, array('/Puus'), array('target'=>'_blank', 'title'=>'Category-PUUD'));
		echo '<div class="dashIconText ">'.CHtml::Link('Category-PUUD', array('/Puus'), array('target'=>'_blank', 'title'=>'Category-PUUD')).'</div>';
		
	?>

    </div>
    
    <div class="dashIcon span-3">
    <?php
		$image = CHtml::Image(Yii::app()->theme->baseUrl . '/images/big_icons/icon-books.png', 'Category-Bid');
		echo CHtml::Link($image, array('/RefCategory'), array('target'=>'_blank', 'title'=>'Category-Bid'));
		echo '<div class="dashIconText ">'.CHtml::Link('Category-Bid', array('/RefCategory'), array('target'=>'_blank', 'title'=>'Category-Bid')).'</div>';
		
	?>

    </div>    
    
    <div class="dashIcon span-3">
    <?php
		$image = CHtml::Image(Yii::app()->theme->baseUrl . '/images/big_icons/icon-information.png', 'Pengumuman');
		echo CHtml::Link($image, array('/Tpengumuman'), array('target'=>'_blank', 'title'=>'Pengumuman'));
		echo '<div class="dashIconText ">'.CHtml::Link('Pengumuman', array('/Tpengumuman'), array('target'=>'_blank', 'title'=>'Pengumuman')).'</div>';
		
	?>

    </div>   
    
    <div class="dashIcon span-3">
    <?php
		$image = CHtml::Image(Yii::app()->theme->baseUrl . '/images/big_icons/icon-people.png', 'Struktural');
		echo CHtml::Link($image, array('/Pejabat'), array('target'=>'_blank', 'title'=>'Struktural'));
		echo '<div class="dashIconText ">'.CHtml::Link('Struktural', array('/Pejabat'), array('target'=>'_blank', 'title'=>'Struktural')).'</div>';
		
	?>

    </div>  

     <div class="dashIcon span-3">
    <?php
		$image = CHtml::Image(Yii::app()->theme->baseUrl . '/images/big_icons/icon-baloon.png', 'Jenis Cuti');
		echo CHtml::Link($image, array('/RefCutiJn'), array('target'=>'_blank', 'title'=>'Jenis Cuti'));
		echo '<div class="dashIconText ">'.CHtml::Link('Jenis Cuti', array('/RefCutiJn'), array('target'=>'_blank', 'title'=>'Jenis Cuti')).'</div>';
		
	?>

    </div>  
    
       
    
</div><!-- END OF .dashIcons -->
<div class="span-7 last">
			
			
			<?php 
			$reg_p= Yii::app()->db->createCommand('SELECT COUNT(a.username) AS user, COUNT(b.NIP) AS pegawai FROM users a RIGHT OUTER JOIN ref_pegawai b ON a.username = b.NIP')->queryAll();
			?>
            Pegawai Teregistrasi: <?php echo $reg_p['0']['user']/$reg_p['0']['pegawai']*100 ; ?>%
			<?php
			$this->widget('zii.widgets.jui.CJuiProgressBar', array(
				'value'=>$reg_p['0']['user']/$reg_p['0']['pegawai']*100,
				'htmlOptions'=>array(
					'style'=>'height:10px;',
					'class'=>'shadowprogressbar'
				),
			));
			?>
            <br />
                    <div class="form">
                    
						<form action="#" method="get" name="Laporan" target="_blank">
                        <fieldset><legend>Laporan</legend>
                        <label>Jenis Laporan</label>
                        <select id="jenis" name="jenis">
                            <option value="">Jenis Laporan</option>
                            <option value="1">Laporan Cuti Triwulan</option>
                            <option value="2">Rekapitulasi File PPM</option>
                            <option value="3">Rekapitulasi Penugasan</option>
                            <option value="4">Rekapitulasi Disp-TL</option>
                            <option value="5">dll</option>
                        </select>
                        <div class="row submit">
                        <input type="submit" value="Submit" name="yt0">
                        </div>
                        </fieldset>
                        </form>
                    
                    </div><!-- form -->            

</div>
                
<div class="span-10">
<?php
$this->beginWidget('zii.widgets.CPortlet', array(
	'title'=>'Rekap Pengajuan Cuti Tahun '.DATE('Y'),
));
?>
<div class="chart2">
<div>
        <div class="text">
            <table class="myChart">
                <thead>
                    <tr>
                        <th></th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>                        
                        <th>8</th>
                        <th>9</th>
                        <th>10</th>
                        <th>11</th>
                        <th>12</th>
                                                
                    </tr>
                </thead>
    
                <tbody>
    <?php
			$l1= Yii::app()->db->createCommand('
			SELECT b.name,
			IF(SUM(a.j1) IS NULL, 0, SUM(a.j1)) AS j1,
			IF(SUM(a.j2) IS NULL, 0, SUM(a.j2)) AS j2,
			IF(SUM(a.j3) IS NULL, 0, SUM(a.j3)) AS j3,
			IF(SUM(a.j4) IS NULL, 0, SUM(a.j4)) AS j4,
			IF(SUM(a.j5) IS NULL, 0, SUM(a.j5)) AS j5,
			IF(SUM(a.j6) IS NULL, 0, SUM(a.j6)) AS j6,
			IF(SUM(a.j7) IS NULL, 0, SUM(a.j7)) AS j7,
			IF(SUM(a.j8) IS NULL, 0, SUM(a.j8)) AS j8,
			IF(SUM(a.j9) IS NULL, 0, SUM(a.j9)) AS j9,
			IF(SUM(a.j10) IS NULL, 0, SUM(a.j10)) AS j10,
			IF(SUM(a.j11) IS NULL, 0, SUM(a.j11)) AS j11,
			IF(SUM(a.j12) IS NULL, 0, SUM(a.j12)) AS j12  
			 FROM (
				SELECT b.cuti_id, COUNT(a.jml_hari) AS j1 , 0 AS j2, 0 AS j3, 0 AS j4, 0 AS j5, 0 AS j6, 0 AS j7, 0 AS j8, 0 AS j9, 0 AS j10, 0 AS j11, 0 AS j12
				FROM tcuti_izin a 
				LEFT JOIN tcuti_mohon b ON a.mohon_id = b.id
				WHERE b.tgl_selesai >= "'.DATE('Y').'-01-01" AND b.tgl_selesai < "'.DATE('Y').'-02-01"
				GROUP BY b.cuti_id
				UNION ALL
				SELECT b.cuti_id, 0 AS j1 , COUNT(a.jml_hari) AS j2, 0 AS j3, 0 AS j4, 0 AS j5, 0 AS j6, 0 AS j7, 0 AS j8, 0 AS j9, 0 AS j10, 0 AS j11, 0 AS j12
				FROM tcuti_izin a 
				LEFT JOIN tcuti_mohon b ON a.mohon_id = b.id
				WHERE b.tgl_selesai >= "'.DATE('Y').'-02-01" AND b.tgl_selesai < "'.DATE('Y').'-03-01"
				GROUP BY b.cuti_id
				UNION ALL
				SELECT b.cuti_id, 0 AS j1 , 0 AS j2, COUNT(a.jml_hari) AS j3, 0 AS j4, 0 AS j5, 0 AS j6, 0 AS j7, 0 AS j8, 0 AS j9, 0 AS j10, 0 AS j11, 0 AS j12
				FROM tcuti_izin a 
				LEFT JOIN tcuti_mohon b ON a.mohon_id = b.id
				WHERE b.tgl_selesai >= "'.DATE('Y').'-03-01" AND b.tgl_selesai < "'.DATE('Y').'-04-01"
				GROUP BY b.cuti_id
				UNION ALL
				SELECT b.cuti_id, 0 AS j1 , 0 AS j2, 0 AS j3, COUNT(a.jml_hari) AS j4, 0 AS j5, 0 AS j6, 0 AS j7, 0 AS j8, 0 AS j9, 0 AS j10, 0 AS j11, 0 AS j12
				FROM tcuti_izin a 
				LEFT JOIN tcuti_mohon b ON a.mohon_id = b.id
				WHERE b.tgl_selesai >= "'.DATE('Y').'-04-01" AND b.tgl_selesai < "'.DATE('Y').'-05-01"
				GROUP BY b.cuti_id
				UNION ALL
				SELECT b.cuti_id, 0 AS j1 , 0 AS j2, 0 AS j3, 0 AS j4, COUNT(a.jml_hari) AS j5, 0 AS j6, 0 AS j7, 0 AS j8, 0 AS j9, 0 AS j10, 0 AS j11, 0 AS j12
				FROM tcuti_izin a 
				LEFT JOIN tcuti_mohon b ON a.mohon_id = b.id
				WHERE b.tgl_selesai >= "'.DATE('Y').'-05-01" AND b.tgl_selesai < "'.DATE('Y').'-06-01"
				GROUP BY b.cuti_id
				UNION ALL
				SELECT b.cuti_id, 0 AS j1 , 0 AS j2, 0 AS j3, 0 AS j4, 0 AS j5, COUNT(a.jml_hari) AS j6, 0 AS j7, 0 AS j8, 0 AS j9, 0 AS j10, 0 AS j11, 0 AS j12
				FROM tcuti_izin a 
				LEFT JOIN tcuti_mohon b ON a.mohon_id = b.id
				WHERE b.tgl_selesai >= "'.DATE('Y').'-06-01" AND b.tgl_selesai < "'.DATE('Y').'-07-01"
				GROUP BY b.cuti_id
				UNION ALL
				SELECT b.cuti_id, 0 AS j1 , 0 AS j2, 0 AS j3, 0 AS j4, 0 AS j5, 0 AS j6, COUNT(a.jml_hari) AS j7, 0 AS j8, 0 AS j9, 0 AS j10, 0 AS j11, 0 AS j12
				FROM tcuti_izin a 
				LEFT JOIN tcuti_mohon b ON a.mohon_id = b.id
				WHERE b.tgl_selesai >= "'.DATE('Y').'-07-01" AND b.tgl_selesai < "'.DATE('Y').'-08-01"
				GROUP BY b.cuti_id
				UNION ALL
				SELECT b.cuti_id, 0 AS j1 , 0 AS j2, 0 AS j3, 0 AS j4, 0 AS j5, 0 AS j6, 0 AS j7, COUNT(a.jml_hari) AS j8, 0 AS j9, 0 AS j10, 0 AS j11, 0 AS j12
				FROM tcuti_izin a 
				LEFT JOIN tcuti_mohon b ON a.mohon_id = b.id
				WHERE b.tgl_selesai >= "'.DATE('Y').'-08-01" AND b.tgl_selesai < "'.DATE('Y').'-09-01"
				GROUP BY b.cuti_id
				UNION ALL
				SELECT b.cuti_id, 0 AS j1 , 0 AS j2, 0 AS j3, 0 AS j4, 0 AS j5, 0 AS j6, 0 AS j7, 0 AS j8, COUNT(a.jml_hari) AS j9, 0 AS j10, 0 AS j11, 0 AS j12
				FROM tcuti_izin a 
				LEFT JOIN tcuti_mohon b ON a.mohon_id = b.id
				WHERE b.tgl_selesai >= "'.DATE('Y').'-09-01" AND b.tgl_selesai < "'.DATE('Y').'-10-01"
				GROUP BY b.cuti_id
				UNION ALL
				SELECT b.cuti_id, 0 AS j1 , 0 AS j2, 0 AS j3, 0 AS j4, 0 AS j5, 0 AS j6, 0 AS j7, 0 AS j8, 0 AS j9, COUNT(a.jml_hari) AS j10, 0 AS j11, 0 AS j12
				FROM tcuti_izin a 
				LEFT JOIN tcuti_mohon b ON a.mohon_id = b.id
				WHERE b.tgl_selesai >= "'.DATE('Y').'-10-01" AND b.tgl_selesai < "'.DATE('Y').'-11-01"
				GROUP BY b.cuti_id
				UNION ALL
				SELECT b.cuti_id, 0 AS j1 , 0 AS j2, 0 AS j3, 0 AS j4, 0 AS j5, 0 AS j6, 0 AS j7, 0 AS j8, 0 AS j9, 0 AS j10, COUNT(a.jml_hari) AS j11, 0 AS j12
				FROM tcuti_izin a 
				LEFT JOIN tcuti_mohon b ON a.mohon_id = b.id
				WHERE b.tgl_selesai >= "'.DATE('Y').'-11-01" AND b.tgl_selesai < "'.DATE('Y').'-12-01"
				GROUP BY b.cuti_id
				UNION ALL
				SELECT b.cuti_id, 0 AS j1 , 0 AS j2, 0 AS j3, 0 AS j4, 0 AS j5, 0 AS j6, 0 AS j7, 0 AS j8, 0 AS j9, 0 AS j10, 0 AS j11, COUNT(a.jml_hari) AS j12
				FROM tcuti_izin a 
				LEFT JOIN tcuti_mohon b ON a.mohon_id = b.id
				WHERE b.tgl_selesai >= "'.DATE('Y').'-12-01" AND b.tgl_selesai <= "'.DATE('Y').'-12-31"
				GROUP BY b.cuti_id
			) a RIGHT JOIN
			(SELECT * FROM ref_cuti_jn) b ON a.cuti_id = b.id				
			GROUP BY b.name
			ORDER BY b.id
						'
						)->queryAll();		
	
	foreach ($l1 as $l1){
		echo'<tr>';
			echo '<th>'.$l1['name'].'</th>';
			echo '<td>'.$l1['j1'].'</td>';
			echo '<td>'.$l1['j2'].'</td>';
			echo '<td>'.$l1['j3'].'</td>';
			echo '<td>'.$l1['j4'].'</td>';
			echo '<td>'.$l1['j5'].'</td>';
			echo '<td>'.$l1['j6'].'</td>';
			echo '<td>'.$l1['j7'].'</td>';
			echo '<td>'.$l1['j8'].'</td>';
			echo '<td>'.$l1['j9'].'</td>';
			echo '<td>'.$l1['j10'].'</td>';
			echo '<td>'.$l1['j11'].'</td>';
			echo '<td>'.$l1['j12'].'</td>';																							
		echo'</tr>';	
	}
	
	?>                

                </tbody>
            </table>
            
            
      </div>
  </div>
</div>
<?php $this->endWidget();?>
</div>
<div class="span-13 last">
<?php
$this->beginWidget('zii.widgets.CPortlet', array(
	'title'=>'Line Chart',
));
?>
<div class="chart3">
    <div>
        <div class="text">
            <table class="myChart">
                <thead>
                    <tr>
                        <th></th>
                        <th>Jan</th>
                        <th>Feb</th>
                        <th>Mar</th>
                        <th>Apr</th>
                        <th>May</th>
                        <th>Jun</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th>Surat Tugas</th>
                        <td>39523</td>
                        <td>26123</td>
                        <td>29031</td>
                        <td>34342</td>
                        <td>48321</td>
                        <td>42234</td>
                    </tr>
                    <tr>
                        <th>Total Surat Masuk</th>
                        <td>34523</td>
                        <td>22123</td>
                        <td>25031</td>
                        <td>30342</td>
                        <td>45321</td>
                        <td>46234</td>
                    </tr>
                </tbody>
            </table>
            
            
        </div>
    </div>
</div>
<?php $this->endWidget();?>
</div>


<div class="flash-notice span-22 last">
<p>Halaman ini masih dalam pengembangan <tt><?php echo 'dari administrator simoku'; ?></tt>.</p>
</div>

</div>