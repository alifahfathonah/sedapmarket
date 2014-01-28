<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Settings</h3>
				</div>
				<div class="panel-body info">
<?php $sess = $this->session->userdata("security");
	  $msg = $this->session->flashdata('message');
	  $err = $this->session->flashdata('error');
      if(!$msg) { 
		if($err) { ?>		
					<div class="alert alert-dismissable alert-success">
						  <?php echo $err ?>
					</div>
<?php   } ?>					
					<form role="form" method="post" action="<?php echo site_url('setup') ?>" enctype="multipart/form-data">
<?php 	if($setuplist) {
			foreach($setuplist as $setup) {
				switch($setup["option_name"]) {
					case "SITETITLE":
					case "SITEDESC":
					case "PAGEITEM":?>	
						<div class="form-group">
							<label>
								<input type="hidden" name="option_name[]" value="<?php echo $setup["option_name"]?>">
								<?php echo $setup["option_title"]?>
							</label>
							<input class="form-control" name="option_value[]" type="text"  value="<?php echo $setup["option_value"] ?>">
							<?php echo (form_error("option_value[]",'<p class="help-block">','</p>'))?form_error("option_value[]",'<p class="help-block errors">','</p>'):'<p class="help-block">'.$setup["option_desc"].'</p>'; ?>
						</div>
<?php 				break;
					case "FAVICON": ?>
						<div class="form-group">
							<label>
								<input type="hidden" name="option_name[]" value="<?php echo $setup["option_name"]?>">
								<?php echo $setup["option_title"]?>
							</label>
							<input name="option_value[]" type="file"  value="">
							<?php echo (form_error("option_value[]",'<p class="help-block">','</p>'))?form_error("option_value[]",'<p class="help-block errors">','</p>'):'<p class="help-block">'.$setup["option_desc"].'</p>'; ?>
						</div>
<?php				break;	
					case "FORMATDATE": ?>
						<div class="form-group">
							<label>
								<input type="hidden" name="option_name[]" value="<?php echo $setup["option_name"]?>">
								<?php echo $setup["option_title"]?>
							</label>
							<select class="form-control" name="option_value[]">
							  <option>1</option>
							</select>
							<?php echo (form_error("option_value[]",'<p class="help-block">','</p>'))?form_error("option_value[]",'<p class="help-block errors">','</p>'):'<p class="help-block">'.$setup["option_desc"].'</p>'; ?>
						</div>
<?php				break;	
				}
			}
		} ?>						
					</form>
<?php } else { ?>
					<div class="alert alert-dismissable alert-success">
						  <?php echo $msg ?>
						  <script>
							window.setTimeout('location.href="<?php echo site_url('setup') ?>"',3000);
						  </script>
					</div>
<?php } ?>					
				</div>
			</div>	
		</div>
	</div>		
</div>
<?php $this->load->view('includes/footer'); ?>