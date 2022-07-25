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

						<h1 style="margin-bottom: 30px;">Confirme seu endereço de e-mail</h1>

						<p>Está quase pronto! Uma mensagem de confirmação foi enviada para <b>
							<?php echo $_SESSION['email_temp'];?></b>.</p>
						<p>Basta verificar seu e-mail e clicar no link para terminar de criar a sua conta.</p>
						
					</div>

					<p style="text-align: center;"><a href="../public/login">Voltar para o Login</a></p>
				</div>
				<!-- /Login Tab Content -->
					
			</div>
		</div>

	</div>

</div>		
<!-- /Page Content -->

<?php include '../app/view/content/footer.php' ?>
