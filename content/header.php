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
				<img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/assets/img/logo.jpeg" class="img-fluid" alt="Logo">
			</a>
		</div>
		<div class="main-menu-wrapper">
			<div class="menu-header">
				<a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/index.php" class="menu-logo">
					<img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/assets/img/logo.jpeg" class="img-fluid" alt="Logo">
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
			<li class="nav-item contact-item" style="display: none;">
				<div class="header-contact-img">
					<i class="far fa-hospital"></i>							
				</div>
				<div class="header-contact-detail">
					<p class="contact-header">Contato</p>
					<p class="contact-info-header"> +55 41 0000-0000</p>
				</div>
			</li>
			<!-- User Menu -->


			<?php  if (isset($_SESSION['email_user']) && isset($_SESSION['IDPROFISSIONAL'])) { ?>


			<li class="nav-item dropdown has-arrow logged-item">
				<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
					<span class="user-img">
						<img class="rounded-circle" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/<?php echo str_replace("../", '', $_SESSION['URLFOTO']); ?>" width="31" alt="Kalen Chavez">
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
					<a class="dropdown-item" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/dashboard/profissional/index.php">Dashboard</a>
					<a class="dropdown-item" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/dashboard/profissional/doctor-profile-settings.php">Perfil</a>
					<a class="dropdown-item" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/clinica/account/login.php?logout=1">Logout</a>
				</div>
			</li>


			<?php }elseif(isset($_SESSION['email_user']) && isset($_SESSION['IDPACIENTE'])) { ?>


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


<?php if (mb_strpos($_SERVER['PHP_SELF'], 'dashboard') !== false) { ?>
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
<?php } ?>