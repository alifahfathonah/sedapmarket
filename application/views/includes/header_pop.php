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
					console.log(tmp);
					parent.frm1.product_id.value="1";
					parent.frm1.product_name.value="2";
					return false;
				});
			});
		</script>
	</head>
	<body>	