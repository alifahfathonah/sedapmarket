<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Information</h3>
				</div>
				<div class="panel-body info">
<?php 
$sess = $this->session->userdata("security"); 
if($sess['last']!="0000-00-00 00:00:00") { 
	$tmp = new DateTime($sess["last"]);
	$last= $tmp->format($this->siteconfig[1]["option_value"]);
}	  
else {
	$last = "Never Login";
}
?> 					
					<p>
						<label>Your User ID</label>
						<?php echo $sess['uname']." (<a href='mailto:".$sess['email']."'>".$sess['email']."</a>)" ?>
					</p>
					<p>
						<label>Last Login Date</label>
						<?php echo $last ?>
					</p>
				</div>
            </div>
		</div>
	</div>  
</div>
<?php $this->load->view('includes/footer'); ?>