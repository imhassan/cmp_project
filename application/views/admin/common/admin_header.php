<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?=$setting['site_name']?></title>
<meta
	content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
	name='viewport'>
<link rel="shortcut icon"
	href="<?= base_url() ?>assets/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?= base_url() ?>assets/images/favicon.ico"
	type="image/x-icon">
<!-- Bootstrap 3.3.4 -->
<link href="<?= base_url() ?>assets/admin/bootstrap/css/bootstrap.css"
	rel="stylesheet" type="text/css" />
<!-- Font Awesome Icons -->
<link
	href="<?= base_url() ?>assets/admin/plugins/font-awesome-4.7.0/css/font-awesome.min.css"
	rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<!-- <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" /> -->
<!-- DATA TABLES -->
<link
	href="<?= base_url() ?>assets/admin/plugins/datatables/dataTables.bootstrap.css"
	rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="<?= base_url() ?>assets/admin/dist/css/AdminLTE.min.css"
	rel="stylesheet" type="text/css" />
<!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
<link
	href="<?= base_url() ?>assets/admin/dist/css/skins/_all-skins.min.css"
	rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/admin/dist/css/custom.css"
	rel="stylesheet" type="text/css" />

<link rel="stylesheet"
	href="<?= base_url() ?>assets/admin/plugins/select2/select2.min.css">
<link rel="stylesheet"
	href="<?= base_url() ?>assets/admin/plugins/iCheck/all.css">

<!-- jQuery 2.1.4 -->
<script
	src="<?= base_url() ?>assets/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script
	src="<?= base_url() ?>assets/admin/bootstrap/js/bootstrap.min.js"
	type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script
	src="<?= base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"
	type="text/javascript"></script>
<script
	src="<?= base_url() ?>assets/admin/plugins/datatables/dataTables.bootstrap.min.js"
	type="text/javascript"></script>
<script
	src="<?= base_url() ?>assets/admin/plugins/validate/jquery.validate.min.js"></script>
<!-- SlimScroll -->
<script
	src="<?= base_url() ?>assets/admin/plugins/slimScroll/jquery.slimscroll.min.js"
	type="text/javascript"></script>
<!-- FastClick -->
<script
	src='<?= base_url() ?>assets/admin/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/admin/dist/js/app.min.js"
	type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>assets/admin/dist/js/demo.js"
	type="text/javascript"></script>

<script
	src="<?= base_url() ?>assets/admin/plugins/select2/select2.full.min.js"></script>
<script src='<?= base_url() ?>assets/admin/plugins/iCheck/icheck.min.js'></script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="skin-green layout-top-nav">
	<div class="wrapper">

		<header class="main-header">
			<nav class="navbar navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<a href="<?= base_url() ?>admin" class="navbar-brand"><b><?php echo $setting['site_name']; ?></a>
						<button type="button" class="navbar-toggle collapsed"
							data-toggle="collapse" data-target="#navbar-collapse">
							<i class="fa fa-bars"></i>
						</button>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse pull-left"
						id="navbar-collapse">
						<ul class="nav navbar-nav">
							<li class="dropdown"><a href="#" class="dropdown-toggle"
								data-toggle="dropdown">All Users <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="<?= base_url() ?>admin/user/listing">Users Listing</a></li>
									<li><a href="<?= base_url() ?>admin/user/add">Add New User</a></li>

								</ul></li>

							<li class="dropdown"><a href="#" class="dropdown-toggle"
								data-toggle="dropdown">Questions <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="<?= base_url() ?>admin/questions">All Questions</a></li>
									<li><a href="<?= base_url() ?>admin/questions/add">Add New Question</a></li>
								</ul></li>
								
								
							<li><a href="<?= base_url() ?>admin/settings">Settings</a></li>
					
					</div>
					<!-- /.navbar-collapse -->
					<!-- Navbar Right Menu -->
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<!-- User Account Menu -->
							<li class="dropdown user user-menu">
								<!-- Menu Toggle Button --> <a href="#" class="dropdown-toggle"
								data-toggle="dropdown"> <!-- The user image in the navbar--> <img
									src="<?= base_url() ?>assets/admin/dist/img/user2-160x160.jpg"
									class="user-image" alt="User Image" /> <!-- hidden-xs hides the username on small devices so only the image appears. -->
									<span class="hidden-xs"><?=get_loggedin_person_name()?></span>
							</a>
								<ul class="dropdown-menu">
									<!-- The user image in the menu -->

									<!-- Menu Body -->

									<!-- Menu Footer-->
									<li class="user-footer">

										<div class="pull-right">
											<a href="<?= base_url() ?>admin/user/logout"
												class="btn btn-default btn-flat">Sign out</a>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>
					<!-- /.navbar-custom-menu -->
				</div>
				<!-- /.container-fluid -->
			</nav>
		</header>