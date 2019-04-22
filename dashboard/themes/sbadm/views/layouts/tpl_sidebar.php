            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li <?php IF($this->uniqueid == 'site') echo 'class="active"'?>>
                        <?php echo CHtml::link('<i class="fa fa-fw fa-dashboard"></i> Dashboard',array('/')); ?>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#akademik" ><i class="fa fa-fw fa-file"></i> Akademik <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="akademik" class="collapse">
                            <li>
                                <?php echo CHtml::link('Jurusan',array('/jurusan/index')); ?>
                            </li>
                            <li>
                                <?php echo CHtml::link('Mata Kuliah',array('/MataKuliah/')); ?>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#sarpras"><i class="fa fa-fw fa-wrench"></i> SarPras <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="sarpras" class="collapse">
                            <li>
                                <?php echo CHtml::link('Atribut SarPras',array('/Attribute/')); ?>
                            </li>
                            <li>
                                <?php echo CHtml::link('Ruang Kelas',array('/Building/')); ?>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#ruang"><i class="fa fa-fw fa-wrench"></i> Pemakaian Ruang <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="ruang" class="collapse">
                            <li>
                                <?php echo CHtml::link('Persetujuan Pemakaian',array('/pakai-ruang/')); ?>
                            </li>
                        </ul>
                    </li>
                    <li <?php IF($this->uniqueid == 'user') echo 'class="active"'?>>
                        <?php echo CHtml::link('<i class="fa fa-user"></i>  User',array('user/')); ?>
                    </li>     
                    <li <?php IF($this->uniqueid == 'notification') echo 'class="active"'?>>
                        <?php echo CHtml::link('<i class="fa fa-fw fa-file"></i>  Notif',array('notification/')); ?>
                    </li>                     
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#operasi"><i class="fa fa-fw fa-wrench"></i> Operasi Laman Ini<i class="fa fa-fw fa-caret-down"></i></a>
						<?php
						$this->widget('zii.widgets.CMenu', array(
						  'items'=>$this->menu,
						  'htmlOptions'=>array('class'=>'collapse', 'id' => 'operasi'),
						));
						?>			
                    </li>	
                    <li>
                        <?php echo CHtml::link('<i class="fa fa-fw fa-desktop"></i> Logout',array('/site/logout')); ?>
                    </li>					
                </ul>
            </div>		
            <!-- /.navbar-collapse -->
        </nav>