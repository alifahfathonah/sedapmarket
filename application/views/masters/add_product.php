<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h3>Products</h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Add Product</h3>
				</div>
				<div class="panel-body info">
<?php $msg = $this->session->flashdata('message');
	  $err = $this->session->flashdata('error');
      if(!$msg) { 
		if($err) { ?>		
					<div class="alert alert-dismissable alert-success">
						  <?php echo $err ?>
					</div>
<?php   } 
		if(form_error("product_stock",'<p class="help-block">','</p>')) {
			$ket = form_error("product_stock",'<p class="help-block errors">','</p>');
		}
		else if(form_error("unit_id",'<p class="help-block">','</p>')) {
			$ket = form_error("unit_id",'<p class="help-block errors">','</p>');
		}
		else {
			$ket = '<p class="help-block">Enter Product Stock.</p>';
		}	
?>					
					<form role="form" method="post" action="<?php echo site_url('products/add') ?>">
						<div class="form-group">
							<label>Category Name</label>
							<select class="form-control" name="category_id">
								<option value="">Please Choose</option>
<?php if($catlist) { 
		foreach($catlist as $cat) { ?>
								<option value="<?php echo $cat["category_id"] ?>" <?php echo (set_value("category_id")==$cat["category_id"])?"selected='selected'":"" ?>><?php echo $cat["category_name"] ?></option>
<?php 	}
	  }		
?>								
							</select>
							<?php echo (form_error("category_id",'<p class="help-block">','</p>'))?form_error("category_id",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Product name.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Product Name</label>
							<input class="form-control" name="product_name" value="<?php echo set_value('product_name') ?>">
							<?php echo (form_error("product_name",'<p class="help-block">','</p>'))?form_error("product_name",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Product name.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Kemasan</label>
							<div class="radio">
								<label>
									<input type="radio" name="product_kemasan" value="Yes" <?php echo (!set_value('product_kemasan') || set_value('product_kemasan')=='Yes')?"checked='checked'":"" ?>> Yes
								</label>	
							</div>	
							<div class="radio">
								<label>
									<input type="radio" name="product_kemasan" value="No" <?php echo (set_value('product_kemasan')=='No')?"checked='checked'":"" ?> > No 
								</label>
							</div>	
							<?php echo (form_error("product_kemasan",'<p class="help-block">','</p>'))?form_error("product_name",'<p class="help-block errors">','</p>'):'<p class="help-block">Do your product kemasan?</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Stock</label><br>
							<input class="form-control smallInput InputLine" name="product_stock" value="<?php echo set_value('product_stock') ?>">
							<select class="form-control mediumInput InputLine" name="unit_id" style="display:inline">
								<option value="">Please Choose Unit</option>
<?php if($unitlist) { 
		foreach($unitlist as $unit) { ?>
								<option value="<?php echo $unit["unit_id"] ?>" <?php echo (set_value("unit_id")==$unit["unit_id"])?"selected='selected'":"" ?>><?php echo $unit["unit_name"] ?></option>
<?php 	}
	  }		
?>								
							</select>
							<?php echo $ket; ?>		
						</div>
						<div class="form-group">
							<label>Price</label>
							<input class="form-control" name="product_price" value="<?php echo set_value('product_price') ?>">
							<?php echo (form_error("product_price",'<p class="help-block">','</p>'))?form_error("product_price",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Product Price.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Discount</label><br>
							<input class="form-control smallInput InputLine" name="product_disc" value="<?php echo (!set_value('product_disc'))?0:set_value('product_disc') ?>"> %
							<?php echo (form_error("product_disc",'<p class="help-block">','</p>'))?form_error("product_disc",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Product Disc.</p>'; ?>		
						</div>
						<button type="submit" class="btn btn-primary" name="addbtn" value="add">Add</button>
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