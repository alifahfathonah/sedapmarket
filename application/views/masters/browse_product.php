<?php $this->load->view('includes/header_pop'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h3>Products</h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Product List</h3>
				</div>
				<div class="panel-body info">
					<div class="alert alert-dismissable alert-info">
						Please choose product which you want. If there aren't exist, You can add new product on Master &raquol;   
						
					</div>	
						<form role="form" method="post" action="<?php echo site_url('products/list') ?>" id="frm1">
							<table class="table table-bordered table-hover tablesorter">
								<thead>
									<tr>
										<th>&nbsp;</th>
										<th>Product Name <i class="fa fa-sort"></i></th>
										<th>Category Name <i class="fa fa-sort"></i></th>
									</tr>
								</thead>
								<tbody>
								
<?php 
if($prodlist) {
	foreach($prodlist as $prod) {
?> 	
								<tr>
									<td>&nbsp;</td>
									<td>
										<a href="#" class="sendvalue" id="<?php echo $prod["product_id"] ?>##<?php echo $prod["product_name"] ?>"><?php echo $prod["product_name"] ?></a>
									</td>
									<td><?php echo $prod["category_name"] ?></td>
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