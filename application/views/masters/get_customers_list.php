<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h1>Customers</h1>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Customer List</h3>
				</div>
				<div class="panel-body info">
					<div class="table-responsive">
						<table class="table table-bordered table-hover tablesorter">
							<thead>
								<tr>
									<th><input type="checkbox" name="chkall" value="1"> <i class="fa fa-sort"></i></th>
									<th>Customer Name <i class="fa fa-sort"></i></th>
									<th>Address <i class="fa fa-sort"></i></th>
									<th>City <i class="fa fa-sort"></i></th>
									<th>State <i class="fa fa-sort"></i></th>
									<th>Phone Number <i class="fa fa-sort"></i></th>
									<th>E-mail Address <i class="fa fa-sort"></i></th>
								</tr>
							</thead>
							<tbody>
								
<?php 
if($custlist) {
	foreach($custlist as $cust) {
?> 	
								<tr>
									<td><input type="checkbox" name="chkbox[]" class="chkbox" value=""></td>
									<td>/blog/post.html</td>
									<td>1233</td>
									<td>93.2%</td>
									<td>$126.34</td>
									<td>$126.34</td>
									<td>$126.34</td>
								</tr>
<?php 
	}
} 
else { ?>
								<tr>
									<td colspan="7" class="empty">Not Found</td>
								</tr>
<?php 
	}	
?>	
							</tbody>
						</table>
						<button type="submit" class="btn btn-primary" name="cust_delbtn" value="delete">Delete</button>
					</div>
				</div>
            </div>
		</div>
	</div>  
</div>
<?php $this->load->view('includes/footer'); ?>