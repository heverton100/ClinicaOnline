<?php

require_once 'C:/xampp/htdocs/clinica/conf/ConexaoOO.php';

class daoSistema{

	public function retorna_cidades($searchTerm,$estado){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		if(!isset($searchTerm)){ 
			$query = "SELECT ID_IBGE as id,nome as text FROM sis_municipios WHERE ID_ESTADO_IBGE = $estado";
		}else{ 
			$query = "SELECT ID_IBGE as id,nome as text FROM sis_municipios WHERE ID_ESTADO_IBGE = $estado AND nome like '%$searchTerm%'";
		}

		$result = mysqli_query($conn, $query);

		return $result;
	}

	public function retorna_estados($searchTerm){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		if(!isset($searchTerm)){ 
			$query = "SELECT ID_IBGE as id,nome as text FROM sis_estados";
		}else{
			$query = "SELECT ID_IBGE as id,nome as text FROM sis_estados WHERE nome like '%$searchTerm%'";
		} 

		$result = mysqli_query($conn, $query);

		return $result;
	}

	public function retorna_paises($id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		if(!isset($searchTerm)){ 
			$query = "SELECT ID_PAIS as id,nome as text FROM sis_paises";
		}else{
			$query = "SELECT ID_PAIS as id,nome as text FROM sis_paises WHERE nome like '%$searchTerm%'";
		} 

		$result = mysqli_query($conn, $query);

		return $result;
	}

	public function retorna_cursos($id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		if(!isset($searchTerm)){ 
			$query = "SELECT ID_CURSO as id,nome_curso as text FROM sis_curso";
		}else{
			$query = "SELECT ID_CURSO as id,nome_curso as text FROM sis_curso WHERE nome_curso like '%$searchTerm%'";
		} 

		$result = mysqli_query($conn, $query);

		return $result;
	}

	public function retorna_instituicoes($id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		if(!isset($searchTerm)){ 
			$query = "SELECT ID_INSTITUICAO as id,nome_instituicao as text FROM sis_instituicao";
		}else{
			$query = "SELECT ID_INSTITUICAO as id,nome_instituicao as text FROM sis_instituicao WHERE nome_instituicao like '%$searchTerm%'";
		} 

		$result = mysqli_query($conn, $query);

		return $result;
	}

	public function retorna_situacoes($id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		if(!isset($searchTerm)){ 
			$query = "SELECT ID_SITUACAO as id,descricao as text FROM sis_situacao_curso";
		}else{
			$query = "SELECT ID_SITUACAO as id,descricao as text FROM sis_situacao_curso WHERE descricao like '%$searchTerm%'";
		} 

		$result = mysqli_query($conn, $query);

		return $result;
	}

	public function retorna_niveis($id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		if(!isset($searchTerm)){ 
			$query = "SELECT ID_NIVEL as id,descricao as text FROM sis_nivel_curso";
		}else{
			$query = "SELECT ID_NIVEL as id,descricao as text FROM sis_nivel_curso WHERE descricao like '%$searchTerm%'";
		} 

		$result = mysqli_query($conn, $query);

		return $result;
	}

	public function retorna_especialidades($id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		if(!isset($searchTerm)){ 
			$query = "SELECT ID_ESPECIALIDADE as id,nome_especialidade as text FROM tbl_especialidade";
		}else{
			$query = "SELECT ID_ESPECIALIDADE as id,nome_especialidade as text FROM tbl_especialidade WHERE nome_especialidade like '%$searchTerm%'";
		} 

		$result = mysqli_query($conn, $query);

		return $result;
	}

}

?>