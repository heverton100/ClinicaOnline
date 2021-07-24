<?php 
session_start(); 

include("../content/conf/conexao.php");

$select_nome = "SELECT SIS.email AS EMAIL, (CASE WHEN SIS.profissional = 1 THEN PRO.nome
			WHEN SIS.paciente = 1 THEN PAC.nome END) AS NOME FROM sis_usuario SIS 
LEFT JOIN tbl_profissional PRO ON PRO.ID_USUARIO = SIS.ID_USUARIO 
LEFT JOIN tbl_paciente PAC ON PAC.ID_USUARIO = SIS.ID_USUARIO
WHERE SIS.token = '".$_GET['hash']."'";
$result_nome = mysqli_query($conn, $select_nome);
$row_nome = mysqli_fetch_assoc($result_nome);



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
										<div class="login-header">
											<h3>Redefinir Senha</h3>
										</div>
										
										<!-- Forgot Password Form -->
										<form method="post" action="../content/controllers/forgotPassController.php?function=updatesenha">
											<div class="form-group form-focus">
												<input type="email" class="form-control floating" name="email" id="email" value="<?php echo $row_nome['EMAIL']; ?>" required>
												<label class="focus-label">E-mail</label>
											</div>
											<div class="form-group form-focus">
												<input type="password" class="form-control floating" name="senha1" id="senha1" onkeyup="Verifica()" required>
												<label class="focus-label">Nova Senha</label>
											</div>
											<div class="form-group form-focus">
												<input type="password" class="form-control floating" name="senha2" id="senha2" onkeyup="Verifica()" required>
												<label class="focus-label">Confirme a Nova Senha</label>
											</div>
											<button id="updatesenha" class="btn btn-primary btn-block btn-lg login-btn" type="submit">Redefinir</button>
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

		<script>
		function Verifica(){
		    val1=document.getElementById("senha1").value;
		    val2=document.getElementById("senha2").value;
		    if(val1!=val2){
		    	document.getElementById("senha1").style.borderColor="#f00";
		        document.getElementById("senha2").style.borderColor="#f00";
				$("#updatesenha").prop("disabled", true );
		    }else{
		    	document.getElementById("senha1").style.borderColor="#0f0";
		        document.getElementById("senha2").style.borderColor="#0f0";
				$("#updatesenha").prop("disabled", false );
		    }
		}
		</script>
		
	</body>

</html>