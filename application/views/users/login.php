<?php $this->load->view('includes/header'); ?>
<div class="row">
	<h1>Administrator Sedap Market</h1>
</div>

<div class="row login">
	<div class="alert alert-info alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		Enter your user name and password below.
	</div>
</div>

<div class="row login">
	<form role="form">
		<div class="form-group">
			<label>User Name</label>
			<input class="form-control">
			<p class="help-block">Example block-level help text here.</p>
		</div>
		<div class="form-group">
			<label>Password</label>
			<input class="form-control">
			<p class="help-block">Example block-level help text here.</p>
		</div>
		
		<button type="submit" class="btn btn-default">Submit Button</button>
	</form>
</div>
<?php $this->load->view('includes/footer'); ?>