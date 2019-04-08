<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

                <div class="row">
                   <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php print_r($complaint['0']['complaint']); ?></div>
                                        <div>Attribute Complaint</div>
                                    </div>
                                </div>
                            </div>
                            <a href=<?php echo Yii::app()->createUrl('site/complaint') ?>>
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>                    
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php print_r($tscheduled['0']['jadwal']); ?></div>
                                        <div>Terjadwal Hari Ini</div>
                                    </div>
                                </div>
                            </div>
                            <a href=<?php echo Yii::app()->createUrl('site/scheduled') ?>>
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php print_r($tcanceled['0']['cancel']); ?></div>
                                        <div>Dibatalkan Hari Ini</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                     <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
<!--                                        <i class="fa fa-comments fa-5x"></i>
-->
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php // print_r($tstats['0']['stats']); ?></div>
                                        <div>Held til today</div>
                                    </div>
                                </div>
                            </div>
                            <a href=<?php echo Yii::app()->createUrl('site/stats') ?>  onclick="return confirm('Link ini mengandung load data tinggi. Anda yakin?')">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                </div>
                <!-- /.row -->

      <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Dashboard Info</h3>
                            </div>
                            <div class="panel-body">
                                Ini adalah halaman "<i class="fa fa-fw fa-dashboard"></i> dashboard", halaman ini masih dalam tahap pengembangan.</br>
                                Pilih "<i class="fa fa-fw fa-file"></i> Akademik" untuk pengaturan berkaitan dengan parameter akademik.</br>
                                Pilih "<i class="fa fa-fw fa-wrench"></i> Sarpras" untuk pengaturan berkaitan dengan parameter sarana dan prasarana ruangan.</br>
                                Pilih "<i class="fa fa-fw fa-wrench"></i> Operasi Laman Ini" untuk melihat pilihan operasi yang tersedia untuk tiap laman. Menu ini dapat berbeda tergantung laman yang dibuka.</br>
                                Pilih attribute complaint pada box di atas untuk melihat rincian status kondisi atribut sarana dan prasarana ruang.</br>
                            </div>                
                        </div>
      </div>
                
      <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Kelas Batal Hari Ini </h3>
                            </div>
                            <div class="panel-body">
                                <?php
                                    $gridDataProvider = new CArrayDataProvider($c, array('keyField' => 'id','pagination'=>array('pageSize'=> 20,)));
                                    // $gridColumns
                                    $gridColumns = array(
                                            array('name'=>'kelas', 'header'=>'Kelas', 'htmlOptions'=>array('style'=>'width: 60px')),
                                            array('name'=>'ruang', 'header'=>'Ruang'),
                                            array('name'=>'jam', 'header'=>'Mulai'),
                                            array('name'=>'session_length', 'header'=>'Sesi'),
                                            //array('name'=>'created', 'header'=>'Tanggal', 'value' => 'number_format($data["created"],2,",",".")',  'htmlOptions'=>array('style'=>'text-align:right')),
                                    );
                                    $this->widget(
                                        'booster.widgets.TbGridView',
                                        array(
                                            'type' => 'condensed',
                                            'dataProvider' => $gridDataProvider,
                                            'template' => "{items}\n{pager}",
                                            'columns' => $gridColumns,
                                        )
                                    );
                                    echo '<p><em style="font-size:x-small; color:#00F; text-align:end">Sesi dimulai dari pukul 07.30 (Sesi 2). Jadwal yang dibatalkan dapat sudah digunakan oleh kelas lain. Pastikan kembali ketersediaan jadwal dengan menghubungi kelas bersangkutan melalui "contact list"</em><br>';                                
                                ?>
                            </div>
                        </div>
                    </div>    
<!--                
                    <div class="col-lg-4">				
                       <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Order Date</th>
                                                <th>Order Time</th>
                                                <th>Amount (USD)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>3326</td>
                                                <td>10/21/2013</td>
                                                <td>3:29 PM</td>
                                                <td>$321.33</td>
                                            </tr>
                                            <tr>
                                                <td>3325</td>
                                                <td>10/21/2013</td>
                                                <td>3:20 PM</td>
                                                <td>$234.34</td>
                                            </tr>
                                            <tr>
                                                <td>3324</td>
                                                <td>10/21/2013</td>
                                                <td>3:03 PM</td>
                                                <td>$724.17</td>
                                            </tr>
                                            <tr>
                                                <td>3323</td>
                                                <td>10/21/2013</td>
                                                <td>3:00 PM</td>
                                                <td>$23.71</td>
                                            </tr>
                                            <tr>
                                                <td>3322</td>
                                                <td>10/21/2013</td>
                                                <td>2:49 PM</td>
                                                <td>$8345.23</td>
                                            </tr>
                                            <tr>
                                                <td>3321</td>
                                                <td>10/21/2013</td>
                                                <td>2:23 PM</td>
                                                <td>$245.12</td>
                                            </tr>
                                            <tr>
                                                <td>3320</td>
                                                <td>10/21/2013</td>
                                                <td>2:15 PM</td>
                                                <td>$5663.54</td>
                                            </tr>
                                            <tr>
                                                <td>3319</td>
                                                <td>10/21/2013</td>
                                                <td>2:13 PM</td>
                                                <td>$943.45</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>		
-->
<!--				
      <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Notifikasi</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <span class="badge">just now</span>
                                        <i class="fa fa-fw fa-calendar"></i> Calendar updated
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">4 minutes ago</span>
                                        <i class="fa fa-fw fa-comment"></i> Commented on a post
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">23 minutes ago</span>
                                        <i class="fa fa-fw fa-truck"></i> Order 392 shipped
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">46 minutes ago</span>
                                        <i class="fa fa-fw fa-money"></i> Invoice 653 has been paid
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">1 hour ago</span>
                                        <i class="fa fa-fw fa-user"></i> A new user has been added
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">2 hours ago</span>
                                        <i class="fa fa-fw fa-check"></i> Completed task: "pick up dry cleaning"
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">yesterday</span>
                                        <i class="fa fa-fw fa-globe"></i> Saved the world
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <span class="badge">two days ago</span>
                                        <i class="fa fa-fw fa-check"></i> Completed task: "fix error on sales page"
                                    </a>
                                </div>
                                <div class="text-right">
                                    <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
-->                