<?php
session_start();

require 'C:/xampp/htdocs/clinica/app/dao/daoUser.php';
$teste = new daoUser;

$hash = $_GET['hash'];

$teste->valida_email($hash);

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

						<h1>Seu e-mail foi validado com sucesso!</h1>
						<p><a href="login.php">Clique aqui para fazer o Login</a></p>
					</div>
				</div>
				<!-- /Login Tab Content -->
					
			</div>
		</div>

	</div>

</div>		
<!-- /Page Content -->

<?php include '../content/footer.php' ?>