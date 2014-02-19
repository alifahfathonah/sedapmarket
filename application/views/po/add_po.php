<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h3>Purchase Order</h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Add PO</h3>
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
					<form role="form" method="post" action="<?php echo site_url('po/add') ?>" name="frm1">
						<div class="form-group">
							<label>PO Date</label>
							<input class="form-control datef" name="po_date" value="<?php echo set_value('po_date') ?>" readonly="readonly">
							<?php echo (form_error("po_date",'<p class="help-block">','</p>'))?form_error("po_date",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter PO Date.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>PO Number</label>
							<input class="form-control" name="po_no" value="<?php echo set_value('po_no') ?>">
							<?php echo (form_error("po_no",'<p class="help-block">','</p>'))?form_error("po_no",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter PO Number.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Customer Name</label>
							<input id="cust_id" name="cust_id" type="hidden" value="<?php echo set_value('cust_id') ?>">
							<input class="form-control cust_name" name="cust_fullname" value="<?php echo set_value('cust_fullname') ?>">
							<a href="<?php echo site_url('browse/customers') ?>" class="iframe"><img src="<?php echo site_url('images/static/browse.png') ?>"></a>
							<?php echo (form_error("cust_id",'<p class="help-block">','</p>'))?form_error("cust_id",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Customer Name.</p>'; ?>		
							<?php echo (form_error("cust_fullname",'<p class="help-block">','</p>'))?form_error("cust_fullname",'<p class="help-block errors">','</p>'):''; ?>		
						</div>
						<div class="form-group">
							<label>Shipping</label>
							<input name="ship_id" value="<?php echo set_value('ship_id') ?>" type="hidden">
							<input class="form-control ship_name" name="ship_name" value="<?php echo set_value('ship_name') ?>">
							<a href="<?php echo site_url("browse/ship") ?>" class="iframe"><img src="<?php echo site_url('images/static/browse.png') ?>"></a>
							<?php echo (form_error("ship_id",'<p class="help-block">','</p>'))?form_error("ship_id",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Shipping Name.</p>'; ?>		
							<?php echo (form_error("ship_name",'<p class="help-block">','</p>'))?form_error("ship_name",'<p class="help-block errors">','</p>'):''; ?>		
						</div>
						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" rows="3" name="po_desc"><?php echo set_value("po_desc")?></textarea>
							<?php echo (form_error("po_desc",'<p class="help-block">','</p>'))?form_error("po_desc",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter description for this PO.</p>'; ?>		
						</div>
						
						<button type="submit" class="btn btn-primary" name="addbtn" value="add">Add</button>
					</form>
<?php } else { ?>
					<div class="alert alert-dismissable alert-success">
						  <?php echo $msg ?>
						  <script>
							window.setTimeout('location.href="<?php echo site_url('po/list') ?>"',3000);
						  </script>
					</div>
<?php } ?>										
				</div>
            </div>
		</div>
	</div>  
</div>
<?php $this->load->view('includes/footer'); ?>