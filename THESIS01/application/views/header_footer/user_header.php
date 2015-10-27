<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-Compatible-UA" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

   <title>  Hospicio De San Jose </title>
	<link rel="icon" href="<?php echo base_url(); ?>/bootstrap/img/H logo.png" type="image/png"> 

	<!-- Bootstrap Core CSS -->
	<link href="<?php echo base_url(); ?>/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="<?php echo base_url(); ?>/bootstrap/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

	<!-- Timeline CSS -->
	<link href="<?php echo base_url(); ?>/bootstrap/css/plugins/timeline.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="<?php echo base_url(); ?>/bootstrap/css/sb-admin-2.css" rel="stylesheet">

	<!-- Morris Charts CSS -->
	<link href="<?php echo base_url(); ?>/bootstrap/css/plugins/morris.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="<?php echo base_url(); ?>/bootstrap/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<link href="<?php echo base_url(); ?>/bootstrap/css/datepicker.css" rel="stylesheet">
	
	<!--DataTable CSS -->
	<link href="<?php echo base_url(); ?>/bootstrap/css/plugins/dataTables.css" rel="stylesheet" type="text/css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
<style>
#nurse a {
	text-decoration: none;
	color: white;
}


</style>
</head>

<body>
	<div>

	<div id="wrapper">
		<div id="logo">
		</div>
		<!-- Navigation -->
		<nav class="navbar navbar-default" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">

				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			   
			</div>
			<!-- /.navbar-header -->
			<ul class="nav navbar-top-links navbar-right" >
				<li class="dropdown" id="mesnot">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-envelope fa-fw"></i><span class="badge">0</span>  <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-messages">
					<!-- can be put in a loop -->
						<li>
							<a href="#">
								<div>
									<strong>John Smith</strong>
									<span class="pull-right text-muted">
										<em>Yesterday</em>
									</span>
								</div>
								<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
							</a>
						</li>
					<!-- end for loop -->

						<li class="divider"></li>
						<li>
							<a class="text-center" href="nurse_messaging">
								<strong>Show All Messages</strong>
								<i class="fa fa-angle-right"></i>
							</a>
						</li>
					</ul>
					<!-- /.dropdown-messages -->
				</li>
				<!-- /.dropdown -->
				
				
				<li class="dropdown" id="mesnot">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-bell fa-fw"></i> <span class="badge">0</span> <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-alerts">
						<li>
							<a href="#">
								<div>
									<i class="fa fa-comment fa-fw"></i> New Comment
									<span class="pull-right text-muted small">4 minutes ago</span>
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="#">
								<div>
									<i class="fa fa-twitter fa-fw"></i> 3 New Followers
									<span class="pull-right text-muted small">12 minutes ago</span>
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="#">
								<div>
									<i class="fa fa-envelope fa-fw"></i> Message Sent
									<span class="pull-right text-muted small">4 minutes ago</span>
								</div>
							</a>
						</li>
						<li class="divider"></li>
						
					
						<li>
							<a class="text-center" href="#">
								<strong>See All Notification</strong>
								<i class="fa fa-angle-right"></i>
							</a>
						</li>
					</ul>
					<!-- /.dropdown-alerts -->
				</li>
				<!-- /.dropdown -->

				<li class="dropdown" id="usersize">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo $username ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
			</ul>
