<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Edit Your Profile</h3>
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
					<form role="form" method="post" action="<?php echo site_url('profile/edit') ?>">
						<div class="form-group">
							<label>E-mail Address</label>
							<input class="form-control" name="user_email" type="text" readonly="readonly" value="<?php echo $sess["email"] ?>">
							<p class="help-block">This email address has been used for login of <?php echo $sitetitle ?> Application</p>
						</div>
						<div class="form-group">
							<label>Full Name</label>
							<input class="form-control" name="user_name" type="text" value="<?php echo $sess["uname"] ?>">
					<?php echo (form_error("user_name",'<p class="help-block">','</p>'))?form_error("user_name",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter your full name</p>'; ?>		
							
						</div>
						<div class="form-group">
							<label>New Password</label>
							<input class="form-control" name="user_pass" value="" type="password">
							<?php echo (form_error("user_pass",'<p class="help-block">','</p>'))?form_error("user_pass",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter your new password. Leave blank if you don\'t change your password </p>'; ?>		
							
						</div>
						<button type="submit" class="btn btn-primary" name="editbtn" value="update">Update</button>
					</form>
<?php } else { ?>
					<div class="alert alert-dismissable alert-success">
						  <?php echo $msg ?>
						  <script>
							window.setTimeout('location.href="<?php echo site_url('profile/edit') ?>"',3000);
						  </script>
					</div>
<?php } ?>					
				</div>
            </div>
		</div>
	</div>  

</div>
<?php $this->load->view('includes/footer'); ?>