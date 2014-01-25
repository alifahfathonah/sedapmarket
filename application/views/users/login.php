<?php $this->load->view('includes/header'); ?>
<div class="row">
	<h1>Administrator Sedap Market</h1>
</div>

<div class="row login">
	<div class="alert alert-info alert-dismissable">
<?php $err = $this->session->flashdata('error');
	  if($err) {
		echo $err;
	  }
	  else { ?>		
		Enter your user name and password below.
<?php } ?>		
	</div>
</div>

<div class="row login">
	<form role="form" method="post" action="<?php echo site_url('login') ?>">
		<div class="form-group">
			<label>E-Mail Address</label>
			<input class="form-control" type="text" name="user_email" value="<?php echo set_value("user_email") ?>">
			<p class="help-block"><?php echo form_error("user_email",'<p class="errors">','</p>') ?></p>
		</div>
		<div class="form-group">
			<label>Password</label>
			<input class="form-control" type="password" name="user_pass">
			<p class="help-block"><?php echo form_error("user_pass",'<p class="errors">','</p>') ?></p>
		</div>
		
		<button type="submit" class="btn btn-default" name="loginbtn" value="login">Login</button>
	</form>
</div>
<?php $this->load->view('includes/footer'); ?>