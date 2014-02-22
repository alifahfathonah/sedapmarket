<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h3>Transcation</h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Edit Transcation</h3>
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
					<form role="form" method="post" action="<?php echo site_url('transcation/edit/'.$trans_id) ?>" name="frm1">
						<div class="form-group">
							<label>Transcation Date</label>
							<input class="form-control datef" name="trans_date" value="<?php echo $trans['trans_date'] ?>" readonly="readonly">
							<?php echo (form_error("trans_date",'<p class="help-block">','</p>'))?form_error("trans_date",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter transcation Date.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Delivery Order Number</label>
							<input class="form-control" name="no_sj" value="<?php echo $trans['no_sj'] ?>" readonly="readonly">
							<?php echo (form_error("no_sj",'<p class="help-block">','</p>'))?form_error("no_sj",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Delivery Order Number.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Car Number</label>
							<!--<input id="cust_id" name="cust_id" type="hidden" value="<?php echo $trans['cust_id'] ?>">-->
							<input class="form-control" name="no_mobil" value="<?php echo $trans['no_mobil'] ?>">
							<!-- <a href="<?php echo site_url('browse/customers') ?>" class="iframe"><img src="<?php echo site_url('images/static/browse.png') ?>"></a> -->
							<?php echo (form_error("no_mobil",'<p class="help-block">','</p>'))?form_error("no_mobil",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Car Number.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Container Number</label>
							<!--<input name="ship_id" value="<?php echo $trans['ship_id'] ?>" type="hidden">-->
							<input class="form-control" name="no_container" value="<?php echo $trans['no_container'] ?>">
							<!-- <a href="<?php echo site_url("browse/ship") ?>" class="iframe"><img src="<?php echo site_url('images/static/browse.png') ?>"></a> -->
							<?php echo (form_error("no_container",'<p class="help-block">','</p>'))?form_error("no_container",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Containner Numbers.</p>'; ?>		
							<?php //echo (form_error("ship_name",'<p class="help-block">','</p>'))?form_error("ship_name",'<p class="help-block errors">','</p>'):''; ?>		
						</div>
						<div class="form-group">
							<label>Seal Number</label>
							<input class="form-control" name="no_seal" value="<?php echo $trans['no_seal'] ?>">
							<?php echo (form_error("no_seal",'<p class="help-block">','</p>'))?form_error("no_seal",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Seal Number.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" rows="3" name="trans_desc"><?php echo $trans["trans_desc"]?></textarea>
							<?php echo (form_error("trans_desc",'<p class="help-block">','</p>'))?form_error("trans_desc",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter description for this transcation.</p>'; ?>		
						</div>
						
						<button type="submit" class="btn btn-primary" name="editbtn" value="update">Update</button>
					</form>
<?php } else { ?>
					<div class="alert alert-dismissable alert-success">
						  <?php echo $msg ?>
						  <script>
							window.setTimeout('location.href="<?php echo site_url('transcation/list') ?>"',3000);
						  </script>
					</div>
<?php } ?>										
				</div>
            </div>
		</div>
	</div>  
</div>
<?php $this->load->view('includes/footer'); ?>