        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo Yii::app()->createUrl('');?>/">Kelaskosong.net</a>
            </div>
           <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
<!--			
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
				
-->				
                <li class="dropdown">
                    <a href="<?php echo Yii::app()->createUrl('user/view');?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo Yii::app()->user->name ; ?></a>
<?php /* echo CHtml::link("edit", array('/blog/post/update/id/'.$data->id), array(
        'rel'=>'tooltip',
        'title'=>'Edit this post',
        'visible'=>!Yii::app()->user->isGuest,
));  */ ?>					
                </li>
				
				
            </ul>
