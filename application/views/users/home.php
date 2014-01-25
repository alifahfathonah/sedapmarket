<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Information</h3>
				</div>
				<div class="panel-body info">
<?php $sess = $this->session->userdata("security"); ?> 					
					<p>
						<label>Your User ID</label>
						<?php echo $sess['uname'] ?>
					</p>
					<p>
						<label>Last Login Date</label>
						<?php echo $sess['last'] ?>
					</p>
				</div>
            </div>
		</div>
	</div>  
<div>
<?php $this->load->view('includes/footer'); ?>