<?php $this->load->view('includes/header_pop'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h3>Customer</h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Customer List</h3>
				</div>
				<div class="panel-body info">
					<div class="alert alert-dismissable alert-info">
						Please choose customer which you want. If there aren't exist, You can add new customer on Master &raquo; Customers   
						
					</div>	
						<form role="form" method="post" action="" id="frm1">
							<table class="table table-bordered table-hover tablesorter">
								<thead>
									<tr>
										<th>Full Name <i class="fa fa-sort"></i></th>
										<th>Type <i class="fa fa-sort"></i></th>
										<th>Phone Number <i class="fa fa-sort"></i></th>
									</tr>
								</thead>
								<tbody>
								
<?php 
if($custlist) {
	foreach($custlist as $cust) {
		$isi=$cust["cust_id"]."##".$cust["cust_fullname"];
?> 	
								<tr>
									<td>
										<a href="#" class="sendvalue" id="<?php echo $isi ?>"><?php echo $cust["cust_fullname"] ?></a>
									</td>
									<td><?php echo ($cust["cust_type"]=="M")?"Modern Market":"Distributor" ?></td>
									<td style="text-align:left"><?php echo $cust["cust_phonenumber"] ?></td>
								</tr>
<?php 
	}
} 
else { ?>
								<tr>
									<td colspan="3" class="empty">Not Found</td>
								</tr>
<?php 
	}	
?>	
							</tbody>
							</table>
							<div class="col-lg-6">
								<!-- <button type="button" class="btn btn-primary" name="closebtn" value="add" onclick="window.close()">Close</button> -->
								&nbsp;
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
<?php $this->load->view('includes/footer_pop'); ?>