<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<?php include_once('tpl_sidebar.php');?>
<div id="page-wrapper">
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
					<?php echo $this->Ctitle;?><small><?php IF($this->action->Id != 'index') echo ' - '.$this->action->Id; ?></small>
				</h1>
				<?php if(isset($this->breadcrumbs)):?>
					<?php $this->widget('zii.widgets.CBreadcrumbs', array(
						'links'=>$this->breadcrumbs,
						'homeLink'=>CHtml::link('Dashboard'),
						'htmlOptions'=>array('class'=>'breadcrumb')
					)); ?><!-- breadcrumbs -->
				<?php endif?>					
<!--						
				<ol class="breadcrumb">
					<li class="active">
						<i class="fa fa-dashboard"></i> Dashboard
					</li>
				</ol>
-->						
			</div>
		</div>
		<!-- /.row -->
		
	<!-- 	
		<div class="row">
			<div class="col-lg-12">
				<div class="alert alert-info alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i class="fa fa-info-circle"></i>  <strong>Like SB Admin?</strong> Try out <a href="http://startbootstrap.com/template-overviews/sb-admin-2" class="alert-link">SB Admin 2</a> for additional features!
				</div>
			</div>
		</div>
		/.row -->	
						<?php echo $content; ?>		
		<!--
		<div class="row">
			<div class="col-lg-12">
				<div class="alert alert-info alert-dismissable">
						<?php //echo $content; ?>
				</div>
			</div>
		</div>
		 /.row -->	

		

		
	</div>
	<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
		
<?php $this->endContent(); ?>