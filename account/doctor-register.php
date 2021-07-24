<?php
session_start();
if (isset($_SESSION['email_user']) || isset($_SESSION['IDPROFISSIONAL'])) {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html> 
<html lang="en">
	
<head>
		<meta charset="utf-8">
		<title>Ibrapsi - Registro</title>
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
								
							<!-- Register Content -->
							<div class="account-content">
								<div class="row align-items-center justify-content-center">
									<div class="col-md-12 col-lg-6 login-right">
										<div id="msgretorno" class="login-right" style="padding: 10px;background-color: #203a74;margin-bottom: 10px;text-align: center;color: white;display: none;">
											<p>Este e-mail já está cadastrado!</p>
										</div>
										<div class="login-header">
											<h3>Registro <a href="register.php">Você não é um profissional?</a></h3>
										</div>
										
										<!-- Register Form -->
										<form method="post" action="../content/controllers/registerController.php">
											<div class="form-group form-focus">
												<input type="text" class="form-control floating" name="nome" id="nome" required>
												<label class="focus-label">Nome</label>
											</div>
											<div class="form-group form-focus">
												<input type="email" class="form-control floating" name="email" id="email" required>
												<label class="focus-label">E-mail</label>
											</div>
											<div class="form-group form-focus">
												<input type="password" class="form-control floating" name="senha" id="senha" required>
												<label class="focus-label">Senha</label>
											</div>
											<div class="text-right">
												<a class="forgot-link" href="login.php">Já possui uma conta?</a>
											</div>
											<input type="hidden" name="tipo" value="profissional">
											<button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Registrar</button>
										</form>
										<!-- /Register Form -->
										
									</div>
								</div>
							</div>
							<!-- /Register Content -->
								
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
					$.post("../content/controllers/registerController.php", {email: txt, tipo: "checkemail"}, function(result){
						if (result == 1) {
							$("#msgretorno").css("display", "block");
							$("#registrar").prop("disabled", true );
						}else{
							$("#msgretorno").css("display", "none");
							$("#registrar").prop("disabled", false );
						}
					});
				}
			});
		</script>
		
	</body>

</html>