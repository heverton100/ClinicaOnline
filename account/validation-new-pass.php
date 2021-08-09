<?php 
session_start(); 

require 'C:/xampp/htdocs/clinica/app/dao/daoUser.php';
$teste = new daoUser;

$row_nome = $teste->retorna_nome_email($_GET['hash']);

include '../content/header.php';

?>
			
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
							<form method="post" action="../app/controllers/userController.php?function=update_senha">
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