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
					<form role="form" method="post" action="<?php echo site_url('browse/product/'.$op) ?>" id="frm2" name="frm2">
						<div class="form-group">
							<label>Product Name</label>
							<input class="form-control smallInput searchitm" name="itm" value="<?php echo set_value('itm') ?>"> <button type="submit" class="btn btn-primary" name="cust_search" id="searchbtn" value="searchbtn">Search</button>
							<?php echo (form_error("itm",'<p class="help-block">','</p>'))?form_error("itm",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Product Name.</p>'; ?>		
						</div>
					</form>
				</div>
				<div class="panel-body info">
					<div class="alert alert-dismissable alert-info">
						Please choose product which you want. If there aren't exist, You can add new product on Master &raquo; Products   
						
					</div>	
						<form role="form" method="post" action="<?php echo site_url('browse/product'.$op) ?>" id="frm1">
							<table class="table table-bordered table-hover tablesorter">
								<thead>
									<tr>
										<th>Product Name <i class="fa fa-sort"></i></th>
										<th>Category Name <i class="fa fa-sort"></i></th>
										<th>Price <i class="fa fa-sort"></i></th>
									</tr>
								</thead>
								<tbody>
								
<?php 
if($prodlist) {
	foreach($prodlist as $prod) {
		switch($op) {
			case 1:
				$isi=$prod["product_id"]."##".$prod["product_name"]."##".$prod["product_price"];
			break;
			case 2:
				$isi=$prod["product_id"]."##".$prod["product_name"]."##".$prod["product_price"]."##".$prod["unit_id"]."##".$prod["unit_name"];
			break;
			case 3:
				$isi=$prod["product_id"]."##".$prod["product_name"];	
		}
?> 	
								<tr>
									<td>
										<a href="#" class="sendvalue" id="<?php echo $isi ?>"><?php echo $prod["product_name"] ?></a>
									</td>
									<td><?php echo $prod["category_name"] ?></td>
									<td style="text-align:right"><?php echo number_format($prod["product_price"]) ?></td>
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