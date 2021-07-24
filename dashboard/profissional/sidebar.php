<?php 
	$active1 = "";
	$active2 = "";
	$active3 = "";
	$active4 = "";

	switch (pathinfo($_SERVER['REQUEST_URI'],PATHINFO_BASENAME)) {
		case "index.php":
			$active1 = "active";
			break;
		case "doctor-profile-settings.php":
			$active2 = "active";
			break;
		case "schedule-timings.php":
			$active3 = "active";
			break;
		case "doctor-change-password.php":
			$active4 = "active";
			break;
	}
?>

							<!-- Profile Sidebar -->
							<div class="profile-sidebar">
								<div class="widget-profile pro-widget-content">
									<div class="profile-info-widget">
										<a href="#" class="booking-doc-img">
											<img src="<?php echo $_SESSION['URLFOTO']; ?>" alt="User Image">
										</a>
										<div class="profile-det-info">
											<h3><?php echo $_SESSION['NOME']; ?></h3>
											
											<div class="patient-details">
												<h5 class="mb-0"><?php echo $_SESSION['email_user']; ?></h5>
											</div>
										</div>
									</div>
								</div>
								<div class="dashboard-widget">
									<nav class="dashboard-menu">
										<ul>
											<li class="<?php echo $active1; ?>">
												<a href="index.php">
													<i class="fas fa-columns"></i>
													<span>Dashboard</span>
												</a>
											</li>
											<li class="<?php echo $active2; ?>">
												<a href="doctor-profile-settings.php">
													<i class="fas fa-user-cog"></i>
													<span>Perfil</span>
												</a>
											</li>
											<li class="<?php echo $active3; ?>">
												<a href="schedule-timings.php">
													<i class="fas fa-hourglass-start"></i>
													<span>Programar Horários</span>
												</a>
											</li>
											<li class="<?php echo $active4; ?>">
												<a href="doctor-change-password.php">
													<i class="fas fa-lock"></i>
													<span>Alterar Senha</span>
												</a>
											</li>
											<li>
												<a href="../../account/login.php?logout=1">
													<i class="fas fa-sign-out-alt"></i>
													<span>Logout</span>
												</a>
											</li>
										</ul>
									</nav>
								</div>
							</div>
							<!-- /Profile Sidebar -->