<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h3>Purchase Order <?php echo $po_no ?></h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> PO Detail List</h3>
				</div>
				<div class="panel-body info">
					<form role="form" method="post" action="<?php echo site_url('po/detail/list/'.$po_id) ?>" id="frm2" name="frm2">
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
						<form role="form" method="post" action="<?php echo site_url('po/detail/list/'.$po_id) ?>" id="frm1">
							<table class="table table-bordered table-hover tablesorter">
								<thead>
									<tr>
										<th><input type="checkbox" name="chkall" id="chkall" value="1"> <i class="fa fa-sort"></i></th>
										<th>Product Name <i class="fa fa-sort"></i></th>
										<th>Quantity <i class="fa fa-sort"></i></th>
										<th>Price <i class="fa fa-sort"></i></th>
										<th>Subtotal <i class="fa fa-sort"></i></th>
									</tr>
								</thead>
								<tbody>
								
<?php 
if($podetaillist) {
	$tot=0;
	foreach($podetaillist as $podetail) {
		$tot+=$podetail["subtotal"];			
?> 	
									<tr>
										<td><input type="checkbox" name="chkbox[]" class="chkbox" value="<?php echo $podetail["detail_id"] ?>"></td>
										<td><a href="<?php echo site_url("po/detail/edit/".$podetail["po_id"]."/".$podetail["detail_id"]) ?>"><?php echo $podetail["product_name"] ?></a></td>
										<td class="text-right"><?php echo number_format($podetail["qty"]) ?></td>
										<td class="text-right"><?php echo number_format($podetail["price"]) ?></td>
										<td class="text-right"><?php echo number_format($podetail["subtotal"]) ?></td>
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
								<tfoot>
									<tr>
										<td colspan="3">&nbsp;</td>
										<td>Total</td>
										<td class="text-right"><?php echo number_format($tot) ?></td>
									</tr>
								</tfoot>
							</table>
							<div class="col-lg-6">
								<button type="button" class="btn btn-primary" name="po_addbtn" value="add" onclick="location.href='<?php echo site_url("po/detail/add/".$po_id)?>'">Add</button>
								<button type="submit" class="btn btn-primary" name="po_delbtn" id="delbtn" value="delete">Delete</button>
								<button type="button" class="btn btn-primary" name="po_backbtn" value="Back" onclick="location.href='<?php echo site_url("po/list") ?>'">Back</button>
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