<?php 

if (isset($_GET['logout'])) {
	session_start(); 
    session_destroy();
}
session_start(); 

include("../content/conf/conexao.php");

include("../content/session-validation.php");

if (isset($_GET['origem'])) {
	$origem = $_GET['origem'];
}else{
	$origem = '';
}


?>
<!DOCTYPE html> 
<html lang="en">
	
<head>
		<meta charset="utf-8">
		<title>Ibrapsi - Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
		<!-- Favicons -->
		<link href="../assets/img/favicon.png" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="../assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="../assets/js/html5shiv.min.js"></script>
			<script src="../assets/js/respond.min.js"></script>
		<![endif]-->
	
	</head>
	<body class="account-page">

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<?php include '../content/header.php' ?>
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
					
					<div class="row">
						<div class="col-md-8 offset-md-2">
							
							<!-- Login Tab Content -->
							<div class="account-content">
								<div class="row align-items-center justify-content-center">

									<div class="col-md-12 col-lg-6 login-right">
										<?php if (isset($_SESSION['loginErro'])) { ?>
										<div id="msgretorno" class="login-right" style="padding: 10px;background-color: #203a74;margin-bottom: 10px;text-align: center;color: white;">
											<p><?php echo $_SESSION['loginErro']; ?></p>
										</div>
										<?php } ?>
										<?php if (isset($_SESSION['msg_senhatrocada'])) { ?>
										<div id="msgretorno" class="login-right" style="padding: 10px;background-color: #0abb38;margin-bottom: 10px;text-align: center;color: white;">
											<p><?php echo $_SESSION['msg_senhatrocada']; ?></p>
										</div>
										<?php } ?>
										<div class="login-header">
											<h3>Login <span>Ibrapsi</span></h3>
										</div>
										<form method="post" action="../content/controllers/loginController.php">
											<div class="form-group form-focus">
												<input type="email" class="form-control floating" name="email" id="email" required>
												<label class="focus-label">Email</label>
											</div>
											<div class="form-group form-focus">
												<input type="password" class="form-control floating" name="senha" id="senha" required>
												<label class="focus-label">Senha</label>
											</div>
											<div class="text-right">
												<a class="forgot-link" href="forgot-pass.php">Esqueceu a senha?</a>
											</div>
											<input type="hidden" value="<?php echo $origem; ?>" name="origem" id="origem">
											<button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Login</button>
											<div class="text-center dont-have">Ainda não possui uma conta? <a href="register.php">Registrar</a></div>
										</form>
									</div>
								</div>
							</div>
							<!-- /Login Tab Content -->
								
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->
   
			<?php include '../content/footer.php' ?>
		   
		</div>
		<!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="../assets/js/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="../assets/js/popper.min.js"></script>
		<script src="../assets/js/bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="../assets/js/script.js"></script>
		
	</body>

</html>
<?php
unset($_SESSION['loginErro']);
unset($_SESSION['msg_senhatrocada']);
?>
