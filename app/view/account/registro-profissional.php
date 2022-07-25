<?php
session_start();
if (isset($_SESSION['email_user']) || isset($_SESSION['IDPROFISSIONAL'])) {
    header("Location: ../index.php");
}

include '../app/view/content/header.php';

?>
			
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
								<h3>Registro <a href="../public/registro_paciente">Você não é um profissional?</a></h3>
							</div>
							
							<!-- Register Form -->
							<form method="post" action="../app/controller/HandlerUsuario.php?function=registrar_profissional">
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
									<a class="forgot-link" href="../public/login">Já possui uma conta?</a>
								</div>
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

<?php include '../app/view/content/footer.php' ?>

<script type="text/javascript">
/*	$("#email").blur(function(){
		var txt = $("#email").val();
		if (txt != '') {
			$.post("../app/controllers/userController.php?function=check_email", {email: txt}, function(result){
				if (result == 1) {
					$("#msgretorno").css("display", "block");
					$("#registrar").prop("disabled", true );
				}else{
					$("#msgretorno").css("display", "none");
					$("#registrar").prop("disabled", false );
				}
			});
		}
	});*/
</script>