<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h3>Customers</h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Customer List</h3>
				</div>
				<div class="panel-body info">
<?php $msg = $this->session->flashdata("message");
	  if($msg) { ?>					
					<div class="alert alert-dismissable alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						  <?php echo $msg ?>
						
					</div>	
<?php } ?>					
						<form role="form" method="post" action="<?php echo site_url('customer/list') ?>" id="frm1">
							<table class="table table-bordered table-hover tablesorter">
								<thead>
									<tr>
										<th><input type="checkbox" name="chkall" id="chkall" value="1"> <i class="fa fa-sort"></i></th>
										<th>Type <i class="fa fa-sort"></i></th>
										<th>NPWP Number <i class="fa fa-sort"></i></th>
										<th>Customer Name <i class="fa fa-sort"></i></th>
										<th>Address <i class="fa fa-sort"></i></th>
										<th>City <i class="fa fa-sort"></i></th>
										<th>State <i class="fa fa-sort"></i></th>
										<th>Phone Number <i class="fa fa-sort"></i></th>
										<th>Region <i class="fa fa-sort"></i></th>
										<th>#</th>
									</tr>
								</thead>
								<tbody>
								
<?php 
if($custlist) {
	foreach($custlist as $cust) {
		$t="";		
		if($cust["cust_type"]=="D") {
			$t = "Distributor";
		}
		else if($cust["cust_type"]=="M") {
			$t = "Morden Market";
		}
?> 	
								<tr>
									<td><input type="checkbox" name="chkbox[]" class="chkbox" value="<?php echo $cust["cust_id"] ?>"></td>
									<td><?php echo $t ?></td>
									<td><?php echo $cust["cust_npwp"] ?></td>
									<td><a href="<?php echo site_url('customer/edit/'.$cust["cust_id"]) ?>"><?php echo $cust["cust_fullname"] ?></a></td>
									<td><?php echo $cust["cust_address"] ?></td>
									<td><?php echo $cust["cust_city"] ?></td>
									<td><?php echo $cust["cust_state"] ?></td>
									<td><?php echo $cust["cust_phonenumber"] ?></td>
									<td><?php echo $cust["region_name"] ?></td>
									<td><a href ="#" title="Set price and discount here"><img src="<?php echo site_url('images/static/set_price.png') ?>"></a></td>
								</tr>
<?php 
	}
} 
else { ?>
								<tr>
									<td colspan="9" class="empty">Not Found</td>
								</tr>
<?php 
	}	
?>	
							</tbody>
							</table>
							<div class="col-lg-6">
								<button type="button" class="btn btn-primary" name="cust_addbtnid" value="add" onclick="location.href='<?php echo site_url("customer/add")?>'">Add</button>
								<button type="submit" class="btn btn-primary" name="cust_delbtn" id="delbtn" value="delete">Delete</button>
							</div>
							<div class="col-lg-6 hal">	
								
									<ul class="pagination pagination-sm">
									<?php echo $page_link ?>
									</ul>
								</div>
			
						</form>	
					</div>
				</div>
            </div>
		</div>
	</div>  
</div>
<?php $this->load->view('includes/footer'); ?>