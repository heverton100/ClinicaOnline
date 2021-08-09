<?php

require_once 'C:/xampp/htdocs/clinica/conf/ConexaoOO.php';

class daoCheckout{

	public function retorna_agendamentos($idProf,$idPac){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$query = "SELECT * FROM tbl_agendamento WHERE ID_PACIENTE = $idPac AND ID_PROFISSIONAL = $idProf AND confirmado = 0";
		$result = mysqli_query($conn, $query);

		return $result;
	}

	public function retornaValorTotal($agendamentos){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$query = "SELECT SUM(valor) AS SOMA FROM tbl_agendamento WHERE ID_AGENDAMENTO IN($agendamentos)";
		$result = mysqli_query($conn, $query);

		return $result;
	}



}

?>