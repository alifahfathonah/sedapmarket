<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h3>Transcation</h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Transcation List</h3>
				</div>
				<div class="panel-body info">
					<form role="form" method="post" action="<?php echo site_url('po/list') ?>" id="frm2" name="frm2">
						<div class="form-group">
							<label>Delivery Number</label>
							<input class="form-control smallInput searchitm" name="itm" value="<?php echo set_value('itm') ?>"> <button type="submit" class="btn btn-primary" name="cust_search" id="searchbtn" value="searchbtn">Search</button>
							<?php echo (form_error("itm",'<p class="help-block">','</p>'))?form_error("itm",'<p class="help-block errors">','</p>'):'<p class="help-block">Enter Delivery Order Number.</p>'; ?>		
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
						<form role="form" method="post" action="<?php echo site_url('transcation/list') ?>" id="frm1">
							<table class="table table-bordered table-hover tablesorter">
								<thead>
									<tr>
										<th><input type="checkbox" name="chkall" id="chkall" value="1"> <i class="fa fa-sort"></i></th>
										<th>Transcation Date <i class="fa fa-sort"></i></th>
										<th>Delivery Order Number <i class="fa fa-sort"></i></th>
										<th>Car Number <i class="fa fa-sort"></i></th>
										<th>Container Number <i class="fa fa-sort"></i></th>
										<th>Seal Number <i class="fa fa-sort"></i></th>
										<th>#</th>
									</tr>
								</thead>
								<tbody>
								
<?php 
if($translist) {
	foreach($translist as $trans) {
		if($trans["trans_date"] && $trans["trans_date"]!="0000-00-00") {
			$tmp = new DateTime($trans["trans_date"]);
			$trans["trans_date"] = $tmp->format($formatdate);
		}
		else {
			$trans["trans_date"] = "";
		}

		//$n = $this->PoModel->get_podetail_count($po["po_id"])											
?> 	
								<tr>
									<td><input type="checkbox" name="chkbox[]" class="chkbox" value="<?php echo $trans["transcation_id"] ?>"></td>
									<td><?php echo $trans["trans_date"] ?></td>
									<td><a href="<?php echo site_url('transcation/edit/'.$trans["transcation_id"]) ?>"><?php echo $trans["no_sj"] ?></a></td>
									<td><?php echo $trans["no_mobil"] ?></td>
									<td><?php echo $trans["no_container"] ?></td>
									<td><?php echo $trans["no_seal"] ?></td>
									<td><a href="<?php echo site_url('transcation/detail/list/'.$trans["transcation_id"]) ?>"><img src="<?php echo site_url("images/static/po.png") ?>" /></a><sub><?php echo $n ?></sub></td>
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
								<button type="button" class="btn btn-primary" name="trans_addbtn" value="add" onclick="location.href='<?php echo site_url("transcation/add")?>'">Add</button>
								<button type="submit" class="btn btn-primary" name="trans_delbtn" id="delbtn" value="delete">Delete</button>
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