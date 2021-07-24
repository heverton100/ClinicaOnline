<?php

session_start();

require '../dao/daoProfissional.php';

$teste = new daoProfissional;

switch($_GET["form"]) {

	case 'informacoesbasicas':

		$nome = $_POST['txt_nome'];
		$datanasc = $_POST['txt_datanasc'];
		$sexo = $_POST['txt_sexo'];
		$id = $_POST['txt_idprofissional'];

		if(isset($_FILES["file"]["name"])){ 

			$filepath = "../../content/images/" . $_FILES["file"]["name"];

			if(move_uploaded_file($_FILES["file"]["tmp_name"], $filepath)){
				$_SESSION['URLFOTO'] = $filepath;
			}else {
				echo "Error !!";
			}

			$teste->atualizaInfoBasicaImage($nome,$datanasc,$sexo,$id,$filepath); 

		}else{
			$teste->atualizaInfoBasica($nome,$datanasc,$sexo,$id); 
		}
		


		break;

	case 'resumo':

		$resumo = $_POST['txt_resumo'];
		$id = $_POST['txt_idprofissional'];

		$teste->atualizaResumo($resumo,$id);

		break;

	case 'endereco':

		$logradouro = $_POST['txt_logradouro'];
		$numero = $_POST['txt_numero'];
		$estado = $_POST['txt_estado'];
		$cidade = $_POST['txt_cidade'];
		$bairro = $_POST['txt_bairro'];
		$complemento = $_POST['txt_complemento'];
		$pais = $_POST['txt_pais'];
		$cep = $_POST['txt_cep'];
		$id = $_POST['txt_idprofissional'];

		$teste->atualizaEndereco($logradouro,$numero,$estado,$cidade,$bairro,$complemento,$pais,$cep,$id);

		break;

	case 'valores':

		$valor_sessao = $_POST['txt_valor_sessao'];
		$periodo = $_POST['txt_periodo'];
		$id = $_POST['txt_idprofissional'];

		$teste->atualizaValores($valor_sessao,$periodo,$id);

		break;

	case 'especialidades':

		$id_espec = $_POST['id_espec'];
		$id = $_POST['id_prof'];

		$teste->atualizaEspecialidades($id_espec,$id);

		break;

	case 'retorna_especialidades':

		$id = $_GET['id'];

		$result = $teste->retornaEspecialidades($id);
		
		$options = '';

		while($resultado = mysqli_fetch_assoc($result)){
			$options .= '<option value="'.$resultado['id'].'" selected="selected">'.$resultado['text'].'</option>';
    }    

		echo $options;

		break;

	case 'nova_formacao':

		$curso = $_POST['txt_curso'];
		$instituicao = $_POST['txt_instituicao'];
		$situacao = $_POST['txt_situacao'];
		$nivel = $_POST['txt_nivel'];
		$conclusao = $_POST['txt_conclusao'];
		$id = $_POST['txt_idprofissional'];

		$teste->novaFormacao($curso,$instituicao,$situacao,$nivel,$conclusao,$id);

		break;

	case 'edit_formacao':

		$id = $_POST['txt_idformacao'];
		$curso = $_POST['txt_curso'.$id];
		$instituicao = $_POST['txt_instituicao'.$id];
		$situacao = $_POST['txt_situacao'.$id];
		$nivel = $_POST['txt_nivel'.$id];
		$conclusao = $_POST['txt_conclusao'.$id];

		$teste->editarFormacao($curso,$instituicao,$situacao,$nivel,$conclusao,$id);

		break;

	case 'delete_formacao':

		$id = $_POST['txt_idformacao'];

		$teste->deletarFormacao($id);

		break;

	case 'retorna_formacoes':

		$id = $_GET['id'];

		$result = $teste->retornaFormacoes($id);

		$table = '';

		while($resultado = mysqli_fetch_assoc($result)){

			$table .= '<tr>';
			$table .= '<td>'.utf8_encode($resultado['nome_curso']).'</td>';
			$table .= '<td>'.utf8_encode($resultado['nome_instituicao']).'</td>';
			$table .= '<td>'.utf8_encode($resultado['descricao']).'</td>';
			$table .= '<td>'.'<div style="display: inline-flex;">

			<a href="#" data-toggle="modal" data-target="#md_edit_formacao'.$resultado['ID_FORMACAO'].'" class="btn btn-info" style="margin-right: 10px;align-items: center;display: flex;"><i class="far fa-edit"></i></a>
			<a href="#" onclick="$(\'#md_delete_formacao'.$resultado['ID_FORMACAO'].'\').modal(\'show\')" data-toggle="modal" data-target="#md_delete_formacao'.$resultado['ID_FORMACAO'].'" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>

			</div>';

			$table .= modalformacaoeditar($resultado['ID_FORMACAO'],$teste);
			$table .= '</td>';
			$table .= '</tr>';

    }    

		echo $table;

		break;

	case 'nova_experiencia':

		$cargo = $_POST['txt_cargo'];
		$empresa = $_POST['txt_empresa'];
		$atividades = $_POST['txt_atividades'];
		$id = $_POST['txt_idprofissional'];
		$dataini = $_POST['mesinicio']."/".$_POST['anoinicio'];
		$datafim = $_POST['mestermino']."/".$_POST['anotermino'];

		if ($_POST['checkempregoatual'] == '1') {
			$datafim = "Atual";
		}

		$teste->novaExperiencia($cargo,$empresa,$atividades,$id,$dataini,$datafim);

		break;

	case 'edit_experiencia':

		$id = $_POST['txt_idexperiencia'];
		$cargo = $_POST['txt_cargo'.$id];
		$empresa = $_POST['txt_empresa'.$id];
		$atividades = $_POST['txt_atividades'.$id];
		$dataini = $_POST['mesinicio'.$id]."/".$_POST['anoinicio'.$id];
		$datafim = $_POST['mestermino'.$id]."/".$_POST['anotermino'.$id];

		if ($_POST['checkempregoatual'.$id] == '1') {
			$datafim = "Atual";
		}

		$teste->editarExperiencia($cargo,$empresa,$atividades,$id,$dataini,$datafim);

		break;

	case 'delete_experiencia':

		$id = $_POST['txt_idexperiencia'];

		$teste->deletarExperiencia($id);

		break;

	case 'retorna_experiencias':

		$id = $_GET['id'];

		$result = $teste->retornaExperiencias($id);

		$table = '';

		while($resultado = mysqli_fetch_assoc($result)){

			$table .= '<tr>';
			$table .= '<td>'.utf8_encode($resultado['cargo']).'</td>';
			$table .= '<td>'.utf8_encode($resultado['empresa']).'</td>';
			$table .= '<td>'.$resultado['atividades'].'</td>';
			$table .= '<td>'.'<div style="display: inline-flex;">

			<a href="#" data-toggle="modal" data-target="#md_edit_experiencia'.$resultado['ID_EXPERIENCIA'].'" class="btn btn-info" style="margin-right: 10px;align-items: center;display: flex;"><i class="far fa-edit"></i></a>
			<a href="#" onclick="$(\'#md_delete_experiencia'.$resultado['ID_EXPERIENCIA'].'\').modal(\'show\')" data-toggle="modal" data-target="#md_delete_experiencia'.$resultado['ID_EXPERIENCIA'].'" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>

			</div>';

			$table .= modalexperienciaeditar($resultado['ID_EXPERIENCIA'],$teste);
			$table .= '</td>';
			$table .= '</tr>';

		}

		echo $table;

		break;

	case 'retorna_profissionais':

		$result = $teste->retornaProfissionais();

		$table = '';

		while($resultado = mysqli_fetch_assoc($result)){

			$urlfoto = str_replace('../','',$resultado['FOTO']);

			$table .= 	'<div class="profile-widget">';
			$table .= 		'<div class="doc-img">';
			$table .=			'<a href="doctor-profile.php?id='.$resultado['ID'].'">';
			$table .=			'<img class="img-fluid" alt="User Image" src="'.$urlfoto.'">';
			$table .=			'</a>';
			$table .=		'</div>';
			$table .=		'<div class="pro-content">';
			$table .=			'<h3 class="title">';
			$table .=				'<a href="doctor-profile.php?id='.$resultado['ID'].'">'.$resultado['NOME'].'</a>';
			$table .=				'<i class="fas fa-check-circle verified"></i>';
			$table .=			'</h3>';
			$table .=			'<p class="speciality">'.$resultado['ESPECIALIDADES'].'</p>';
			$table .=			'<ul class="available-info">';
			$table .=				'<li>';
			$table .=					'<i class="fas fa-map-marker-alt"></i> '.utf8_encode($resultado['CIDADE']).', '.utf8_encode($resultado['ESTADO']);
			$table .=				'</li>';
			$table .=				'<li>';
			$table .=					'<i class="far fa-money-bill-alt"></i> R$'.$resultado['VALORSESSAO'].' / '.$resultado['DURACAOSESSAO'].'min ';
			$table .=					'<i class="fas fa-info-circle" data-toggle="tooltip" title="Duração"></i>';
			$table .=				'</li>';
			$table .=			'</ul>';
			$table .=			'<div class="row row-sm">';
			$table .=				'<div class="col-6">';
			$table .=					'<a href="doctor-profile.php?id='.$resultado['ID'].'" class="btn view-btn">Ver Perfil</a>';
			$table .=				'</div>';
			$table .=				'<div class="col-6">';
			$table .=					'<a href="booking.php?id='.$resultado['ID'].'" class="btn book-btn">Agendar</a>';
			$table .=				'</div>';
			$table .=			'</div>';
			$table .=		'</div>';
			$table .=	'</div>';

    	} 

		echo $table;

		break;

	case 'retorna_formacoes_profile':

		$id = $_GET['id'];

		$result = $teste->retornaFormacoes($id);

		$table = '';

		while($resultado = mysqli_fetch_assoc($result)){

			$table .= '<li>';
    	$table .= '<div class="experience-user">';
    	$table .= '<div class="before-circle"></div>';
    	$table .= '</div>';
    	$table .= '<div class="experience-content">';
    	$table .= '<div class="timeline-content">';

			$table .= '<a href="#/" class="name">'.utf8_encode($resultado['nome_instituicao']).'</a>';
    	$table .= '<div>'.utf8_encode($resultado['descricao'])." / ".utf8_encode($resultado['nome_curso']).'</div>';
    	//$table .= '<span class="time">1998 - 2003</span>';
    	$table .= '</div>';
    	$table .= '</div>';
      $table .= '</li>';
		}

		echo $table;

		break;

	case 'retorna_experiencias_profile':

		$id = $_GET['id'];

		$result = $teste->retornaExperiencias($id);

		$table = '';

		while($resultado = mysqli_fetch_assoc($result)){

			$table .= '<li>';
    	$table .= '<div class="experience-user">';
    	$table .= '<div class="before-circle"></div>';
    	$table .= '</div>';
    	$table .= '<div class="experience-content">';
    	$table .= '<div class="timeline-content">';

			$table .= '<a href="#/" class="name">'.utf8_encode($resultado['empresa'])." / ".utf8_encode($resultado['cargo']).'</a>';
    	$table .= '<span class="time">'.$resultado['data_ini']." - ".$resultado['data_fim'].'</span>';
    	$table .= '<span class="time">'.$resultado['atividades'].'</span>';
    	$table .= '</div>';
    	$table .= '</div>';
      $table .= '</li>';

    }    

		echo $table;

		break;

	case 'retorna_especialidades_profile':

		$id = $_GET['id'];

		$result = $teste->retornaEspecialidades($id);
		
		$options = '';

		while($resultado = mysqli_fetch_assoc($result)){
        	$options .= '<li>'.$resultado['text'].'</li>';
    }    

		echo $options;

		break;
	
}












