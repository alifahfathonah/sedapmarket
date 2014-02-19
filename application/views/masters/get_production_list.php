<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h3>Production</h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Production List</h3>
				</div>
				<div class="panel-body info">
					<form role="form" method="post" action="<?php echo site_url('production/list') ?>" id="frm2" name="frm2">
						<div class="form-group">
							<label>Product Name</label>
							<input class="form-control smallInput searchitm" name="itm" value="<?php echo set_value('itm') ?>"> <button type="submit" class="btn btn-primary" name="cust_search" id="searchbtn" value="searchbtn">Search</button>
							<?php echo (form_error("itm",'<p class="help-block">','</p>'))?form_error("itm",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Product Name.</p>'; ?>		
						</div>
					</form>
				</div>
				<div class="panel-body info">
<?php $msg = $this->session->flashdata("message");
	  if($msg) { ?>					
					<div class="alert alert-dismissable alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						  <?php echo $msg ?>
						
					</div>	
<?php } ?>					
						<form role="form" method="post" action="<?php echo site_url('production/list') ?>" id="frm1">
							<table class="table table-bordered table-hover tablesorter">
								<thead>
									<tr>
										<th><input type="checkbox" name="chkall" id="chkall" value="1"> <i class="fa fa-sort"></i></th>
										<th>Product Name <i class="fa fa-sort"></i></th>
										<th>Beginuing Stock <i class="fa fa-sort"></i></th>
										<th>Stock <i class="fa fa-sort"></i></th>
										<th>Ending Stock <i class="fa fa-sort"></i></th>
									</tr>
								</thead>
								<tbody>
								
<?php 
if($productionlist) {
	//echo debug($productionlist);
	foreach($productionlist as $production) {
?> 	
								<tr>
									<td><input type="checkbox" name="chkbox[]" class="chkbox" value="<?php echo $production["price_id"] ?>"></td>
									<td><a href="<?php echo site_url('production/edit/'.$production["production_id"]) ?>"><?php echo $production["product_name"] ?></a></td>
									<td style="text-align:right"><?php echo number_format($production["begin_stock"]) ?></td>
									<td style="text-align:right"><?php echo number_format($production["stock"]) ?></td>
									<td style="text-align:right"><?php echo number_format($production["end_stock"]) ?></td>
								</tr>
<?php 
	}
} 
else { ?>
								<tr>
									<td colspan="5" class="empty">Not Found</td>
								</tr>
<?php 
	}	
?>	
							</tbody>
							</table>
							<div class="col-lg-6">
								<button type="button" class="btn btn-primary" name="price_addbtn" value="add" onclick="location.href='<?php echo site_url("production/add")?>'">Add</button>
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