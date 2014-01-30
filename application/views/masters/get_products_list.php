<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h3>Products</h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Product List</h3>
				</div>
				<div class="panel-body info">
<?php $msg = $this->session->flashdata("message");
	  if($msg) { ?>					
					<div class="alert alert-dismissable alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						  <?php echo $msg ?>
						
					</div>	
<?php } ?>					
						<form role="form" method="post" action="<?php echo site_url('products/list') ?>" id="frm1">
							<table class="table table-bordered table-hover tablesorter">
								<thead>
									<tr>
										<th><input type="checkbox" name="chkall" id="chkall" value="1"> <i class="fa fa-sort"></i></th>
										<th>Category Name <i class="fa fa-sort"></i></th>
										<th>Product Name <i class="fa fa-sort"></i></th>
										<th>Kemasan <i class="fa fa-sort"></i></th>
										<th colspan="2">Stock <i class="fa fa-sort"></i></th>
										<th>Harga <i class="fa fa-sort"></i></th>
									</tr>
								</thead>
								<tbody>
								
<?php 
if($prodlist) {
	foreach($prodlist as $prod) {
?> 	
								<tr>
									<td><input type="checkbox" name="chkbox[]" class="chkbox" value="<?php echo $prod["product_id"] ?>"></td>
									<td><?php echo $prod["category_name"] ?></td>
									<td><a href="<?php echo site_url('products/edit/'.$prod["product_id"]) ?>"><?php echo $prod["product_name"] ?></a></td>
									<td><?php echo $prod["product_kemasan"] ?></td>
									<td style="text-align:right"><?php echo number_format($prod["product_stock"]) ?></td>
									<td style="text-align:left"><?php echo $prod["unit_name"] ?></td>
									<td style="text-align:right"><?php echo number_format($prod["product_price"]) ?></td>
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
								<button type="button" class="btn btn-primary" name="product_addbtn" value="add" onclick="location.href='<?php echo site_url("products/add")?>'">Add</button>
								<button type="submit" class="btn btn-primary" name="product_delbtn" id="delbtn" value="delete">Delete</button>
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