<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h3>Customer</h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Add Set Price </h3>
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
					<form role="form" method="post" action="<?php echo site_url('customer/price/add') ?>">
						<div class="form-group">
							<label>Product Name</label>
							<input type="hidden" name="product_id" value="<?php echo set_value('product_id') ?>">
							<input class="form-control product_name" name="product_name" value="<?php echo set_value('product_name') ?>">
							<a href="#" title="Click here to choose product" ><img src="<?php echo site_url('images/static/browse.png') ?>"></a>
							<?php echo (form_error("product_id",'<p class="help-block">','</p>'))?form_error("product_id",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Product Name.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Price</label>
							<input class="form-control" name="price" value="<?php echo set_value('price') ?>">
							<?php echo (form_error("price",'<p class="help-block">','</p>'))?form_error("price",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Price.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Discount 1</label><br>
							<input class="form-control disc" name="disc1" value="<?php echo set_value('disc1') ?>"> %
							<?php echo (form_error("disc1",'<p class="help-block">','</p>'))?form_error("disc1",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Discount.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Discount 2</label><br>
							<input class="form-control disc" name="disc2" value="<?php echo set_value('disc2') ?>"> %
							<?php echo (form_error("disc2",'<p class="help-block">','</p>'))?form_error("disc2",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Discount.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Discount 3</label><br>
							<input class="form-control disc" name="disc3" value="<?php echo set_value('disc3') ?>"> %
							<?php echo (form_error("disc3",'<p class="help-block">','</p>'))?form_error("disc3",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Discount.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" rows="3" name="price_desc"><?php echo set_value("price_desc")?></textarea>
							<?php echo (form_error("price_desc",'<p class="help-block">','</p>'))?form_error("price_desc",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter description for this Region.</p>'; ?>		
						</div>
						
						<button type="submit" class="btn btn-primary" name="editbtn" value="update">Update</button>
					</form>
<?php } else { ?>
					<div class="alert alert-dismissable alert-success">
						  <?php echo $msg ?>
						  <script>
							window.setTimeout('location.href="<?php echo site_url('region/list') ?>"',3000);
						  </script>
					</div>
<?php } ?>										
				</div>
            </div>
		</div>
	</div>  
</div>
<?php $this->load->view('includes/footer'); ?>