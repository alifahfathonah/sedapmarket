<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<h3>Products</h3>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Product Category List</h3>
				</div>
				<div class="panel-body info">
<?php $msg = $this->session->flashdata("message");
	  if($msg) { ?>					
					<div class="alert alert-dismissable alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						  <?php echo $msg ?>
						
					</div>	
<?php } ?>					
						<form role="form" method="post" action="<?php echo site_url('category/list') ?>" id="frm1">
							<table class="table table-bordered table-hover tablesorter">
								<thead>
									<tr>
										<th><input type="checkbox" name="chkall" id="chkall" value="1"> <i class="fa fa-sort"></i></th>
										<th>Category Name <i class="fa fa-sort"></i></th>
										<th>Description <i class="fa fa-sort"></i></th>
									</tr>
								</thead>
								<tbody>
								
<?php 
if($catlist) {
	foreach($catlist as $cat) {
?> 	
								<tr>
									<td><input type="checkbox" name="chkbox[]" class="chkbox" value="<?php echo $cat["category_id"] ?>"></td>
									<td><a href="<?php echo site_url('category/edit/'.$cat["category_id"]) ?>"><?php echo $cat["category_name"] ?></a></td>
									<td><?php echo $cat["category_desc"] ?></td>
									
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
								<button type="button" class="btn btn-primary" name="category_addbtnid" value="add" onclick="location.href='<?php echo site_url("category/add")?>'">Add</button>
								<button type="submit" class="btn btn-primary" name="category_delbtn" id="category_delbtn" value="delete">Delete</button>
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