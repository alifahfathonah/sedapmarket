<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h3>Shipping</h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Edit Shipping</h3>
				</div>
				<div class="panel-body info">
<?php $msg = $this->session->flashdata('message');
	  $err = $this->session->flashdata('error');
      if(!$msg) { 
		if($err) { ?>		
					<div class="alert alert-dismissable alert-success">
						  <?php echo $err ?>
					</div>
<?php   } ?>					
					<form role="form" method="post" action="<?php echo site_url('shipper/edit/'.$ship_id) ?>">
						<div class="form-group">
							<label>Shipper Name</label>
							<input class="form-control" name="ship_name" value="<?php echo $shipper['ship_name'] ?>">
							<?php echo (form_error("ship_name",'<p class="help-block">','</p>'))?form_error("ship_name",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Shipper name.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" rows="3" name="ship_desc"><?php echo $shipper["ship_desc"]?></textarea>
							<?php echo (form_error("ship_desc",'<p class="help-block">','</p>'))?form_error("ship_desc",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter description for this Shipper.</p>'; ?>		
						</div>
						
						<button type="submit" class="btn btn-primary" name="editbtn" value="update">Update</button>
					</form>
<?php } else { ?>
					<div class="alert alert-dismissable alert-success">
						  <?php echo $msg ?>
						  <script>
							window.setTimeout('location.href="<?php echo site_url('shipper/list') ?>"',3000);
						  </script>
					</div>
<?php } ?>										
				</div>
            </div>
		</div>
	</div>  
</div>
<?php $this->load->view('includes/footer'); ?>