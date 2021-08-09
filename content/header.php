<!DOCTYPE html> 
<html lang="en">
	
<head>
	<meta charset="utf-8">
	<title>Ibrapsi</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	
	<!-- Favicons -->
	<link href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/assets/img/favicon.png" rel="icon">
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/assets/css/bootstrap.min.css">
	
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/assets/plugins/fontawesome/css/all.min.css">

	<!-- Daterangepikcer CSS -->
	<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/assets/plugins/daterangepicker/daterangepicker.css">

	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/assets/css/bootstrap-datetimepicker.min.css">

	<!-- Select2 CSS -->
	<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/assets/plugins/select2/css/select2.min.css">

	<!-- Fancybox CSS -->
	<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/assets/plugins/fancybox/jquery.fancybox.min.css">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css">
	<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/assets/plugins/dropzone/dropzone.min.css">
	
	<!-- Main CSS -->
	<link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/assets/css/style.css">
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/assets/js/html5shiv.min.js"></script>
		<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/assets/js/respond.min.js"></script>
	<![endif]-->

</head>
<body>

	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		<header class="header">
			<nav class="navbar navbar-expand-lg header-nav">
				<div class="navbar-header">
					<a id="mobile_btn" href="javascript:void(0);">
						<span class="bar-icon">
							<span></span>
							<span></span>
							<span></span>
						</span>
					</a>
					<a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/index.php" class="navbar-brand logo">
						<img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/assets/img/logo2.png" class="img-fluid custom-logotipo" alt="Logo">
					</a>
				</div>
				<div class="main-menu-wrapper">
					<div class="menu-header">
						<a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/index.php" class="menu-logo">
							<img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/assets/img/logo2.png" class="img-fluid custom-logotipo" alt="Logo">
							Ibrapsi
						</a>
						<a id="menu_close" class="menu-close" href="javascript:void(0);">
							<i class="fas fa-times"></i>
						</a>
					</div>
					<?php if (isset($_SESSION['IDPROFISSIONAL']) or isset($_SESSION['IDPACIENTE'])) { ?>
					<ul class="main-nav"></ul>
					<?php }else{ ?>
					<ul class="main-nav">
						<li>
							<a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/account/register.php">Seja um Membro</a>
						</li>
						
						<li>
							<a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/account/doctor-register.php">Para Especialistas</a>
						</li>
					</ul>
					<?php } ?>	
				</div>		 
				<ul class="nav header-navbar-rht">

					<!-- User Menu -->

					<?php  if (isset($_SESSION['email_user']) && isset($_SESSION['IDPROFISSIONAL'])) { ?>

					<li class="nav-item dropdown has-arrow logged-item">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img">
								<img class="rounded-circle" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/<?php echo $_SESSION['URLFOTO']; ?>" width="31" alt="Kalen Chavez">
							</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="user-header">
								<div class="avatar avatar-sm">
									<img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/<?php echo str_replace("../", '', $_SESSION['URLFOTO']); ?>" alt="User Image" class="avatar-img rounded-circle">
								</div>
								<div class="user-text">
									<h6><?php echo $_SESSION['NOME']; ?></h6>
									<p class="text-muted mb-0"><?php echo $_SESSION['email_user']; ?></p>
								</div>
							</div>
							<a class="dropdown-item" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/dashboard/profissional/index.php">Minha Conta</a>
							<a class="dropdown-item" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/account/login.php?logout=1">Logout</a>
						</div>
					</li>


					<?php }elseif(isset($_SESSION['email_user']) && isset($_SESSION['IDPACIENTE'])) { ?>


					<li class="nav-item dropdown has-arrow logged-item">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img">
								<img class="rounded-circle" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/<?php echo $_SESSION['URLFOTO']; ?>" width="31">
							</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="user-header">
								<div class="avatar avatar-sm">
									<img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/<?php echo str_replace("../", '', $_SESSION['URLFOTO']); ?>" alt="User Image" class="avatar-img rounded-circle">
								</div>
								<div class="user-text">
									<h6><?php echo $_SESSION['NOME']; ?></h6>
									<p class="text-muted mb-0"><?php echo $_SESSION['email_user']; ?></p>
								</div>
							</div>
							<a class="dropdown-item" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/dashboard/paciente/index.php">Minha Conta</a>
							<a class="dropdown-item" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/account/login.php?logout=1">Logout</a>
						</div>
					</li>

					<?php }else{ ?>
					<li class="login-link">
						<a class="nav-link header-login" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/account/login.php">Login</a>
					</li>
					<?php } ?>
					<!-- /User Menu -->

				</ul>
			</nav>
		</header>
		<!-- /Header -->