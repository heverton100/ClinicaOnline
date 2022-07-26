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
					<a href="../../public/home" class="navbar-brand logo">
						<img src="../../public/img/logo2.png" class="img-fluid custom-logotipo" alt="Logo">
					</a>
				</div>
				<div class="main-menu-wrapper">
					<div class="menu-header">
						<a href="../../public/home" class="menu-logo">
							<img src="../../public/img/logo2.png" class="img-fluid custom-logotipo" alt="Logo">
							Ibrapsi
						</a>
						<a id="menu_close" class="menu-close" href="javascript:void(0);">
							<i class="fas fa-times"></i>
						</a>
					</div>

					<ul class="main-nav"></ul>

				</div>		 
				<ul class="nav header-navbar-rht">

					<!-- User Menu -->

					<li class="nav-item dropdown has-arrow logged-item">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img">
								<img class="rounded-circle" src="<?php echo "../".$_SESSION['URLFOTO']; ?>" width="31" alt="Kalen Chavez">
							</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="user-header">
								<div class="avatar avatar-sm">
									<img src="<?php echo "../".$_SESSION['URLFOTO']; ?>" alt="User Image" class="avatar-img rounded-circle">
								</div>
								<div class="user-text">
									<h6><?php echo $_SESSION['NOME']; ?></h6>
									<p class="text-muted mb-0"><?php echo $_SESSION['email_user']; ?></p>
								</div>
							</div>
							<a class="dropdown-item" href="../../public/dashboard/profissional_main">Minha Conta</a>
							<a class="dropdown-item" href="../../public/logout">Logout</a>
						</div>
					</li>

					<!-- /User Menu -->

				</ul>
			</nav>
		</header>
		<!-- /Header -->