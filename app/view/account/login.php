<?php 

session_start(); 

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
							<form method="post" action="../app/controller/HandlerUsuario.php?function=login">
								<div class="form-group form-focus">
									<input type="email" class="form-control floating" name="email" id="email" required>
									<label class="focus-label">Email</label>
								</div>
								<div class="form-group form-focus">
									<input type="password" class="form-control floating" name="senha" id="senha" required>
									<label class="focus-label">Senha</label>
								</div>
								<div class="text-right">
									<a class="forgot-link" href="../public/esqueceu_senha">Esqueceu a senha?</a>
								</div>
								<button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Login</button>
								<div class="text-center dont-have">Ainda não possui uma conta? <a href="../public/registro_paciente">Registrar</a></div>
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

<?php include '../app/view/content/footer.php' ?>
		   
<?php
unset($_SESSION['loginErro']);
unset($_SESSION['msg_senhatrocada']);
?>
