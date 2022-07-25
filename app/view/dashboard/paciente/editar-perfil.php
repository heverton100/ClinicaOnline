<?php 
session_start();
include '../../content/header.php'; 

require_once '../../app/dao/daoPaciente.php';

$teste = new daoPaciente;
$result = $teste->retorna_paciente($_SESSION['IDPACIENTE']);

$date = date_create($result['DATANASC']);
$datanasc = date_format($date,'d-m-Y');

if ($result['GENERO'] == '1') {
	$sexo = '<option value="0">Masculino</option>
			 <option value="1" selected>Feminino</option>';
}elseif($result['GENERO'] == '0'){
	$sexo = '<option value="0" selected>Masculino</option>
			 <option value="1">Feminino</option>';
}else{
	$sexo = '<option value="0">Masculino</option>
			 <option value="1">Feminino</option>';
}

?>

<!-- Page Content -->
<div class="content">
	<div class="container-fluid">
		<div class="row">
		
			<!-- Profile Sidebar -->
			<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

				<?php include 'sidebar.php' ?>
				
			</div>
			<!-- /Profile Sidebar -->
			
			<div class="col-md-7 col-lg-8 col-xl-9">
				<div class="card">
					<div class="card-body">
						
						<!-- Profile Settings Form -->
						<form id="cadpacienteimage" method="post" action="../../app/controllers/pacienteController.php?function=cadastro_paciente_image">
							<div class="row form-row">
								<div class="col-12 col-md-12">
									<div class="form-group">
										<div class="change-avatar">
											<div class="profile-img">
												<img src="../../<?php echo $_SESSION['URLFOTO']; ?>" alt="User Image">
											</div>
											<div class="upload-img">
												<div class="change-photo-btn">
													<span><i class="fa fa-upload"></i> Upload Photo</span>
													<input type="file" class="upload" name="imagep" id="imagep">
												</div>
												<small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>

						<form id="cadpaciente" method="post" action="../../app/controllers/pacienteController.php?function=cadastro_paciente">	
							<div class="row form-row">
								<div class="col-12 col-md-12">
									<div class="form-group">
										<label>Name</label>
										<input type="text" name="txt_nome" id="txt_nome" class="form-control" value="<?php echo $_SESSION['NOME']; ?>">
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label>E-mail</label>
										<input type="email" name="txt_email" id="txt_email" class="form-control" value="<?php echo $_SESSION['email_user']; ?>" readonly>
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label>Date de Nascimento</label>
										<div class="cal-icon">
											<input type="text" name="txt_datanasc" id="txt_datanasc" class="form-control datetimepicker" value="<?php echo $datanasc; ?>">
										</div>
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label>Genero</label>
										<select class="form-control select" name="txt_sexo" id="txt_sexo" required>
											<option value="">Selecione</option>
											<?php echo $sexo; ?>
										</select>
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label>Telefone</label>
										<input type="text" value="<?php echo $result['FONE'];?>" name="txt_tel" id="txt_tel" class="form-control">
									</div>
								</div>

								<div class="col-12 col-md-6">
									<div class="form-group">
										<label>Celular</label>
										<input type="text" value="<?php echo $result['CEL'];?>" name="txt_cel" id="txt_cel" class="form-control">
									</div>
								</div>

							</div>
							<div class="row form-row">

								<div class="col-md-4">
									<div class="form-group">
										<label>CEP</label>
										<input type="text" placeholder="CEP" class="form-control" name="txt_cep" value="<?php echo $result['CEP'];?>" id="txt_cep" required>
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<label>Logradouro</label>
										<input type="text" placeholder="Logradouro" class="form-control" value="<?php echo $result['LOGRADOURO'];?>" name="txt_logradouro" id="txt_logradouro" required>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label>Número</label>
										<input type="text" placeholder="Número" class="form-control" name="txt_numero" value="<?php echo $result['NUME'];?>" id="txt_numero">
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<label>Complemento</label>
										<input type="text" placeholder="Complemento" class="form-control" value="<?php echo $result['COMPL'];?>" name="txt_complemento" id="txt_complemento">
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<label>Bairro</label>
										<input type="text" placeholder="Bairro" class="form-control" name="txt_bairro" value="<?php echo $result['BAIRRO'];?>" id="txt_bairro">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Estado</label>
										<select class="txt_estado" name="txt_estado" id="txt_estado" style='width: 100%;' required>
											<option value="<?php echo $result['ID_ESTADO'];?>" selected><?php echo utf8_encode($result['ESTADO']);?></option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group" id="div_cidade">
										<label>Cidade</label>
										<select class="txt_cidade" name="txt_cidade" id="txt_cidade" style='width: 100%;' required>
											<option value="<?php echo $result['ID_CIDADE'];?>" selected><?php echo utf8_encode($result['CIDADE']);?></option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Pais</label>
										<select class="txt_pais" name="txt_pais" id="txt_pais" style='width: 100%;'>
											<option value="<?php echo $result['ID_PAIS'];?>" selected><?php echo utf8_encode($result['PAIS']);?></option>
										</select>
									</div>
								</div>

								<input type="hidden" value="<?php echo $_SESSION['IDPACIENTE']; ?>" name="txt_idpaciente">
							</div>
							<br>
							<div class="submit-section">
								<button type="submit" class="btn btn-primary submit-btn">Salvar</button>
								<p id="msg_retorno" style="margin-top: 10px;color: lightgreen;display: none;">Salvo com sucesso!</p>
							</div>
						</form>
						<!-- /Profile Settings Form -->
						
					</div>
				</div>
			</div>
		</div>
	</div>

</div>		
<!-- /Page Content -->
   
<?php include '../../content/footer.php'; ?>

<script type="text/javascript">

	$("#imagep").change(function(event) {
	  	event.preventDefault();

	  	var dados=$('#cadpacienteimage').serialize();

        var fd = new FormData();
        var files = $('#imagep')[0].files;
        fd.append('file',files[0]);
        fd.append('txt_idpaciente',<?php echo $_SESSION['IDPACIENTE']; ?>);

        $.ajax({
            url: '../../app/controllers/pacienteController.php?function=cadastro_paciente_image',
          	type: 'post',
          	data: fd,
          	contentType: false,
          	processData: false,
            success: function(data){
                window.location.reload(true);
            }
        });
	});

	$(document).on('submit','#cadpaciente',function(event){
        event.preventDefault();
        var dados=$(this).serialize();

        $.ajax({
            url: '../../app/controllers/pacienteController.php?function=cadastro_paciente',
            method: 'post',
            dataType: 'html',
            data: dados,
            success: function(data){
                $('#msg_retorno').css("display", "block");
            }
        });
    });

    funPopulaSelect('.txt_pais','retorna_paises','Pais');
    funPopulaSelect('.txt_estado','retorna_estados','Estado');

	$(".txt_estado").change(function(){
        var id = $(this).val();
        var dataString = 'estado='+ id;
        funPopulaSelect('.txt_cidade','retorna_cidades&'+dataString,'Cidade');
	});

	if ($(".txt_estado").val() != 0) {
		funPopulaSelect('.txt_cidade','retorna_cidades&estado='+$(".txt_estado").val(),'Cidade');
	}else{
		$('.txt_cidade').select2({
			placeholder: 'Cidade'
		});
	}

</script>