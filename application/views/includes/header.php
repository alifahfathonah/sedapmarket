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

		<!-- Add custom CSS here -->
		<link href="<?php echo site_url("css/sb-admin.css") ?>" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo site_url("css/css/font-awesome.min.css") ?>">
		<!-- Page Specific CSS -->
		<link rel="stylesheet" href="<?php echo site_url("css/morris-0.4.3.min.css") ?>" >
		<link rel="stylesheet" href="<?php echo site_url("css/style.css") ?>" >
		
		<!-- JavaScript -->
		<script src="<?php echo site_url("js/jquery-1.10.2.js") ?>"></script>
		<script src="<?php echo site_url("js/bootstrap.js") ?>"></script>

		<!-- Page Specific Plugins -->
		<script src="<?php echo site_url("js/raphael-min.js") ?>"></script>
		<script src="<?php echo site_url("js/morris-0.4.3.min.js") ?>"></script>
		<script src="<?php echo site_url("js/morris/chart-data-morris.js") ?>"></script>
		<script src="<?php echo site_url("js/tablesorter/jquery.tablesorter.js") ?>"></script>
		<script src="<?php echo site_url("js/tablesorter/tables.js") ?>"></script>
		
		<!-- DatePicker Plugins -->
<?php   
		if($this->uri->segment(1)=="customer") {
		switch($this->uri->segment(2)) {
			case "add":
			case "edit": ?>
		<link rel="stylesheet" href="<?php echo site_url("js/datepicker/jquery.datepick.css") ?>" type="text/css" />	
		<script src="<?php echo site_url("js/datepicker/jquery.datepick.js") ?>"></script>
<?php 	}
	  }
?>
		<script type="text/javascript">
			$(function() {
<?php if($this->uri->segment(1)=="customer") {
		switch($this->uri->segment(2)) {
			case "add":
			case "edit": ?>
				$(".datef").datepick({
					dateFormat:'<?php echo ($formatdate=='M d, Y')?"M dd, yyyy":"yyyy-mm-dd" ?>'
				});
			
<?php 		break;
			case "list": ?>
				$('#chkall').click(function () {    
					 $('.chkbox').prop('checked', this.checked);    
				});
				
				$("#cust_delbtn").click(function() {
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
<?php		break;	
		}
	  }
?>		
			});
		</script>
	</head>

	<body>
<?php $sess = $this->session->userdata("security");
	  if($this->uri->segment(1)=="login") { ?>
		<div id="wrapper-login">
<?php } 
	  else { ?>	
		<div id="wrapper">

			<!-- Sidebar -->
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo site_url('home') ?>"><?php echo $sitetitle ?></a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav side-nav">
						<li <?php echo ($this->uri->segment(1)=="home")?'class="active"':'' ?>><a href="<?php echo site_url('home') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
						<li class="dropdown <?php echo ($this->uri->segment(1)=="customer")?"active":"" ?>" >
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Master Data <b class="caret"></b></a>
						  <ul class="dropdown-menu">
							<li><a href="<?php echo site_url('customer/list') ?>">Customer</a></li>
							<li><a href="<?php echo site_url('category/list') ?>">Category</a></li>
							<li><a href="#">Product</a></li>
						  </ul>
						</li>
						<!--<li><a href="charts.html"><i class="fa fa-bar-chart-o"></i> Charts</a></li>
						<li><a href="tables.html"><i class="fa fa-table"></i> Tables</a></li>
						<li><a href="forms.html"><i class="fa fa-edit"></i> Forms</a></li>
						<li><a href="typography.html"><i class="fa fa-font"></i> Typography</a></li>
						<li><a href="bootstrap-elements.html"><i class="fa fa-desktop"></i> Bootstrap Elements</a></li>
						<li><a href="bootstrap-grid.html"><i class="fa fa-wrench"></i> Bootstrap Grid</a></li>
						<li><a href="blank-page.html"><i class="fa fa-file"></i> Blank Page</a></li>
						<li class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Dropdown <b class="caret"></b></a>
						  <ul class="dropdown-menu">
							<li><a href="#">Dropdown Item</a></li>
							<li><a href="#">Another Item</a></li>
							<li><a href="#">Third Item</a></li>
							<li><a href="#">Last Item</a></li>
						  </ul>
						</li>-->
					</ul>

					<ul class="nav navbar-nav navbar-right navbar-user">
						<li class="dropdown messages-dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge">7</span> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li class="dropdown-header">7 New Messages</li>
								<li class="message-preview">
									<a href="#">
										<span class="avatar"><img src="http://placehold.it/50x50"></span>
										<span class="name">John Smith:</span>
										<span class="message">Hey there, I wanted to ask you something...</span>
										<span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
									</a>
								</li>
								<li class="divider"></li>
								<li class="message-preview">
									<a href="#">
										<span class="avatar"><img src="http://placehold.it/50x50"></span>
										<span class="name">John Smith:</span>
										<span class="message">Hey there, I wanted to ask you something...</span>
										<span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
									</a>
								</li>
								<li class="divider"></li>
								<li class="message-preview">
									<a href="#">
										<span class="avatar"><img src="http://placehold.it/50x50"></span>
										<span class="name">John Smith:</span>
										<span class="message">Hey there, I wanted to ask you something...</span>
										<span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
									</a>
								</li>
								<li class="divider"></li>
								<li><a href="#">View Inbox <span class="badge">7</span></a></li>
							</ul>
						</li>
						<li class="dropdown alerts-dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Default <span class="label label-default">Default</span></a></li>
								<li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>
								<li><a href="#">Success <span class="label label-success">Success</span></a></li>
								<li><a href="#">Info <span class="label label-info">Info</span></a></li>
								<li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>
								<li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>
								<li class="divider"></li>
								<li><a href="#">View All</a></li>
							</ul>
						</li>
						<li class="dropdown user-dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $sess['uname'] ?> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo site_url('profile/edit') ?>"><i class="fa fa-user"></i> Profile</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
								<li><a href="<?php echo site_url('setup') ?>"><i class="fa fa-gear"></i> Settings</a></li>
								<li class="divider"></li>
								<li><a href="<?php echo site_url('logout') ?>"><i class="fa fa-power-off"></i> Log Out</a></li>
							</ul>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</nav>
<?php } ?>			