function modalformacaoeditar($value,$teste){

	$modal = "";

	$result = $teste->retornaFormacao($value);
	$resultado = mysqli_fetch_assoc($result);

	$modal = "<div class='modal fade bd-example-modal-lg' id='md_edit_formacao".$value."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel".$value."' aria-hidden='true'>
			  <div class='modal-dialog modal-lg' role='document'>
			    <div class='modal-content'>
			      <form id='editformacao".$value."' method='post' action='../../content/controllers/profissionalController.php?form=edit_formacao'>
			        <div class='modal-header'>
			          <h5 class='modal-title' id='exampleModalLabel".$value."'>Editar Formação</h5>
			          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
			            <span aria-hidden='true'>&times;</span>
			          </button>
			        </div>
			        <div class='modal-body'>
			          <div class='row form-row'>

			            <div class='col-md-6'>
			              <div class='form-group'>
			                <select class='txt_curso' name='txt_curso".$value."' id='txt_curso".$value."' style='width: 100%;' required>
			                	<option value=".$resultado['ID_CURSO']." selected>".$resultado['NOMECURSO']."</option>
			                </select>
			              </div>
			            </div>
			            <div class='col-md-6'>
			              <div class='form-group'>
			                <select class='txt_instituicao' name='txt_instituicao".$value."' id='txt_instituicao".$value."' style='width: 100%;' required>
								<option value=".$resultado['ID_INSTITUICAO']." selected>".$resultado['NOMEINSTITUICAO']."</option>
			                </select>
			              </div>
			            </div>
			            <div class='col-md-4'>
			              <div class='form-group'>
			                <select class='txt_situacao' name='txt_situacao".$value."' id='txt_situacao".$value."' style='width: 100%;' required>
								<option value=".$resultado['ID_SITUACAO_FORMACAO']." selected>".utf8_encode($resultado['SITUACAO'])."</option>
			                </select>
			              </div>
			            </div>
			            <div class='col-md-4'>
			              <div class='form-group'>
			                <select class='txt_nivel' name='txt_nivel".$value."' id='txt_nivel".$value."' style='width: 100%;' required>
								<option value=".$resultado['ID_NIVEL_FORMACAO']." selected>".utf8_encode($resultado['NIVEL'])."</option>
			                </select>
			              </div>
			            </div>
			            <div class='col-md-4'>
			              <div class='form-group'>
			                <input type='text' placeholder='Conclusão' onfocus='(this.type=".'"date"'.")' class='form-control' value=".$resultado['data_conclusao']." name='txt_conclusao".$value."' id='txt_conclusao".$value."'>
			              </div>
			            </div>
			            <input type='hidden' value='".$value."' name='txt_idformacao'>
			          </div>
			        </div>
			        <div class='modal-footer'>
			          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
			          <button id='editarformacao".$value."' type='submit' class='btn btn-primary'>Gravar</button>
			        </div>
			      </form> 
			    </div>
			  </div>
			</div>";

	$modal .= "<script>
				$(document).on('submit','#editformacao".$value."',function(event){
		            event.preventDefault();
		            var dados=$(this).serialize();
		            $.ajax({
		                url: '../../content/controllers/profissionalController.php?form=edit_formacao',
		                method: 'post',
		                dataType: 'html',
		                data: dados,
		                success: function(data){
		                    $('#md_edit_formacao".$value."').modal('hide');
		                    setTimeout(function(){
		        				funRetornaFormacoes();
							},1000);
		                }
		            });
	        	});
	        </script>";


	$modal .= "<div class='modal fade' id='md_delete_formacao".$value."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
			  <div class='modal-dialog' role='document'>
			    <div class='modal-content'>
			      <form id='deleteformacao".$value."' method='post' action='../../content/controllers/profissionalController.php?form=delete_formacao'>
			        <div class='modal-header'>
			          <h5 class='modal-title' id='exampleModalLabel'>Excluir Formação</h5>
			          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
			            <span aria-hidden='true'>&times;</span>
			          </button>
			        </div>
			        <div class='modal-body'>
			          <p>Tem certeza que deseja excluir esta formação?</p>
			          <div class='row form-row'>
			            <input type='hidden' value='".$value."' name='txt_idformacao'>
			          </div>
			        </div>
			        <div class='modal-footer'>
			          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
			          <button type='submit' class='btn btn-danger'>Excluir</button>
			        </div>
			      </form> 
			    </div>
			  </div>
			</div>";


	$modal .= "<script>
				$(document).on('submit','#deleteformacao".$value."',function(event){
		            event.preventDefault();
		            var dados=$(this).serialize();
		            $.ajax({
		                url: '../../content/controllers/profissionalController.php?form=delete_formacao',
		                method: 'post',
		                dataType: 'html',
		                data: dados,
		                success: function(data){
		                    $('#md_delete_formacao".$value."').modal('hide');
		                    setTimeout(function(){
		        				funRetornaFormacoes();
							},1000);
		                }
		            });
	        	});
	        </script>";

	return $modal;

}










