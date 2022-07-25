<?php

session_start();

$hash = $_GET['hash'];

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

						<h1>Seu e-mail foi validado com sucesso!</h1>
						<p><a href="../public/login">Clique aqui para fazer o Login</a></p>
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
	$.ajax({
	    type: 'GET',
	    url: '../app/controller/HandlerUsuario.php?function=confirma_email&hash=<?php echo $hash; ?>'
	}).then(function (data) {});
</script>