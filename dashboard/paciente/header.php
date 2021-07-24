<?php 

session_start();

if (!isset($_SESSION['email_user'])) {
	header("Location: ../../account/login.php");
}

?>

<!DOCTYPE html> 
<html lang="en">
	
<head>
		<meta charset="utf-8">
		<title>IBRAPSI</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
		<!-- Favicons -->
		<link href="../../assets/img/favicon.png" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="../../assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="../../assets/plugins/fontawesome/css/all.min.css">

		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="../../assets/css/bootstrap-datetimepicker.min.css">

		<!-- Select2 CSS -->
		<link rel="stylesheet" href="../../assets/plugins/select2/css/select2.min.css">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="../../assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css">
		<link rel="stylesheet" href="../../assets/plugins/dropzone/dropzone.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="../../assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="../../assets/js/html5shiv.min.js"></script>
			<script src="../../assets/js/respond.min.js"></script>
		<![endif]-->

		<style>
		.main-menu-wrapper {
		    display: none;
		}

		li.nav-item.contact-item {
		    display: none;
		}

		nav.navbar.navbar-expand-lg.header-nav {
		    height: 60px;
		    background-color: #bfbfbf;
		}

		li.nav-item.dropdown.has-arrow.logged-item {
		    height: 60px;
		}
		</style>
	
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
							<img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/assets/img/logo.jpeg" class="img-fluid" alt="Logo" style="width: 100px;">
						</a>
					</div>
					<div class="main-menu-wrapper">
						<div class="menu-header">
							<a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/index.php" class="menu-logo">
								<img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/assets/img/logo.jpeg" class="img-fluid" alt="Logo" style="width: 100px;">
								Ibrapsi
							</a>
							<a id="menu_close" class="menu-close" href="javascript:void(0);">
								<i class="fas fa-times"></i>
							</a>
						</div>
						<ul class="main-nav">
							<li>
								<a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/account/register.php">Seja um Membro</a>
							</li>
							
							<li>
								<a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/account/doctor-register.php">Para Especialistas</a>
							</li>
						</ul>	
					</div>		 
					<ul class="nav header-navbar-rht">
						<li class="nav-item contact-item">
							<div class="header-contact-img">
								<i class="far fa-hospital"></i>							
							</div>
							<div class="header-contact-detail">
								<p class="contact-header">Contato</p>
								<p class="contact-info-header"> +55 41 0000-0000</p>
							</div>
						</li>
						<!-- User Menu -->


						<li class="nav-item dropdown has-arrow logged-item">
							<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
								<span class="user-img">
									<img class="rounded-circle" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/<?php echo str_replace("../", '', $_SESSION['URLFOTO']); ?>" width="31">
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
								<a class="dropdown-item" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/dashboard/paciente/index.php">Dashboard</a>
								<a class="dropdown-item" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/dashboard/paciente/paciente-profile-settings.php">Perfil</a>
								<a class="dropdown-item" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/account/login.php?logout=1">Logout</a>
							</div>
						</li>

						<!-- /User Menu -->
					</ul>
				</nav>
			</header>
			<!-- /Header -->
