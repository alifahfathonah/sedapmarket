<?php $this->load->view('includes/header'); ?>
<div class="row">
	<h1>Administrator Sedap Market</h1>
</div>

<div class="row login">
	<div class="alert alert-info alert-dismissable">
		
		Enter your user name and password below.
	</div>
</div>

<div class="row login">
	<form role="form" method="post" action="<?php echo site_url('login') ?>">
		<div class="form-group">
			<label>User Name</label>
			<input class="form-control" type="text" name="username">
			<p class="help-block">Example block-level help text here.</p>
		</div>
		<div class="form-group">
			<label>Password</label>
			<input class="form-control" type="password">
			<p class="help-block">Example block-level help text here.</p>
		</div>
		
		<button type="submit" class="btn btn-default">Login</button>
	</form>
</div>
<?php $this->load->view('includes/footer'); ?>