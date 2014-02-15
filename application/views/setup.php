<?php $this->load->view('includes/header'); ?>
<div id="page-wrapper">	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Settings</h3>
				</div>
				<div class="panel-body info">
<?php $sess = $this->session->userdata("security");
	  $msg = $this->session->flashdata('message');
	  $err = $this->session->flashdata('error');
      if(!$msg) { 
		if($err) { ?>		
					<div class="alert alert-dismissable alert-success">
						  <?php echo $err ?>
					</div>
<?php   } ?>					
					<form role="form" method="post" action="<?php echo site_url('setup') ?>" enctype="multipart/form-data">
<?php 	if($setuplist) {
			$j=0;
			foreach($setuplist as $setup) {
				switch($setup["option_name"]) {
					case "SITETITLE":
					case "SITEDESC":
					case "PAGEITEM":?>	
						<div class="form-group">
							<label>
								<input type="hidden" name="option_name[<?php echo $j ?>]" value="<?php echo $setup["option_name"]?>">
								<?php echo $setup["option_title"]?>
							</label>
							<input class="form-control" name="option_value[<?php echo $j ?>]" type="text"  value="<?php echo $setup["option_value"] ?>">
							<?php echo (form_error("option_value[".$j."]",'<p class="help-block">','</p>'))?form_error("option_value[".$j."]",'<p class="help-block errors">','</p>'):'<p class="help-block">'.$setup["option_desc"].'</p>'; ?>
						</div>
<?php 				break;
					case "FAVICON": 
						if($setup["option_name"]=="FAVICON") { 
							if($setup["option_value"]) { 
								$v=$setup["option_value"];
								$gbr="images/".$setup["option_value"];
							} else { 
								$v="";
								$gbr="images/static/noimage.png";
							}
						}	  					
?>
						<div class="form-group">
							<label>
								<input type="hidden" name="option_name[<?php echo $j ?>]" value="<?php echo $setup["option_name"]?>">
								<?php echo $setup["option_title"]?>
								<br><img src="<?php echo site_url($gbr) ?>">
							</label>
							<input name="backfile1" type="hidden"  value="<?php echo $setup["option_value"]?>">
							<input name="filegmb2" type="file"  value="">
							<?php echo (form_error("filegmb2",'<p class="help-block">','</p>'))?form_error("filegmb2",'<p class="help-block errors">','</p>'):'<p class="help-block">'.$setup["option_desc"].'</p>'; ?>
						</div>
<?php				break;	
					case "FORMATDATE": ?>
						<div class="form-group">
							<label>
								<input type="hidden" name="option_name[<?php echo $j ?>]" value="<?php echo $setup["option_name"]?>">
								<?php echo $setup["option_title"]?>
							</label>
							<select class="form-control" name="option_value[<?php echo $j ?>]">
							  <option value="M d, Y H:i:s" <?php echo ($setup["option_value"]=="M d, Y H:i:s")?"selected='seklected'":"" ?> ><?php echo date("M d, Y H:i:s") ?></option>
								<option value="Y-m-d H:i:s" <?php echo ($setup["option_value"]=="Y-m-d H:i:s")?"selected='seklected'":"" ?>><?php echo date("Y-m-d H:i:s") ?></option>
							</select>
							<?php echo (form_error("option_value[".$j."]",'<p class="help-block">','</p>'))?form_error("option_value[".$j."]",'<p class="help-block errors">','</p>'):'<p class="help-block">'.$setup["option_desc"].'</p>'; ?>
						</div>
<?php				break;	
				}
				$j++;
			}
		} ?>			
						<button type="submit" class="btn btn-primary" value="Update" name="editbtn">Update</button>			
					</form>
<?php } else { ?>
					<div class="alert alert-dismissable alert-success">
						  <?php echo $msg ?>
						  <script>
							window.setTimeout('location.href="<?php echo site_url('setup') ?>"',3000);
						  </script>
					</div>
<?php } ?>					
				</div>
			</div>	
		</div>
	</div>		
</div>
<?php $this->load->view('includes/footer'); ?>