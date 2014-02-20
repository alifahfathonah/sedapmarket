<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title><?php echo $sitetitle ?></title>

		<!-- Bootstrap core CSS -->
		<link href="<?php echo site_url("css/bootstrap.css") ?>" rel="stylesheet">
		<link href="<?php echo site_url("css/style-pop.css") ?>" rel="stylesheet">
		
		<!-- JavaScript -->
		<script src="<?php echo site_url("js/jquery-1.10.2.js") ?>"></script>
		<script src="<?php echo site_url("js/bootstrap.js") ?>"></script>
		
		<script type="text/javascript">
			$(function() { 
				$(".sendvalue").click(function() { 
					var tmp = $(this).attr('id');
					t = tmp.split("##");
<?php switch($this->uri->segment(2)) { 
		case "product":
?>
					parent.frm1.product_id.value=t[0];
					parent.frm1.product_name.value=t[1];
<?php 		if($op==1) { ?>					
					parent.frm1.price.value=t[2];
<?php 		} 
			else if($op==2) { ?>
					parent.frm1.price.value=t[2];
					parent.frm1.unit_id.value=t[3];
					parent.frm1.unit_name.value=t[4];
<?php		}
		break;
		case "customers": ?>
					parent.frm1.cust_id.value=t[0];
					parent.frm1.cust_fullname.value=t[1];	
<?php	break;
		case "ship": ?>
					parent.frm1.ship_id.value=t[0];
					parent.frm1.ship_name.value=t[1];	
<?php	break;
	 }	
?>					
					parent.$.colorbox.close();
					return false;
				});
				
				$("#delbtn").click(function() {
					var tmp = $(".chkbox:checked");
					console.log(tmp);
					if(tmp.length > 0) {
						if(confirm("Are you sure to delete?")) {
							$("#frm1").submit();
							return true;
						}
						return false;
					}
					else {
						alert("Please choose item that you will delete")
						return false;
					}					
				});
			});
		</script>
	</head>
	<body>	