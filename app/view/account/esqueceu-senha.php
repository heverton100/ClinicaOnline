<?php 
session_start(); 
if (isset($_SESSION['email_user'])) {
    header("Location: ../index.php");
}

include '../app/view/content/header.php';

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
							<div id="msgretorno" class="login-right" style="padding: 10px;background-color: #203a74;margin-bottom: 10px;text-align: center;color: white;display: none;">
								<p>E-mail não cadastrado!</p>
							</div>
							<div class="login-header">
								<h3>Esqueceu sua senha?</h3>
							</div>
							
							<!-- Forgot Password Form -->
							<form method="post" action="../app/controller/HandlerUsuario.php?function=resetar_senha">
								<div class="form-group form-focus">
									<input type="email" class="form-control floating" name="email" id="email" required>
									<label class="focus-label">E-mail</label>
								</div>
								<div class="text-right">
									<a class="forgot-link" href="../public/login">Lembrou a sua senha?</a>
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

<?php include '../app/view/content/footer.php' ?>


<script type="text/javascript">
	$("#email").blur(function(){
		var txt = $("#email").val();
		if (txt != '') {
			$.post("../app/controller/HandlerUsuario.php?function=check_email", {email: txt}, function(result){
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