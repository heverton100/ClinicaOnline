<?php

session_start();

include("../conf/conexao.php");

switch($_GET["function"]) {

	case 'retorna_cidades':

		$estado = $_GET["estado"];

		if(!isset($_POST['searchTerm'])){ 
			$query = "SELECT ID_IBGE as id,nome as text FROM sis_municipios WHERE ID_ESTADO_IBGE = $estado";
		}else{ 
			$searchTerm = $_POST['searchTerm']; 
			$query = "SELECT ID_IBGE as id,nome as text FROM sis_municipios WHERE ID_ESTADO_IBGE = $estado AND nome like '%$searchTerm%'";
		} 

		$result = mysqli_query($conn, $query);

		while($resultado = mysqli_fetch_assoc($result)){
        	$vetor[] = array_map('utf8_encode', $resultado);
    	}    

		echo json_encode($vetor);


		break;
	
	case 'retorna_estados':


		if(!isset($_POST['searchTerm'])){ 
			$query = "SELECT ID_IBGE as id,nome as text FROM sis_estados";
		}else{ 
			$searchTerm = $_POST['searchTerm']; 
			$query = "SELECT ID_IBGE as id,nome as text FROM sis_estados WHERE nome like '%$searchTerm%'";
		} 

		$result = mysqli_query($conn, $query);

		while($resultado = mysqli_fetch_assoc($result)){
        	$vetor[] = array_map('utf8_encode', $resultado);
    	}    

		echo json_encode($vetor);
	
		break;


	case 'retorna_paises':

		if(!isset($_POST['searchTerm'])){ 
			$query = "SELECT ID_PAIS as id,nome as text FROM sis_paises";
		}else{ 
			$searchTerm = $_POST['searchTerm']; 
			$query = "SELECT ID_PAIS as id,nome as text FROM sis_paises WHERE nome like '%$searchTerm%'";
		} 

		$result = mysqli_query($conn, $query);

		while($resultado = mysqli_fetch_assoc($result)){
        	$vetor[] = array_map('utf8_encode', $resultado);
    	}    

		echo json_encode($vetor);

		break;

	case 'retorna_especialidades':


		if(!isset($_POST['searchTerm'])){ 
			$query = "SELECT ID_ESPECIALIDADE as id,nome_especialidade as text FROM tbl_especialidade";
		}else{ 
			$searchTerm = $_POST['searchTerm']; 
			$query = "SELECT ID_ESPECIALIDADE as id,nome_especialidade as text FROM tbl_especialidade WHERE nome_especialidade like '%$searchTerm%'";
		} 

		$result = mysqli_query($conn, $query);

		while($resultado = mysqli_fetch_assoc($result)){
        	$vetor[] = array_map('utf8_encode', $resultado);
    	}    

		echo json_encode($vetor);

		break;

	case 'retorna_cursos':

		if(!isset($_POST['searchTerm'])){ 
			$query = "SELECT ID_CURSO as id,nome_curso as text FROM sis_curso";
		}else{ 
			$searchTerm = $_POST['searchTerm']; 
			$query = "SELECT ID_CURSO as id,nome_curso as text FROM sis_curso WHERE nome_curso like '%$searchTerm%'";
		} 

		$result = mysqli_query($conn, $query);

		while($resultado = mysqli_fetch_assoc($result)){
        	$vetor[] = array_map('utf8_encode', $resultado);
    	}    

		echo json_encode($vetor);

		break;

	case 'retorna_instituicoes':

		if(!isset($_POST['searchTerm'])){ 
			$query = "SELECT ID_INSTITUICAO as id,nome_instituicao as text FROM sis_instituicao";
		}else{ 
			$searchTerm = $_POST['searchTerm']; 
			$query = "SELECT ID_INSTITUICAO as id,nome_instituicao as text FROM sis_instituicao WHERE nome_instituicao like '%$searchTerm%'";
		} 

		$result = mysqli_query($conn, $query);

		while($resultado = mysqli_fetch_assoc($result)){
        	$vetor[] = array_map('utf8_encode', $resultado);
    	}    

		echo json_encode($vetor);

		break;

	case 'retorna_niveis':

		if(!isset($_POST['searchTerm'])){ 
			$query = "SELECT ID_NIVEL as id,descricao as text FROM sis_nivel_curso";
		}else{ 
			$searchTerm = $_POST['searchTerm']; 
			$query = "SELECT ID_NIVEL as id,descricao as text FROM sis_nivel_curso WHERE descricao like '%$searchTerm%'";
		} 

		$result = mysqli_query($conn, $query);

		while($resultado = mysqli_fetch_assoc($result)){
        	$vetor[] = array_map('utf8_encode', $resultado);
    	}    

		echo json_encode($vetor);

		break;

	case 'retorna_situacoes':

		if(!isset($_POST['searchTerm'])){ 
			$query = "SELECT ID_SITUACAO as id,descricao as text FROM sis_situacao_curso";
		}else{ 
			$searchTerm = $_POST['searchTerm']; 
			$query = "SELECT ID_SITUACAO as id,descricao as text FROM sis_situacao_curso WHERE descricao like '%$searchTerm%'";
		} 

		$result = mysqli_query($conn, $query);

		while($resultado = mysqli_fetch_assoc($result)){
        	$vetor[] = array_map('utf8_encode', $resultado);
    	}    

		echo json_encode($vetor);

		break;

	case 'updatesenha':

		$id = $_POST['txt_idprofissional'];

		$senhaantiga = $_POST['senhaantiga'];
		$novasenha = md5($_POST['senha1']);

		$query = "SELECT USU.senha, USU.ID_USUARIO FROM tbl_profissional PRO 
				INNER JOIN sis_usuario USU ON USU.ID_USUARIO = PRO.ID_USUARIO
				WHERE PRO.ID_PROFISSIONAL = $id;";
		$result = mysqli_query($conn, $query);
		$resultado = mysqli_fetch_assoc($result);


		if($resultado['senha'] == md5($senhaantiga)){ 

			$update = "UPDATE sis_usuario
				SET
				senha = '$novasenha',
				date_update = 'NOW()'
				WHERE ID_USUARIO = ".$resultado['ID_USUARIO'];

			if (!mysqli_query($conn, $update)) {
				echo "Error: " . $update . "<br>" . mysqli_error($conn);
				exit();
			}

			echo "Senha atualizada com sucesso!";

		}else{ 
			echo "A senha antiga não confere com a cadastrada no sistema!";
		}

		break;

	case 'updatesenhapaciente':


		$id = $_POST['txt_idpaciente'];

		$senhaantiga = $_POST['senhaantiga'];
		$novasenha = md5($_POST['senha1']);

		$query = "SELECT USU.senha, USU.ID_USUARIO FROM tbl_paciente PAC 
				INNER JOIN sis_usuario USU ON USU.ID_USUARIO = PAC.ID_USUARIO
				WHERE PAC.ID_PACIENTE = $id;";
		$result = mysqli_query($conn, $query);
		$resultado = mysqli_fetch_assoc($result);


		if($resultado['senha'] == md5($senhaantiga)){ 

			$update = "UPDATE sis_usuario
				SET
				senha = '$novasenha',
				date_update = 'NOW()'
				WHERE ID_USUARIO = ".$resultado['ID_USUARIO'];

			if (!mysqli_query($conn, $update)) {
				echo "Error: " . $update . "<br>" . mysqli_error($conn);
				exit();
			}

			echo "Senha atualizada com sucesso!";

		}else{ 
			echo "A senha antiga não confere com a cadastrada no sistema!";
		}

		break;

}

?>