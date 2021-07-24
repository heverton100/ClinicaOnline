<?php

require_once 'C:/xampp/htdocs/clinica/content/conf/ConexaoOO.php';

class daoSchedule{

	public function gravaTimeSlot($ini,$fim,$id,$diasemana){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$insert = "INSERT INTO tbl_horarios
			(hora_ini,
			hora_fim,
			dia_semana,
			ID_PROFISSIONAL)
			VALUES
			('$ini',
			'$fim',
			$diasemana,
			$id)";

		if (!mysqli_query($conn, $insert)) {
			echo "Error: " . $insert . "<br>" . mysqli_error($conn);
			exit();
		}

		return "ok";
	}

	public function retornaHorariosDia($id,$dia){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$query = "SELECT * FROM tbl_horarios WHERE dia_semana = $dia AND ID_PROFISSIONAL = $id";
		$result = mysqli_query($conn, $query);

		return $result;
	}

	public function deletaTimeSlot($id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$delete = "DELETE FROM tbl_horarios WHERE ID_HORARIO = $id";

		if (!mysqli_query($conn, $delete)) {
			echo "Error: " . $delete . "<br>" . mysqli_error($conn);
			exit();
		}

		return "ok";
	}

	public function retornaHorariosProfile($id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$query = "SELECT CASE 
					WHEN dia_semana = 1 THEN 'Domingo' 
					WHEN dia_semana = 2 THEN 'Segunda' 
					WHEN dia_semana = 3 THEN 'Terça' 
					WHEN dia_semana = 4 THEN 'Quarta' 
					WHEN dia_semana = 5 THEN 'Quinta' 
					WHEN dia_semana = 6 THEN 'Sexta'
					WHEN dia_semana = 7 THEN 'Sábado' 
					END AS DIASEMANA, GROUP_CONCAT( CONCAT(SUBSTRING(hora_ini, 1,5),' - ',SUBSTRING(hora_fim, 1,5)) SEPARATOR ' | ') AS HORARIO FROM db_clinic.tbl_horarios WHERE ID_PROFISSIONAL = $id
					GROUP BY DIASEMANA
					ORDER BY dia_semana";
		$result = mysqli_query($conn, $query);

		return $result;
	}

	public function retornaHorarioRealTime($id,$dia){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$query = "SELECT * FROM db_clinic.tbl_horarios WHERE ID_PROFISSIONAL = $id AND dia_semana = $dia
					AND now() BETWEEN hora_ini and hora_fim";
		$result = mysqli_query($conn, $query);

		return $result;
	}


}

?>