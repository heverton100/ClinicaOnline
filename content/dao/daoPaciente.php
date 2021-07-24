<?php

require_once 'C:/xampp/htdocs/clinica/content/conf/ConexaoOO.php';

class daoPaciente{

	public function retornaPaciente($id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$query = "SELECT PAC.nome AS NOMEP,
			PAC.genero AS GENERO,
			PAC.url_foto AS FOTO,
			PAC.data_nasc AS DATANASC,
            PAC.celular AS CEL,
            PAC.telefone AS FONE,
			ENDE.cep AS CEP,
			ENDE.logradouro AS LOGRADOURO,
			ENDE.numero AS NUME,
			ENDE.complemento AS COMPL,
			ENDE.bairro AS BAIRRO,
			ENDE.ID_ESTADO,
			EST.nome AS ESTADO,
			ENDE.ID_MUNICIPIO AS ID_CIDADE,
			MUN.nome AS CIDADE,
			ENDE.ID_PAIS,
			PAI.nome AS PAIS
			FROM tbl_paciente PAC
			LEFT JOIN tbl_endereco ENDE ON ENDE.ID_ENDERECO = PAC.ID_ENDERECO 
			AND ENDE.ID_PACIENTE = PAC.ID_PACIENTE
			LEFT JOIN sis_estados EST ON EST.ID_IBGE = ENDE.ID_ESTADO
			LEFT JOIN sis_municipios MUN ON MUN.ID_IBGE = ENDE.ID_MUNICIPIO
			LEFT JOIN sis_paises PAI ON PAI.ID_PAIS = ENDE.ID_PAIS
			WHERE PAC.ID_PACIENTE = $id";
		$result = mysqli_query($conn, $query);
		$resultado = mysqli_fetch_assoc($result);

		return $resultado;
	}


	public function atualizaInfoBasica($nome,$datanasc,$sexo,$telefone,$celular,$id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$datanasc2 = explode('/', $datanasc);
		$datanasc = $datanasc2[2]."-".$datanasc2[1]."-".$datanasc2[0];

		$update = "UPDATE tbl_paciente
			SET
			nome = '$nome',
			data_nasc = '$datanasc',
			genero = $sexo,
			celular = '$celular',
			telefone = '$telefone'
			WHERE ID_PACIENTE = $id";

		if (!mysqli_query($conn, $update)) {
			echo "Error: " . $update . "<br>" . mysqli_error($conn);
			exit();
		}

		return "ok";
	}


	public function atualizaEndereco($logradouro,$numero,$estado,$cidade,$bairro,$complemento,$pais,$cep,$id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$buscaID = "SELECT * FROM tbl_endereco WHERE ID_PACIENTE = $id LIMIT 1";
		$resultado_usuario = mysqli_query($conn, $buscaID);
		$resultado = mysqli_fetch_assoc($resultado_usuario);
    
    	if(isset($resultado)){

			$update = "UPDATE tbl_endereco
				SET
				logradouro = '$logradouro',
				numero = '$numero',
				complemento = '$complemento',
				bairro = '$bairro',
				cep = $cep,
				ID_MUNICIPIO = $cidade,
				ID_ESTADO = $estado,
				ID_PAIS = $pais
				WHERE ID_PACIENTE = $id";

			if (!mysqli_query($conn, $update)) {
				echo "Error: " . $update . "<br>" . mysqli_error($conn);
				exit();
			}

    	}else{

			$insert = "INSERT INTO tbl_endereco
				(logradouro,
				numero,
				complemento,
				bairro,
				cep,
				ID_MUNICIPIO,
				ID_ESTADO,
				ID_PAIS,
				ID_PACIENTE)
				VALUES
				('$logradouro',
				'$numero',
				'$complemento',
				'$bairro',
				$cep,
				$cidade,
				$estado,
				$pais,
				$id)";

			if (!mysqli_query($conn, $insert)) {
				echo "Error: " . $insert . "<br>" . mysqli_error($conn);
				exit();
			}

			$buscaID = "SELECT * FROM tbl_endereco WHERE ID_PACIENTE = $id LIMIT 1";
			$resultado_usuario = mysqli_query($conn, $buscaID);
			$resultado = mysqli_fetch_assoc($resultado_usuario);

			$idendereco = $resultado['ID_ENDERECO'];

			$update = "UPDATE tbl_paciente
				SET
				ID_ENDERECO = $idendereco
				WHERE ID_PACIENTE = $id";

			if (!mysqli_query($conn, $update)) {
				echo "Error: " . $update . "<br>" . mysqli_error($conn);
				exit();
			}

    	}

		return "ok";
	}

	public function atualizaImage($image,$id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$update = "UPDATE tbl_paciente
			SET
			url_foto = '$image'
			WHERE ID_PACIENTE = $id";

		if (!mysqli_query($conn, $update)) {
			echo "Error: " . $update . "<br>" . mysqli_error($conn);
			exit();
		}

		return "ok";
	}

	public function retornaAgendamentos($id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$query = "SELECT AGE.*, PRO.nome AS NOMEPRO, PRO.url_foto AS FOTOPRO FROM tbl_agendamento AGE INNER JOIN tbl_profissional PRO ON PRO.ID_PROFISSIONAL = AGE.ID_PROFISSIONAL WHERE AGE.ID_PACIENTE = $id";
		$result = mysqli_query($conn, $query);

		return $result;
	}


}

?>