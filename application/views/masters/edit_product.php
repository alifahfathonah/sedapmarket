<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h3>Products</h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Edit Product</h3>
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
					<form role="form" method="post" action="<?php echo site_url('products/edit/'.$prod["product_id"]) ?>">
						<div class="form-group">
							<label>Category Name</label>
							<select class="form-control" name="category_id">
								<option value="">Please Choose</option>
<?php if($catlist) { 
		foreach($catlist as $cat) { ?>
								<option value="<?php echo $cat["category_id"] ?>" <?php echo ($prod["category_id"]==$cat["category_id"])?"selected='selected'":"" ?>><?php echo $cat["category_name"] ?></option>
<?php 	}
	  }		
?>								
							</select>
							<?php echo (form_error("category_id",'<p class="help-block">','</p>'))?form_error("category_id",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Product name.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Product Name</label>
							<input class="form-control" name="product_name" value="<?php echo $prod['product_name'] ?>">
							<?php echo (form_error("product_name",'<p class="help-block">','</p>'))?form_error("product_name",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Product name.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Kemasan</label>
							<div class="radio">
								<label>
									<input type="radio" name="product_kemasan" value="Yes" <?php echo (!$prod['product_kemasan'] || $prod['product_kemasan']=='Yes')?"checked='checked'":"" ?>> Yes
								</label>	
							</div>	
							<div class="radio">
								<label>
									<input type="radio" name="product_kemasan" value="No" <?php echo ($prod['product_kemasan']=='No')?"checked='checked'":"" ?> > No 
								</label>
							</div>	
							<?php echo (form_error("product_kemasan",'<p class="help-block">','</p>'))?form_error("product_name",'<p class="help-block errors">','</p>'):'<p class="help-block">Do your product kemasan?</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Stock</label>
							<input class="form-control" name="product_stock" value="<?php echo $prod['product_stock'] ?>">
							<?php echo (form_error("product_stock",'<p class="help-block">','</p>'))?form_error("product_stock",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Product Stock.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Price</label>
							<input class="form-control" name="product_price" value="<?php echo $prod['product_price'] ?>">
							<?php echo (form_error("product_price",'<p class="help-block">','</p>'))?form_error("product_price",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Product Price.</p>'; ?>		
						</div>
						<button type="submit" class="btn btn-primary" name="editbtn" value="update">Update</button>
					</form>
<?php } else { ?>
					<div class="alert alert-dismissable alert-success">
						  <?php echo $msg ?>
						  <script>
							window.setTimeout('location.href="<?php echo site_url('products/list') ?>"',3000);
						  </script>
					</div>
<?php } ?>										
				</div>
            </div>
		</div>
	</div>  
</div>
<?php $this->load->view('includes/footer'); ?>