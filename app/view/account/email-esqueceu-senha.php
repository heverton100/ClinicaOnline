<?php

session_start();

include '../app/view/content/header.php';

$dest = $_GET['email'];

?>
			
<!-- Page Content -->
<div class="content">
	<div class="container-fluid">
		
		<div class="row">
			<div class="col-md-8 offset-md-2">
				
				<!-- Login Tab Content -->
				<div class="account-content">
					<div class="row align-items-center justify-content-center">

						<h1>Confirme seu endereço de e-mail</h1>
						<p>Está quase pronto! Uma mensagem de Redefinição de Senha foi enviada para <b>
							<?php echo $dest;?></b>.</p>
						<p>Basta verificar seu e-mail e clicar no link para terminar de redefinir a sua senha.</p>
					</div>
				</div>
				<!-- /Login Tab Content -->
					
			</div>
		</div>

	</div>

</div>		
<!-- /Page Content -->

<?php include '../app/view/content/footer.php' ?>
		   
