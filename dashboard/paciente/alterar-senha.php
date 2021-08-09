<?php
session_start();
include '../../content/header.php';
?>

<!-- Page Content -->
<div class="content">
	<div class="container-fluid">

		<div class="row">
			<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
			
			<?php include 'sidebar.php' ?>
				
			</div>
			<div class="col-md-7 col-lg-8 col-xl-9">
			
				<!-- Basic Information -->
				<div class="card">
					<div class="card-body">
						<div class="col-md-12 col-lg-6">
						
							<!-- Change Password Form -->
							<form id="resetasenha" method="post" action="../../app/controllers/pacienteController.php?function=update_senha_paciente">
								<div class="form-group">
									<label>Senha Antiga</label>
									<input type="password" class="form-control"name="senhaantiga" id="senhaantiga" required>
								</div>
								<div class="form-group">
									<label>Nova Senha</label>
									<input type="password" class="form-control" name="senha1" id="senha1" onkeyup="Verifica()" required>
								</div>
								<div class="form-group">
									<label>Confirme a Nova Senha</label>
									<input type="password" class="form-control" name="senha2" id="senha2" onkeyup="Verifica()" required>
								</div>
								<input type="hidden" value="<?php echo $_SESSION['IDPACIENTE']; ?>" name="txt_idpaciente">
								<div class="submit-section">
									<button type="submit" id="updatesenha" class="btn btn-primary submit-btn">Salvar</button>
									<p id="msg_retorno" style="color: lightgreen;display: none;margin-top: 20px;background-color: #203a74;text-align: center;padding-bottom: 10px;padding-top: 10px;"></p>
								</div>
							</form>
							<!-- /Change Password Form -->
							
						</div>
					</div>
				</div>
				<!-- /Basic Information -->
				
			</div>
		</div>

	</div>

</div>		
<!-- /Page Content -->

<?php include '../../content/footer.php'; ?>

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


	$(document).on('submit','#resetasenha',function(event){
        event.preventDefault();
        var dados=$(this).serialize();

        $.ajax({
            url: '../../app/controllers/pacienteController.php?function=update_senha_paciente',
            method: 'post',
            dataType: 'html',
            data: dados,
            success: function(data){
            	$('#msg_retorno').css('display','block');
                $('#msg_retorno').html(data);
            }
        });
    });
</script>