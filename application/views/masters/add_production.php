<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h3>Production</h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Add Production </h3>
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
					<form role="form" method="post" action="<?php echo site_url('production/add/'.$cust_id) ?>" name="frm1">
						<div class="form-group">
							<label>Product Name</label>
							<input type="hidden" name="product_id" value="<?php echo set_value('product_id') ?>">
							<input class="form-control product_name" name="product_name" value="<?php echo set_value('product_name') ?>">
							<a class="iframe" href="<?php echo site_url('customer/browse/product')?>" title="Click here to choose product" ><img src="<?php echo site_url('images/static/browse.png') ?>"></a>
							<?php echo (form_error("product_id",'<p class="help-block">','</p>'))?form_error("product_id",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Product Name.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Begining Stock</label>
							<input class="form-control" name="begin_stock" value="<?php echo set_value('begin_stock') ?>">
							<?php echo (form_error("begin_stock",'<p class="help-block">','</p>'))?form_error("begin_stock",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Begining Stock.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Stock</label><br>
							<input class="form-control" name="stock" value="<?php echo set_value('stock') ?>">
							<?php echo (form_error("stock",'<p class="help-block">','</p>'))?form_error("stock",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter stock.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Ending Stock</label><br>
							<input class="form-control" name="end_stock" value="<?php echo set_value('end_stock') ?>"> %
							<?php echo (form_error("end_stock",'<p class="help-block">','</p>'))?form_error("end_stock",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter End Stock.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" rows="3" name="price_desc"><?php echo set_value("price_desc")?></textarea>
							<?php echo (form_error("price_desc",'<p class="help-block">','</p>'))?form_error("price_desc",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter description for this Pricw.</p>'; ?>		
						</div>
						
						<button type="submit" class="btn btn-primary" name="addbtn" value="update">Add</button>
					</form>
<?php } else { ?>
					<div class="alert alert-dismissable alert-success">
						  <?php echo $msg ?>
						  <script>
							window.setTimeout('location.href="<?php echo site_url('production/list) ?>"',3000);
						  </script>
					</div>
<?php } ?>										
				</div>
            </div>
		</div>
	</div>  
</div>
<?php $this->load->view('includes/footer'); ?>