<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h3>Purchase Order</h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> PO List</h3>
				</div>
				<div class="panel-body info">
					<form role="form" method="post" action="<?php echo site_url('po/list') ?>" id="frm2" name="frm2">
						<div class="form-group">
							<label>PO Number</label>
							<input class="form-control smallInput searchitm" name="itm" value="<?php echo set_value('itm') ?>"> <button type="submit" class="btn btn-primary" name="cust_search" id="searchbtn" value="searchbtn">Search</button>
							<?php echo (form_error("itm",'<p class="help-block">','</p>'))?form_error("itm",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter PO Number.</p>'; ?>		
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
						<form role="form" method="post" action="<?php echo site_url('po/list') ?>" id="frm1">
							<table class="table table-bordered table-hover tablesorter">
								<thead>
									<tr>
										<th><input type="checkbox" name="chkall" id="chkall" value="1"> <i class="fa fa-sort"></i></th>
										<th>PO Date <i class="fa fa-sort"></i></th>
										<th>PO Number <i class="fa fa-sort"></i></th>
										<th>Customer <i class="fa fa-sort"></i></th>
										<th>Shipping <i class="fa fa-sort"></i></th>
										<th>#</th>
									</tr>
								</thead>
								<tbody>
								
<?php 
if($polist) {
	foreach($polist as $po) {
		if($po["po_date"] && $po["po_date"]!="0000-00-00") {
			$tmp = new DateTime($po["po_date"]);
			$po["po_date"] = $tmp->format($formatdate);
		}
		else {
			$po["po_date"] = "";
		}

		$n = $this->PoModel->get_podetail_count($po["po_id"])											
?> 	
								<tr>
									<td><input type="checkbox" name="chkbox[]" class="chkbox" value="<?php echo $po["po_id"] ?>"></td>
									<td><?php echo $po["po_date"] ?></td>
									<td><a href="<?php echo site_url('po/edit/'.$po["po_id"]) ?>"><?php echo $po["po_no"] ?></a></td>
									<td><?php echo $po["cust_fullname"] ?></td>
									<td><?php echo $po["ship_name"] ?></td>
									<td><a href="<?php echo site_url('po/detail/list/'.$po["po_id"]) ?>"><img src="<?php echo site_url("images/static/po.png") ?>" /></a><sub><?php echo $n ?></sub></td>
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
								<button type="button" class="btn btn-primary" name="po_addbtn" value="add" onclick="location.href='<?php echo site_url("po/add")?>'">Add</button>
								<button type="submit" class="btn btn-primary" name="po_delbtn" id="delbtn" value="delete">Delete</button>
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