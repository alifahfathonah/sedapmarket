<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h3>Products</h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Add Category</h3>
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
					<form role="form" method="post" action="<?php echo site_url('category/add') ?>">
						<div class="form-group">
							<label>Category Name</label>
							<input class="form-control datef" name="category_name" value="<?php echo set_value('category_name') ?>">
							<?php echo (form_error("category_name",'<p class="help-block">','</p>'))?form_error("category_name",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Category name.</p>'; ?>		
						</div>
						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" rows="3" name="category_desc"><?php echo set_value("category_desc")?></textarea>
							<?php echo (form_error("category_desc",'<p class="help-block">','</p>'))?form_error("category_desc",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter description for this Category.</p>'; ?>		
						</div>
						
						<button type="submit" class="btn btn-primary" name="addbtn" value="add">Add</button>
					</form>
<?php } else { ?>
					<div class="alert alert-dismissable alert-success">
						  <?php echo $msg ?>
						  <script>
							window.setTimeout('location.href="<?php echo site_url('category/list') ?>"',3000);
						  </script>
					</div>
<?php } ?>										
				</div>
            </div>
		</div>
	</div>  
</div>
<?php $this->load->view('includes/footer'); ?>