<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h3>Purchase Order <?php echo $po_no ?></h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Edit PO Detail</h3>
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
					<form role="form" method="post" action="<?php echo site_url('po/detail/edit/'.$po_id."/".$detail_id) ?>" name="frm1">
						<div class="form-group">
							<label>Product Name</label>
							<input name="product_id" type="hidden"  id="product_id" value="<?php echo $po['product_id'] ?>">
							<input class="form-control product_name" name="product_name" id="product_name" value="<?php echo $po['product_name'] ?>">
							<a href="<?php echo site_url("browse/product/2") ?>" class="iframe"><img src="<?php echo site_url('images/static/browse.png') ?>"></a>
							<?php echo (form_error("product_id",'<p class="help-block">','</p>'))?form_error("product_id",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter PO Date.</p>'; ?>
							<?php echo (form_error("product_name",'<p class="help-block">','</p>'))?form_error("product_name",'<p class="help-block errors">','</p>'):''; ?>		
						</div>
						<div class="form-group">
							<label>Quantity</label><br>
							<input class="form-control smallInput InputLine" name="qty" value="<?php echo $po['qty'] ?>">
							<input name="unit_id" type="hidden"  id="unit_id" value="<?php echo $po['unit_id'] ?>">
							<input class="form-control smallInput Inputhidden" name="unit_name" value="<?php echo $po['unit_name'] ?>" readonly="readonly">
							<?php echo (form_error("qty",'<p class="help-block">','</p>'))?form_error("qty",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter quantity.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Price</label>
							<input class="form-control" name="price" value="<?php echo $po['price'] ?>">
							<?php echo (form_error("price",'<p class="help-block">','</p>'))?form_error("price",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Price.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Discount</label><br>
							<input class="form-control smallInput InputLine" name="disc" value="<?php echo $po['disc'] ?>"> %
							<?php echo (form_error("disc",'<p class="help-block">','</p>'))?form_error("ship_id",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Discount.</p>'; ?>				
						</div>
						<button type="submit" class="btn btn-primary" name="editbtn" value="add">Update</button>
					</form>
<?php } else { ?>
					<div class="alert alert-dismissable alert-success">
						  <?php echo $msg ?>
						  <script>
							window.setTimeout('location.href="<?php echo site_url('po/detail/list/'.$po_id) ?>"',3000);
						  </script>
					</div>
<?php } ?>										
				</div>
            </div>
		</div>
	</div>  
</div>
<?php $this->load->view('includes/footer'); ?>