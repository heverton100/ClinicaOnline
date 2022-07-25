<?php

session_start();

require '../dao/daoSistema.php';

$teste = new daoSistema;

switch($_GET["function"]) {

	case 'retorna_cidades':

		$estado = $_GET["estado"];

		if (isset($_POST['searchTerm'])) {
			$searchTerm = $_POST['searchTerm'];
		}else{
			$searchTerm = '';
		}
		
		$result = $teste->retorna_cidades($searchTerm,$estado);

		while($resultado = mysqli_fetch_assoc($result)){
        	$vetor[] = array_map('utf8_encode', $resultado);
    	}    

		echo json_encode($vetor);

		break;
	
	case 'retorna_estados':

		if (isset($_POST['searchTerm'])) {
			$searchTerm = $_POST['searchTerm'];
		}else{
			$searchTerm = '';
		}

		$result = $teste->retorna_estados($searchTerm);

		while($resultado = mysqli_fetch_assoc($result)){
        	$vetor[] = array_map('utf8_encode', $resultado);
    	}    

		echo json_encode($vetor);
	
		break;


	case 'retorna_paises':

		if (isset($_POST['searchTerm'])) {
			$searchTerm = $_POST['searchTerm'];
		}else{
			$searchTerm = '';
		}

		$result = $teste->retorna_paises($searchTerm);

		while($resultado = mysqli_fetch_assoc($result)){
        	$vetor[] = array_map('utf8_encode', $resultado);
    	}    

		echo json_encode($vetor);

		break;

	case 'retorna_cursos':

		if (isset($_POST['searchTerm'])) {
			$searchTerm = $_POST['searchTerm'];
		}else{
			$searchTerm = '';
		}

		$result = $teste->retorna_cursos($searchTerm);

		while($resultado = mysqli_fetch_assoc($result)){
        	$vetor[] = array_map('utf8_encode', $resultado);
    	}    

		echo json_encode($vetor);

		break;

	case 'retorna_instituicoes':

		if (isset($_POST['searchTerm'])) {
			$searchTerm = $_POST['searchTerm'];
		}else{
			$searchTerm = '';
		}

		$result = $teste->retorna_instituicoes($searchTerm);

		while($resultado = mysqli_fetch_assoc($result)){
        	$vetor[] = array_map('utf8_encode', $resultado);
    	}    

		echo json_encode($vetor);

		break;

	case 'retorna_situacoes':

		if (isset($_POST['searchTerm'])) {
			$searchTerm = $_POST['searchTerm'];
		}else{
			$searchTerm = '';
		}

		$result = $teste->retorna_situacoes($searchTerm);

		while($resultado = mysqli_fetch_assoc($result)){
        	$vetor[] = array_map('utf8_encode', $resultado);
    	}    

		echo json_encode($vetor);

		break;

	case 'retorna_niveis':

		if (isset($_POST['searchTerm'])) {
			$searchTerm = $_POST['searchTerm'];
		}else{
			$searchTerm = '';
		}

		$result = $teste->retorna_niveis($searchTerm);

		while($resultado = mysqli_fetch_assoc($result)){
        	$vetor[] = array_map('utf8_encode', $resultado);
    	}    

		echo json_encode($vetor);

		break;

	case 'retorna_especialidades':

		if (isset($_POST['searchTerm'])) {
			$searchTerm = $_POST['searchTerm'];
		}else{
			$searchTerm = '';
		}

		$result = $teste->retorna_especialidades($searchTerm);

		while($resultado = mysqli_fetch_assoc($result)){
        	$vetor[] = array_map('utf8_encode', $resultado);
    	}    

		echo json_encode($vetor);

		break;

}

?>