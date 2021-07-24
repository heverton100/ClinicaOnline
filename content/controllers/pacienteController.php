<?php

session_start();

require '../dao/daoPaciente.php';

$teste = new daoPaciente;

switch($_GET["form"]) {

	case 'cadpaciente':

		$id = $_POST['txt_idpaciente'];

		$nome = $_POST['txt_nome'];
		$datanasc = $_POST['txt_datanasc'];
		$sexo = $_POST['txt_sexo'];
		$telefone = $_POST['txt_tel'];
		$celular = $_POST['txt_cel'];

		$logradouro = $_POST['txt_logradouro'];
		$numero = $_POST['txt_numero'];
		$estado = $_POST['txt_estado'];
		$cidade = $_POST['txt_cidade'];
		$bairro = $_POST['txt_bairro'];
		$complemento = $_POST['txt_complemento'];
		$pais = $_POST['txt_pais'];
		$cep = $_POST['txt_cep'];

		$teste->atualizaEndereco($logradouro,$numero,$estado,$cidade,$bairro,$complemento,$pais,$cep,$id);

		$teste->atualizaInfoBasica($nome,$datanasc,$sexo,$telefone,$celular,$id);

		break;

	case 'cadpacienteimage':

		$id = $_POST['txt_idpaciente'];

		if(isset($_FILES["file"]["name"])){ 

			$filepath = "../../content/images/" . $_FILES["file"]["name"];

			if(move_uploaded_file($_FILES["file"]["tmp_name"], $filepath)){
				$_SESSION['URLFOTO'] = $filepath;
			}else {
				echo "Error !!";
			}

			$teste->atualizaImage($filepath,$id); 

		}

		break;

	case 'retornaAgendamentos':

		$id = $_POST['id_paciente'];

		$result = $teste->retornaAgendamentos($id); 

		$table = '';

		while($resultado = mysqli_fetch_assoc($result)){

			if ($resultado['confirmado'] == 1) {
				$status = '<span class="badge badge-pill bg-success-light">Confirmado</span>';
			}else{
				$status = '<span class="badge badge-pill bg-warning-light">Pendente</span>';
			}

			$table .= '<tr>';

        	$table .= '<td>';

        	$table .= '		<h2 class="table-avatar">';
			$table .= '		<a href="../../doctor-profile.php?id='.$resultado['ID_PROFISSIONAL'].'" target="_blank" class="avatar avatar-sm mr-2">';
			$table .= '			<img class="avatar-img rounded-circle" src="'.$resultado['FOTOPRO'].'" alt="User Image">'; 
			$table .= '		</a>';
			$table .= '		<a target="_blank" href="../../doctor-profile.php?id='.$resultado['ID_PROFISSIONAL'].'">'.$resultado['NOMEPRO'].'</a>';
			$table .= '		</h2>';
			$table .= '</td>';

			$table .= '<td>'.date("d M Y", strtotime($resultado['data_hora'])).'<span class="d-block text-info">'.date("H:i", strtotime($resultado['data_hora'])).'</span></td>';
      		$table .= '<td>'.date("d M Y", strtotime($resultado['date_create'])).'</td>';
        	$table .= '<td> R$'.$resultado['valor'].'</td>';

        	$table .= '<td>'.$status.'</td>';
        	$table .= '<td class="text-right"></td>';

        	$table .= '<tr>';

    	}

		echo $table;

		break;
	

}