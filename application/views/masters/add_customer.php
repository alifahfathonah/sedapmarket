<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h1>Customers</h1>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Add Customer</h3>
				</div>
				<div class="panel-body info">
					<form role="form" method="post" action="<?php echo site_url('customer/list') ?>">
						<div class="form-group">
							<label>Register Date</label>
							<input class="form-control datef" name="cust_regdate" readonly="readonly" value="<?php echo date($formatdate) ?>">
							<p class="help-block">This date is Current Date. You can change register date.</p>
						</div>
						<div class="form-group">
							<label>Full Name</label>
							<input class="form-control" name="cust_fullname" value="<?php echo set_value("cust_fullname")?>">
							<p class="help-block">Enter your customer full name.</p>
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea class="form-control" rows="3" name="cust_address"><?php echo set_value("cust_address")?></textarea>
							<p class="help-block">Enter your customer address.</p>
						</div>
						<div class="form-group">
							<label>Phone Number</label>
							<textarea class="form-control" rows="3" name="cust_phonenumber"><?php echo set_value("cust_phonenumber")?></textarea>
							<p class="help-block">Enter your customer phone number.</p>
						</div>
						<div class="form-group">
							<label>Fax Number</label>
							<textarea class="form-control" rows="3" name="cust_phonenumber"><?php echo set_value("cust_faxnumber")?></textarea>
							<p class="help-block">Enter your customer Fax number.</p>
						</div>
						<div class="form-group">
							<label>Mobile Number</label>
							<textarea class="form-control" rows="3" name="cust_mobilenumber"><?php echo set_value("cust_mobilenumber")?></textarea>
							<p class="help-block">Enter your customer Mobile number.</p>
						</div>
						<div class="form-group">
							<label>E-Mail Address</label>
							<input class="form-control" name="cust_emailaddress" value="<?php echo set_value("cust_emailaddress")?>">
							<p class="help-block">Enter your customer E-Mail Address.</p>
						</div>
						
						<button type="submit" class="btn btn-primary" name="addbtn" value="add">Add</button>
					</form>
				</div>
            </div>
		</div>
	</div>  
</div>
<?php $this->load->view('includes/footer'); ?>