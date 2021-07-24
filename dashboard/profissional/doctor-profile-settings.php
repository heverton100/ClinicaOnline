<?php 

include 'header.php';

require_once '../../content/dao/daoProfissional.php';

$teste = new daoProfissional;

$result = $teste->retornaProf($_SESSION['IDPROFISSIONAL']);

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


if ($result['DURACAOSESSAO'] == 30) {
	$periodo = '<option value="30" selected>30 minutos</option>  
			<option value="60">1 hora</option>';
}elseif($result['DURACAOSESSAO'] == 60){
	$periodo = '<option value="30">30 minutos</option>  
			<option value="60" selected>1 hora</option>';
}else{
	$periodo = '<option value="30">30 minutos</option>  
			<option value="60">1 hora</option>';
}

$date = date_create($result['DATANASC']);
$datanasc = date_format($date,'d-m-Y');

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
									<form id="informacoesbasicas" enctype="multipart/form-data" method="post" action="../../content/controllers/profissionalController.php?form=informacoesbasicas">
										<h4 class="card-title">Informações Básicas</h4>
										<div class="row form-row">
											<div class="col-md-12">
												<div class="form-group">
													<div class="change-avatar">
														<div class="profile-img">
															<img id="imageperfil" src="<?php echo $_SESSION['URLFOTO']; ?>" alt="User Image" width="100" height="100">
														</div>
														<div class="upload-img">
															<div class="change-photo-btn">
																<span><i class="fa fa-upload"></i> Upload Photo</span>
																<input onchange="document.getElementById('imageperfil').src = window.URL.createObjectURL(this.files[0])" name="imagep" id="imagep" type="file" class="upload">
															</div>
															<small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>E-mail <span class="text-danger">*</span></label>
													<input type="email" class="form-control" value="<?php echo $_SESSION['email_user']; ?>" name="txt_email" id="txt_email" readonly>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Nome <span class="text-danger">*</span></label>
													<input type="text" class="form-control" value="<?php echo $_SESSION['NOME']; ?>" name="txt_nome" id="txt_nome" required>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Genero</label>
													<select class="form-control select" name="txt_sexo" id="txt_sexo" required>
														<option value="">Selecione</option>
														<?php echo $sexo; ?>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group mb-0">
													<label>Data de Nascimento</label>
													<div class="cal-icon">
														<input type="text" class="form-control datetimepicker" name="txt_datanasc" id="txt_datanasc" value="<?php echo $datanasc; ?>" required>
													</div>	
												</div>
											</div>
											<input type="hidden" value="<?php echo $_SESSION['IDPROFISSIONAL']; ?>" name="txt_idprofissional">
											<div class="col-md-12" style="text-align: end;">
												<div class="submit-section submit-btn-bottom">
													<p id="msg_retorno0" style="color: lightgreen;display: none;">Salvo com sucesso!</p>
													<button type="submit" class="btn btn-primary submit-btn">Salvar</button>
												</div>
											</div>

										</div>
									</form>	
								</div>
							</div>
							<!-- /Basic Information -->
							
							<!-- About Me -->
							<div class="card">
								<div class="card-body">
									<form id="resumo" method="post" action="../../content/controllers/profissionalController.php?form=resumo">
										<h4 class="card-title">Sobre</h4>

											<div class="form-group mb-0">
												<label>Resumo</label>
												<textarea class="form-control" rows="5" name="txt_resumo" id="txt_resumo" required><?php echo $result['RESUMO'];?></textarea>
												<small class="text-muted"><span id="txtLengthMaxResumo">0</span> caracteres restantes</small>
											</div>

											<input type="hidden" value="<?php echo $_SESSION['IDPROFISSIONAL']; ?>" name="txt_idprofissional">
											<div class="submit-section submit-btn-bottom" style="text-align: end;margin-top: 20px;">
												<p id="msg_retorno1" style="color: lightgreen;display: none;">Salvo com sucesso!</p>
												<button type="submit" class="btn btn-primary submit-btn">Salvar</button>
											</div>
									
									</form>
								</div>
							</div>
							<!-- /About Me -->

							<!-- Contact Details -->
							<div class="card contact-card">
								<div class="card-body">
									<form id="endereco" method="post" action="../../content/controllers/profissionalController.php?form=endereco">
										<h4 class="card-title">Informações de Contato</h4>
										<div class="row form-row">

											<div class="col-md-4">
												<div class="form-group">
													<input type="text" placeholder="CEP" class="form-control" name="txt_cep" value="<?php echo $result['CEP'];?>" id="txt_cep" required>
												</div>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<input type="text" placeholder="Logradouro" class="form-control" value="<?php echo $result['LOGRADOURO'];?>" name="txt_logradouro" id="txt_logradouro" required>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<input type="text" placeholder="Número" class="form-control" name="txt_numero" value="<?php echo $result['NUME'];?>" id="txt_numero">
												</div>
											</div>
											<div class="col-md-5">
												<div class="form-group">
													<input type="text" placeholder="Complemento" class="form-control" value="<?php echo $result['COMPL'];?>" name="txt_complemento" id="txt_complemento">
												</div>
											</div>
											<div class="col-md-5">
												<div class="form-group">
													<input type="text" placeholder="Bairro" class="form-control" name="txt_bairro" value="<?php echo $result['BAIRRO'];?>" id="txt_bairro">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<select class="txt_estado" name="txt_estado" id="txt_estado" style='width: 100%;' required>
														<option value="<?php echo $result['ID_ESTADO'];?>" selected><?php echo utf8_encode($result['ESTADO']);?></option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group" id="div_cidade">
													<select class="txt_cidade" name="txt_cidade" id="txt_cidade" style='width: 100%;' required>
														<option value="<?php echo $result['ID_CIDADE'];?>" selected><?php echo utf8_encode($result['CIDADE']);?></option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<select class="txt_pais" name="txt_pais" id="txt_pais" style='width: 100%;'>
														<option value="<?php echo $result['ID_PAIS'];?>" selected><?php echo utf8_encode($result['PAIS']);?></option>
													</select>
												</div>
											</div>

											<input type="hidden" value="<?php echo $_SESSION['IDPROFISSIONAL']; ?>" name="txt_idprofissional">
											<div class="col-md-12" style="text-align: end;">
												<div class="submit-section submit-btn-bottom">
													<p id="msg_retorno2" style="color: lightgreen;display: none;">Salvo com sucesso!</p>
													<button type="submit" class="btn btn-primary submit-btn">Salvar</button>
												</div>
											</div>
										</div>
									</form>	
								</div>
							</div>
							<!-- /Contact Details -->

							<!-- Valores -->
							<div class="card contact-card">
								<div class="card-body">
									<form id="valores" method="post" action="../../content/controllers/profissionalController.php?form=valores">
										<h4 class="card-title">Valores</h4>
										<div class="row form-row">

											<div class="col-md-4">
												<div class="form-group">
													<label>Valor</label>
													<input type="text" placeholder="Valor da Sessão" class="form-control" name="txt_valor_sessao" value="<?php echo $result['VALORSESSAO'];?>" id="txt_valor_sessao" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Duração</label>
													<select id="txt_periodo" name="txt_periodo" class="select form-control" >
														<option value="">Selecione</option>
														<?php echo $periodo; ?>
													</select>
												</div>
											</div>
											<input type="hidden" value="<?php echo $_SESSION['IDPROFISSIONAL']; ?>" name="txt_idprofissional">
											<div class="col-md-12" style="text-align: end;">
												<div class="submit-section submit-btn-bottom">
													<p id="msg_retorno3" style="color: lightgreen;display: none;">Salvo com sucesso!</p>
													<button type="submit" class="btn btn-primary submit-btn">Salvar</button>
												</div>
											</div>
										</div>
									</form>	
								</div>
							</div>
							<!-- /Valores -->

							<!-- Education -->
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Formação</h4>
									<div class="education-info">
										<div class="table-responsive">
											<table class="table table-hover table-center mb-0">
												<thead>
													<th>Curso</th>
													<th>Instituição</th>
													<th>Nível</th>
													<th>Opções</th>
												</thead>
												<tbody id="rows_formacoes">

												</tbody>
											</table>
										</div>				
									</div>
									<div class="add-more" style="margin-top: 10px;">
										<a href="#" data-toggle="modal" data-target="#md_nova_formacao"><i class="fa fa-plus-circle"></i> Adicionar</a>
									</div>

								</div>
							</div>
							<!-- /Education -->

							<!-- Experiencia -->
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Experiencia</h4>
									<div class="education-info">
										<div class="table-responsive">
											<table class="table table-hover table-center mb-0">
												<thead>
													<th>Cargo</th>
													<th>Empresa</th>
													<th>Atividades</th>
													<th>Opções</th>
												</thead>
												<tbody id="rows_experiencia">

												</tbody>
											</table>
										</div>				
									</div>
									<div class="add-more" style="margin-top: 10px;">
										<a href="#" data-toggle="modal" data-target="#md_nova_experiencia"><i class="fa fa-plus-circle"></i> Adicionar</a>
									</div>

								</div>
							</div>
							<!-- /Experiencia -->


							<!-- Services and Specialization -->
							<div class="card services-card">
								<div class="card-body">
									<h4 class="card-title">Especialidades</h4>
									<div class="form-group mb-0">
										<select class="especialidades" multiple="multiple" style="width: 100%" name="especialidades" id="especialidades"></select>
									</div> 
									<div class="col-md-12" style="text-align: end;padding-right: 0;padding-top: 20px;">
										<div class="submit-section submit-btn-bottom">
											<button id="gravaespecialidades" type="button" class="btn btn-primary submit-btn">Salvar</button>
										</div>
									</div>
								</div>              
							</div>
							<!-- /Services and Specialization -->
							
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->

		<?php include 'modals.php' ?>
   
		<?php include 'footer.php' ?>

		<script type="text/javascript">
			
			$(document).on('submit','#informacoesbasicas',function(event){
		        event.preventDefault();
		        var dados=$(this).serialize();

		        var fd = new FormData();
		        var files = $('#imagep')[0].files;
		        fd.append('file',files[0]);

		        fd.append('txt_nome',$('#txt_nome').val());
		        fd.append('txt_datanasc',$('#txt_datanasc').val());
		        fd.append('txt_sexo',$('#txt_sexo').val());
		        fd.append('txt_idprofissional',<?php echo $_SESSION['IDPROFISSIONAL']; ?>);

		        $.ajax({
		            url: '../../content/controllers/profissionalController.php?form=informacoesbasicas',
              type: 'post',
              data: fd,
              contentType: false,
              processData: false,
		            success: function(data){
		                $('#msg_retorno0').css("display", "block");
		                window.location.reload(true);
		            }
		        });
		    });

			$(document).on('submit','#resumo',function(event){
		        event.preventDefault();
		        var dados=$(this).serialize();

		        $.ajax({
		            url: '../../content/controllers/profissionalController.php?form=resumo',
		            method: 'post',
		            dataType: 'html',
		            data: dados,
		            success: function(data){
		                $('#msg_retorno1').css("display", "block");
		            }
		        });
		    });

			$(document).on('submit','#endereco',function(event){
		        event.preventDefault();
		        var dados=$(this).serialize();

		        $.ajax({
		            url: '../../content/controllers/profissionalController.php?form=endereco',
		            method: 'post',
		            dataType: 'html',
		            data: dados,
		            success: function(data){
		                $('#msg_retorno2').css("display", "block");
		            }
		        });
		    });

			$(document).on('submit','#valores',function(event){
		        event.preventDefault();
		        var dados=$(this).serialize();

		        $.ajax({
		            url: '../../content/controllers/profissionalController.php?form=valores',
		            method: 'post',
		            dataType: 'html',
		            data: dados,
		            success: function(data){
		                $('#msg_retorno3').css("display", "block");
		            }
		        });
		    });

		    function funPopulaSelect(classe,funcao,placeholder) {
			    $(classe).select2({
					ajax: {
						url: '../../content/controllers/sisController.php?function='+funcao,
						dataType: 'json',
						type: "post",

						data: function (params) {
							return {
								searchTerm: params.term // search term
							};
						},
						processResults: function (response) {
							return {
								results: response
							};
						},
					},
					placeholder: placeholder
				});
		    }

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


		    funPopulaSelect('.especialidades','retorna_especialidades','Especialidades');

			$("#gravaespecialidades").click(function(){

		        var id = $(".especialidades").val();

				$.post("../../content/controllers/profissionalController.php?form=especialidades", {id_espec: id, id_prof: <?php echo $_SESSION['IDPROFISSIONAL']; ?>}, function(result){
					//alert(result);
				});

			});

			$.ajax({
			    type: 'GET',
			    url: '../../content/controllers/profissionalController.php?form=retorna_especialidades&id=' + <?php echo $_SESSION['IDPROFISSIONAL']; ?>
			}).then(function (data) {

			    $(".especialidades").html(data);

			});

		    
			$(document).on('submit','#novaformacao',function(event){
		        event.preventDefault();
		        var dados=$(this).serialize();

		        $.ajax({
		            url: '../../content/controllers/profissionalController.php?form=nova_formacao',
		            method: 'post',
		            dataType: 'html',
		            data: dados,
		            success: function(data){
		            	funRetornaFormacoes();
		                $('#md_nova_formacao').modal('hide');
		            }
		        });
		    });

		    function funRetornaFormacoes() {
				$.ajax({
				    type: 'GET',
				    url: '../../content/controllers/profissionalController.php?form=retorna_formacoes&id=' + <?php echo $_SESSION['IDPROFISSIONAL']; ?>
				}).then(function (data) {
				    // create the option and append to Select2

				    $("#rows_formacoes").html(data);
					funPopulaSelect('.txt_curso','retorna_cursos','Curso');
				    funPopulaSelect('.txt_instituicao','retorna_instituicoes','Instituição');
				    funPopulaSelect('.txt_situacao','retorna_situacoes','Situação');
				    funPopulaSelect('.txt_nivel','retorna_niveis','Nível');
				});
		    }

		    funRetornaFormacoes();

			$(document).on('submit','#novaexperiencia',function(event){
		        event.preventDefault();
		        var dados=$(this).serialize();

		        $.ajax({
		            url: '../../content/controllers/profissionalController.php?form=nova_experiencia',
		            method: 'post',
		            dataType: 'html',
		            data: dados,
		            success: function(data){
		            	funRetornaExperiencias();
		                $('#md_nova_experiencia').modal('hide');
		            }
		        });
		    });

		    function funRetornaExperiencias() {
				$.ajax({
				    type: 'GET',
				    url: '../../content/controllers/profissionalController.php?form=retorna_experiencias&id=' + <?php echo $_SESSION['IDPROFISSIONAL']; ?>
				}).then(function (data) {
				    // create the option and append to Select2

				    $("#rows_experiencia").html(data);

				});
		    }

		    funRetornaExperiencias(); 

			var maxLengthAtividades = 1000;
			$('#txt_atividades').on('keyup change', function () {
				var length = $(this).val().length;
				 length = maxLengthAtividades-length;
				$('#txtLengthMaxAtividades').text(length);
			});

			var maxLengthResumo = 1000;
			$('#txt_resumo').on('keyup change', function () {
				var length = $(this).val().length;
				 length = maxLengthResumo-length;
				$('#txtLengthMaxResumo').text(length);
			});

		    $("#checkempregoatual").on("change", function(){
		        var check = $("#checkempregoatual").prop("checked");
		        if(check) {
		            $('#mestermino').prop('disabled',true);
		            $('#anotermino').prop('disabled',true);
		            $("#checkempregoatual").val('1');
		        } else {
		            $('#mestermino').prop('disabled',false);
		            $('#anotermino').prop('disabled',false);
		            $("#checkempregoatual").val('0');
		        }
		    });

		</script>