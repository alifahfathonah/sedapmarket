<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h3>Transcation <?php echo $do_no ?></h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Add Transcation Detail</h3>
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
					<form role="form" method="post" action="<?php echo site_url('transcation/detail/add/'.$trans_id) ?>" name="frm1">
						<div class="form-group">
							<label>Product Name</label>
							<input type="hidden" name="product_id" value="<?php echo set_value('product_id') ?>">
							<input class="form-control product_name" name="product_name" value="<?php echo set_value('product_name') ?>">
							<a class="iframe" href="<?php echo site_url('browse/product/3')?>" title="Click here to choose product" ><img src="<?php echo site_url('images/static/browse.png') ?>"></a>
							<?php echo (form_error("product_id",'<p class="help-block">','</p>'))?form_error("product_id",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Product Name.</p>'; ?>		
							<?php echo (form_error("product_name",'<p class="help-block">','</p>'))?form_error("product_name",'<p class="help-block errors">','</p>'):''; ?>		
						</div>
						<div class="form-group">
							<label>Quantity</label><br>
							<input class="form-control smallInput InputLine" name="qty" value="<?php echo set_value('qty') ?>">
							<input type="hidden" name="unit_id" value="<?php echo set_value('unit_id') ?>">
							<input class="form-control smallInput Inputhidden" readonly="readonly" name="unit_name" value="<?php echo set_value('unit_name') ?>">
							<?php echo (form_error("qty",'<p class="help-block">','</p>'))?form_error("qty",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Quantity.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Product Extra</label>
							<input type="hidden" name="product_extra_id" value="<?php echo set_value('product_extra_id') ?>">
							<input class="form-control product_name" name="product_extra_name" value="<?php echo set_value('product_extra_name') ?>">
							<a class="iframe" href="<?php echo site_url('browse/product/4')?>" title="Click here to choose product" ><img src="<?php echo site_url('images/static/browse.png') ?>"></a>
							<?php echo (form_error("product_extra_id",'<p class="help-block">','</p>'))?form_error("product_extra_id",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Product Extra.</p>'; ?>		
							<?php echo (form_error("product_extra_name",'<p class="help-block">','</p>'))?form_error("product_extra_name",'<p class="help-block errors">','</p>'):''; ?>		
						</div>
						<div class="form-group">
							<label>Quantity Extra</label><br>
							<input class="form-control smallInput InputLine" name="qty_extra" value="<?php echo set_value('qty_extra') ?>">
							<input type="hidden" name="unit_extra_id" value="<?php echo set_value('unit_extra_id') ?>">
							<input class="form-control smallInput Inputhidden" readonly="readonly" name="unit_extra_name" value="<?php echo set_value('unit_extra_name') ?>">
							<?php echo (form_error("no_container",'<p class="help-block">','</p>'))?form_error("no_container",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Containner Numbers.</p>'; ?>		
							<?php //echo (form_error("ship_name",'<p class="help-block">','</p>'))?form_error("ship_name",'<p class="help-block errors">','</p>'):''; ?>		
						</div>
						
						<button type="submit" class="btn btn-primary" name="addbtn" value="add">Add</button>
					</form>
<?php } else { ?>
					<div class="alert alert-dismissable alert-success">
						  <?php echo $msg ?>
						  <script>
							window.setTimeout('location.href="<?php echo site_url('transcation/detail/list/'.$trans_id) ?>"',3000);
						  </script>
					</div>
<?php } ?>										
				</div>
            </div>
		</div>
	</div>  
</div>
<?php $this->load->view('includes/footer'); ?>