function modalexperienciaeditar($value,$teste){

	$modal = "";

	$result = $teste->retornaExperiencia($value);
	$resultado = mysqli_fetch_assoc($result);

	$data_ini = explode('/', $resultado['data_ini']);
	$mesini = $data_ini[0];
	$anoini = $data_ini[1];

	if ($resultado['data_fim'] != "Atual") {
		$data_fim = explode('/', $resultado['data_fim']);
		$mesfim = $data_fim[0];
		$anofim = $data_fim[1];

		$check = "";
		$disabled = "";
		$checkvalor = "0";
	}else{
		$mesfim = '';
		$anofim = '';

		$check = "checked";
		$disabled = "disabled";
		$checkvalor = "1";
	}


	$ano_atual = date('Y');
	$qtd = 35;
	$anosini = '';
	$anosfim = '';
	for($i=0; $i <= $qtd; $i++){
		$ano = $ano_atual-$i;
		$ano = sprintf('%02s',$ano);

		if ($anoini == $ano) {
			$anosini .= '<option selected value=\''.$ano.'\'>'.$ano.'</option>';
		}else{
			$anosini .= '<option value=\''.$ano.'\'>'.$ano.'</option>';
		}

		if ($anofim == $ano) {
			$anosfim .= '<option selected value=\''.$ano.'\'>'.$ano.'</option>';
		}else{
			$anosfim .= '<option value=\''.$ano.'\'>'.$ano.'</option>';
		}
	}

	$modal = "<!-- Modal Nova Experiencia-->
			<div class='modal fade bd-example-modal-lg' id='md_edit_experiencia".$value."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
			  <div class='modal-dialog modal-lg' role='document'>
			    <div class='modal-content'>
			      <form id='editexperiencia".$value."' method='post' action='../../content/controllers/profissionalController.php?form=edit_experiencia'>
			        <div class='modal-header'>
			          <h5 class='modal-title' id='exampleModalLabel'>Editar Experiência</h5>
			          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
			            <span aria-hidden='true'>&times;</span>
			          </button>
			        </div>
			        <div class='modal-body'>
			          <div class='row form-row'>

           <div class='col-md-3'>
              <div class='form-group'>
                <label>Data de Início</label>
                <select id='mesinicio".$value."' name='mesinicio".$value."' class='select form-control' >
                  <option value=''>Mês</option>
                  <option value='01'>Janeiro</option>
                  <option value='02'>Fevereiro</option>
                  <option value='03'>Março</option>
                  <option value='04'>Abril</option>
                  <option value='05'>Maio</option>
                  <option value='06'>Junho</option>
                  <option value='07'>Julho</option>
                  <option value='08'>Agosto</option>
                  <option value='09'>Setembro</option>
                  <option value='10'>Outubro</option>
                  <option value='11'>Novembro</option>
                  <option value='12'>Dezembro</option>
                </select>

              </div>
            </div>

            <div class='col-md-3'>
              <div class='form-group'>
                <label style='visibility: hidden;'>-</label>
                <select id='anoinicio".$value."' name='anoinicio".$value."' class='select form-control' >
                  <option value=''>Ano</option>
                  ".$anosini."
                </select>

              </div>
            </div>

            <div class='col-md-3'>
              <div class='form-group'>
                <label>Data de Término</label>
                <select id='mestermino".$value."' name='mestermino".$value."' class='select form-control' ".$disabled.">
                  <option value=''>Mês</option>
                  <option value='01'>Janeiro</option>
                  <option value='02'>Fevereiro</option>
                  <option value='03'>Março</option>
                  <option value='04'>Abril</option>
                  <option value='05'>Maio</option>
                  <option value='06'>Junho</option>
                  <option value='07'>Julho</option>
                  <option value='08'>Agosto</option>
                  <option value='09'>Setembro</option>
                  <option value='10'>Outubro</option>
                  <option value='11'>Novembro</option>
                  <option value='12'>Dezembro</option>
                </select>

              </div>
            </div>

            <div class='col-md-3'>
              <div class='form-group'>
                <label style='visibility: hidden;'>-</label>
                <select id='anotermino".$value."' name='anotermino".$value."' class='select form-control' ".$disabled.">
                  <option value=''>Ano</option>"
                  .$anosfim."
                </select>
                <div class='form-check' style='margin-top: 5px;'>
                  <input type='checkbox' class='form-check-input' value='".$checkvalor."' id='checkempregoatual".$value."' name='checkempregoatual".$value."' ".$check.">
                  <label class='form-check-label' for='checkempregoatual".$value."'>Emprego Atual</label>
                </div>

              </div>
						</div>
			            <div class='col-md-6'>
			              <div class='form-group'>
			                <input type='text' placeholder='Cargo' class='form-control' name='txt_cargo".$value."' value=\"".utf8_encode($resultado['cargo'])."\" id='txt_cargo".$value."'>
			              </div>
			            </div>
			            <div class='col-md-6'>
			              <div class='form-group'>
			                <input type='text' placeholder='Empresa' class='form-control' name='txt_empresa".$value."' value=\"".utf8_encode($resultado['empresa'])."\" id='txt_empresa".$value."'>
			              </div>
			            </div>
			            <div class='col-md-12'>
			              <div class='form-group'>
			                <textarea placeholder='Atividades' class='form-control'  name='txt_atividades".$value."' id='txt_atividades".$value."'>".utf8_encode($resultado['atividades'])."</textarea>
			              </div>
			            </div>
			            <input type='hidden' value='".$value."' name='txt_idexperiencia'>
			          </div>
			        </div>
			        <div class='modal-footer'>
			          <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
			          <button type='submit' class='btn btn-primary'>Gravar</button>
			        </div>
			      </form> 
			    </div>
			  </div>
			</div>";

	$modal .= "<script>
				$(document).on('submit','#editexperiencia".$value."',function(event){
		            event.preventDefault();
		            var dados=$(this).serialize();
		            $.ajax({
		                url: '../../content/controllers/profissionalController.php?form=edit_experiencia',
		                method: 'post',
		                dataType: 'html',
		                data: dados,
		                success: function(data){
		                    $('#md_edit_experiencia".$value."').modal('hide');
		                    setTimeout(function(){
		        				funRetornaExperiencias();
							},1000);
		                }
		            });
	        	});

						$('#mesinicio".$value."').find('option[value=\"".$mesini."\"]').attr('selected','selected');
	        	$('#mestermino".$value."').find('option[value=\"".$mesfim."\"]').attr('selected','selected');

				    $('#checkempregoatual".$value."').on('change', function(){
				        var check = $('#checkempregoatual".$value."').prop('checked');
				        if(check) {
				            $('#mestermino".$value."').prop('disabled',true);
				            $('#anotermino".$value."').prop('disabled',true);
				            $('#checkempregoatual".$value."').val('1');
				        } else {
				            $('#mestermino".$value."').prop('disabled',false);
				            $('#anotermino".$value."').prop('disabled',false);
				            $('#checkempregoatual".$value."').val('0');
				        }
				    });

	        </script>";

	$modal .= "<div class='modal fade' id='md_delete_experiencia".$value."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
	        <div class='modal-dialog' role='document'>
	          <div class='modal-content'>
	            <form id='deleteexperiencia".$value."' method='post' action='../../content/controllers/profissionalController.php?form=delete_experiencia'>
	              <div class='modal-header'>
	                <h5 class='modal-title' id='exampleModalLabel'>Excluir Experiência</h5>
	                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
	                  <span aria-hidden='true'>&times;</span>
	                </button>
	              </div>
	              <div class='modal-body'>
	                <p>Tem certeza que deseja excluir esta experiência?</p>
	                <div class='row form-row'>
	                  <input type='hidden' value='".$value."' name='txt_idexperiencia'>
	                </div>
	              </div>
	              <div class='modal-footer'>
	                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
	                <button type='submit' class='btn btn-danger'>Excluir</button>
	              </div>
	            </form> 
	          </div>
	        </div>
	      </div>";


	$modal .= "<script>
	        $(document).on('submit','#deleteexperiencia".$value."',function(event){
	                event.preventDefault();
	                var dados=$(this).serialize();
	                $.ajax({
	                    url: '../../content/controllers/profissionalController.php?form=delete_experiencia',
	                    method: 'post',
	                    dataType: 'html',
	                    data: dados,
	                    success: function(data){
	                        $('#md_delete_experiencia".$value."').modal('hide');
	                        setTimeout(function(){
		        				funRetornaExperiencias();
	              			},1000);
	                    }
	                });
	            });
	          </script>";


	

	return $modal;

}

?>