<?php 
session_start(); 
if (isset($_SESSION['email_user'])) {
    header("Location: ../index.php");
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
										<div id="msgretorno" class="login-right" style="padding: 10px;background-color: #203a74;margin-bottom: 10px;text-align: center;color: white;display: none;">
											<p>E-mail não cadastrado!</p>
										</div>
										<div class="login-header">
											<h3>Esqueceu sua senha?</h3>
										</div>
										
										<!-- Forgot Password Form -->
										<form method="post" action="../content/controllers/forgotPassController.php?function=resetarsenha">
											<div class="form-group form-focus">
												<input type="email" class="form-control floating" name="email" id="email" required>
												<label class="focus-label">E-mail</label>
											</div>
											<div class="text-right">
												<a class="forgot-link" href="login.php">Lembrou a sua senha?</a>
											</div>
											<button id="resetarsenha" class="btn btn-primary btn-block btn-lg login-btn" type="submit">Redefinir a senha</button>
										</form>
										<!-- /Forgot Password Form -->
										
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

		<script type="text/javascript">
			$("#email").blur(function(){
				var txt = $("#email").val();
				if (txt != '') {
					$.post("../content/controllers/forgotPassController.php?function=checkemail", {email: txt}, function(result){
						if (result == 0) {
							$("#msgretorno").css("display", "block");
							$("#resetarsenha").prop("disabled", true );
						}else{
							$("#msgretorno").css("display", "none");
							$("#resetarsenha").prop("disabled", false );
						}
					});
				}
			});
		</script>
		
	</body>

</html>