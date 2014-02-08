<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h3>Special Price</h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Special Price List for <?php echo $cust_name; ?></h3>
				</div>
				<div class="panel-body info">
<?php $msg = $this->session->flashdata("message");
	  if($msg) { ?>					
					<div class="alert alert-dismissable alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						  <?php echo $msg ?>
						
					</div>	
<?php } ?>					
						<form role="form" method="post" action="<?php echo site_url('customer/price/list/'.$cust_id) ?>" id="frm1">
							<table class="table table-bordered table-hover tablesorter">
								<thead>
									<tr>
										<th><input type="checkbox" name="chkall" id="chkall" value="1"> <i class="fa fa-sort"></i></th>
										<th>Product Name <i class="fa fa-sort"></i></th>
										<th>Price <i class="fa fa-sort"></i></th>
										<th>Discount 1 (%) <i class="fa fa-sort"></i></th>
										<th>Discount 2 (%) <i class="fa fa-sort"></i></th>
										<th>Discount 3 (%) <i class="fa fa-sort"></i></th>
									</tr>
								</thead>
								<tbody>
								
<?php 
if($pricelist) {
	//echo debug($pricelist);
	foreach($pricelist as $price) {
?> 	
								<tr>
									<td><input type="checkbox" name="chkbox[]" class="chkbox" value="<?php echo $price["price_id"] ?>"></td>
									<td><a href="<?php echo site_url('customer/price/edit/'.$cust_id.'/'.$price["price_id"]) ?>"><?php echo $price["product_name"] ?></a></td>
									<td style="text-align:right"><?php echo number_format($price["price"]) ?></td>
									<td style="text-align:right"><?php echo $price["disc1"] ?></td>
									<td style="text-align:right"><?php echo $price["disc2"] ?></td>
									<td style="text-align:right"><?php echo $price["disc3"] ?></td>
								</tr>
<?php 
	}
} 
else { ?>
								<tr>
									<td colspan="6" class="empty">Not Found</td>
								</tr>
<?php 
	}	
?>	
							</tbody>
							</table>
							<div class="col-lg-6">
								<button type="button" class="btn btn-primary" name="price_addbtn" value="add" onclick="location.href='<?php echo site_url("customer/price/add/".$price["cust_id"])?>'">Add</button>
								<button type="submit" class="btn btn-primary" name="price_delbtn" id="delbtn" value="delete">Delete</button>
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