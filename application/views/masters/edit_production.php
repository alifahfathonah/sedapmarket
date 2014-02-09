<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h3>Production <?php echo $cust_name; ?></h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Edit Production</h3>
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
					<form role="form" method="post" action="<?php echo site_url('production/edit/'.$prod_id) ?>">
						<div class="form-group">
							<label>Product Name</label>
							<input type="hidden" name="product_id" value="<?php echo $prod['product_id'] ?>">
							<input class="form-control" name="product_name" value="<?php echo $prod['product_name'] ?>">
							<?php echo (form_error("product_id",'<p class="help-block">','</p>'))?form_error("product_id",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Product Name.</p>'; ?>
							<?php echo (form_error("product_name",'<p class="help-block">','</p>'))?form_error("product_name",'<p class="help-block errors">','</p>'):''; ?>							
						</div>
						<div class="form-group">
							<label>Begining Stock</label>
							<input class="form-control" name="price" value="<?php echo $prod['begin_stock'] ?>">
							<?php echo (form_error("begin_stock",'<p class="help-block">','</p>'))?form_error("begin_stock",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Beginning Stock.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Stock</label>
							<input class="form-control" name="stock" value="<?php echo $prod['stock'] ?>">
							<?php echo (form_error("stock",'<p class="help-block">','</p>'))?form_error("stock",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Discount.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Ending Stock</label>
							<input class="form-control" name="disc2" value="<?php echo $prod['disc2'] ?>">
							<?php echo (form_error("end_stock",'<p class="help-block">','</p>'))?form_error("end_stock",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Discount.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" rows="3" name="production_desc"><?php echo $prod["production_desc"]?></textarea>
							<?php echo (form_error("production_desc",'<p class="help-block">','</p>'))?form_error("production_desc",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter description for this Region.</p>'; ?>		
						</div>
							
						<button type="submit" class="btn btn-primary" name="editbtn" value="update">Update</button>
					</form>
<?php } else { ?>
					<div class="alert alert-dismissable alert-success">
						  <?php echo $msg ?>
						  <script>
							window.setTimeout('location.href="<?php echo site_url('customer/price/list/'.$cust_id) ?>"',3000);
						  </script>
					</div>
<?php } ?>										
				</div>
            </div>
		</div>
	</div>  
</div>
<?php $this->load->view('includes/footer'); ?>