<?php

require_once 'C:/xampp/htdocs/clinica/content/conf/ConexaoOO.php';

class daoProfissional{

	public function atualizaInfoBasicaImage($nome,$datanasc,$sexo,$id,$image){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$datanasc2 = explode('/', $datanasc);
		$datanasc = $datanasc2[2]."-".$datanasc2[1]."-".$datanasc2[0];

		$update = "UPDATE tbl_profissional
			SET
			nome = '$nome',
			data_nasc = '$datanasc',
			genero = $sexo,
			url_foto = '$image'
			WHERE ID_PROFISSIONAL = $id";

		if (!mysqli_query($conn, $update)) {
			echo "Error: " . $update . "<br>" . mysqli_error($conn);
			exit();
		}

		return "ok";
	}

	public function atualizaInfoBasica($nome,$datanasc,$sexo,$id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$datanasc2 = explode('/', $datanasc);
		$datanasc = $datanasc2[2]."-".$datanasc2[1]."-".$datanasc2[0];

		$update = "UPDATE tbl_profissional
			SET
			nome = '$nome',
			data_nasc = '$datanasc',
			genero = $sexo
			WHERE ID_PROFISSIONAL = $id";

		if (!mysqli_query($conn, $update)) {
			echo "Error: " . $update . "<br>" . mysqli_error($conn);
			exit();
		}

		return "ok";
	}

	public function retornaProf($id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$query = "SELECT PRO.nome AS NOMEP,
			PRO.genero AS GENERO,
			PRO.url_foto AS FOTO,
			PRO.resumo AS RESUMO,
			PRO.data_nasc AS DATANASC,
			PRO.valor_sessao AS VALORSESSAO,
			PRO.duracao_sessao AS DURACAOSESSAO,
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
			PAI.nome AS PAIS,
			GROUP_CONCAT(ESP2.nome_especialidade SEPARATOR ', ') AS ESPECIALIDADES
			FROM tbl_profissional PRO
			LEFT JOIN tbl_endereco ENDE ON ENDE.ID_ENDERECO = PRO.ID_ENDERECO 
			AND ENDE.ID_PROFISSIONAL = PRO.ID_PROFISSIONAL
			LEFT JOIN sis_estados EST ON EST.ID_IBGE = ENDE.ID_ESTADO
			LEFT JOIN sis_municipios MUN ON MUN.ID_IBGE = ENDE.ID_MUNICIPIO
			LEFT JOIN sis_paises PAI ON PAI.ID_PAIS = ENDE.ID_PAIS
			LEFT JOIN tbl_profissional_especialidade ESP ON ESP.ID_PROFISSIONAL = PRO.ID_PROFISSIONAL
            LEFT JOIN tbl_especialidade ESP2 ON ESP2.ID_ESPECIALIDADE = ESP.ID_ESPECIALIDADE
			WHERE PRO.ID_PROFISSIONAL = $id
			GROUP BY PRO.ID_PROFISSIONAL";
		$result = mysqli_query($conn, $query);
		$resultado = mysqli_fetch_assoc($result);

		return $resultado;
	}

	public function atualizaResumo($resumo,$id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$update = "UPDATE tbl_profissional
			SET
			resumo = '$resumo'
			WHERE ID_PROFISSIONAL = $id";

		if (!mysqli_query($conn, $update)) {
			echo "Error: " . $update . "<br>" . mysqli_error($conn);
			exit();
		}

		return "ok";
	}

	public function atualizaEndereco($logradouro,$numero,$estado,$cidade,$bairro,$complemento,$pais,$cep,$id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$buscaID = "SELECT * FROM tbl_endereco WHERE ID_PROFISSIONAL = $id LIMIT 1";
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
				WHERE ID_PROFISSIONAL = $id";

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
				ID_PROFISSIONAL)
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

			$buscaID = "SELECT * FROM tbl_endereco WHERE ID_PROFISSIONAL = $id LIMIT 1";
			$resultado_usuario = mysqli_query($conn, $buscaID);
			$resultado = mysqli_fetch_assoc($resultado_usuario);

			$idendereco = $resultado['ID_ENDERECO'];

			$update = "UPDATE tbl_profissional
				SET
				ID_ENDERECO = $idendereco
				WHERE ID_PROFISSIONAL = $id";

			if (!mysqli_query($conn, $update)) {
				echo "Error: " . $update . "<br>" . mysqli_error($conn);
				exit();
			}

    	}

		return "ok";
	}

	public function atualizaValores($valor_sessao,$periodo,$id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$update = "UPDATE tbl_profissional
			SET
			valor_sessao = '$valor_sessao',
			duracao_sessao = $periodo
			WHERE ID_PROFISSIONAL = $id";

		if (!mysqli_query($conn, $update)) {
			echo "Error: " . $update . "<br>" . mysqli_error($conn);
			exit();
		}

		return "ok";
	}

	public function atualizaEspecialidades($id_espec,$id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$limpabase = "DELETE FROM tbl_profissional_especialidade WHERE ID_PROFISSIONAL = $id";
		if (!mysqli_query($conn, $limpabase)) {
			echo "Error: " . $limpabase . "<br>" . mysqli_error($conn);
			exit();
		}

		if (isset($id_espec)) {

			foreach ($id_espec as $key => $value) {

				$insert = "INSERT INTO tbl_profissional_especialidade
					(ID_PROFISSIONAL,
					ID_ESPECIALIDADE)
					VALUES
					($id,
					$value)";

				if (!mysqli_query($conn, $insert)) {
					echo "Error: " . $insert . "<br>" . mysqli_error($conn);
					exit();
				}

			}

		}

		return "ok";
	}

	public function retornaEspecialidades($id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$query = "SELECT TPS.ID_ESPECIALIDADE as id, ESP.nome_especialidade as text 
			FROM tbl_profissional_especialidade TPS 
			INNER JOIN tbl_especialidade ESP ON ESP.ID_ESPECIALIDADE = TPS.ID_ESPECIALIDADE 
			WHERE TPS.ID_PROFISSIONAL = $id";
		$result = mysqli_query($conn, $query);

		return $result;
	}

	public function novaFormacao($curso,$instituicao,$situacao,$nivel,$conclusao,$id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$insert = "INSERT INTO tbl_formacao
			(ID_CURSO,
			ID_INSTITUICAO,
			ID_NIVEL_FORMACAO,
			ID_SITUACAO_FORMACAO,
			ID_PROFISSIONAL,
			data_conclusao)
			VALUES
			($curso,
			$instituicao,
			$nivel,
			$situacao,
			$id,
			'$conclusao')";

		if (!mysqli_query($conn, $insert)) {
			echo "Error: " . $insert . "<br>" . mysqli_error($conn);
			exit();
		}

		return "ok";
	}


	public function editarFormacao($curso,$instituicao,$situacao,$nivel,$conclusao,$id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$update = " UPDATE tbl_formacao
					SET
					ID_CURSO = $curso,
					ID_INSTITUICAO = $instituicao,
					ID_NIVEL_FORMACAO = $nivel,
					ID_SITUACAO_FORMACAO = $situacao,
					data_conclusao = '$conclusao'
					WHERE ID_FORMACAO = $id;";

		if (!mysqli_query($conn, $update)) {
			echo "Error: " . $update . "<br>" . mysqli_error($conn);
			exit();
		}

		return "ok";
	}

	public function deletarFormacao($id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$delete = "DELETE FROM tbl_formacao WHERE ID_FORMACAO = $id;";

		if (!mysqli_query($conn, $delete)) {
			echo "Error: " . $delete . "<br>" . mysqli_error($conn);
			exit();
		}

		return "ok";
	}

	public function retornaFormacoes($id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$query = "SELECT FORM.ID_FORMACAO, CUR.nome_curso, INS.nome_instituicao, NIV.descricao FROM tbl_formacao FORM
			INNER JOIN sis_curso CUR ON CUR.ID_CURSO = FORM.ID_CURSO
			INNER JOIN sis_instituicao INS ON INS.ID_INSTITUICAO = FORM.ID_INSTITUICAO
            INNER JOIN sis_nivel_curso NIV ON NIV.ID_NIVEL = FORM.ID_NIVEL_FORMACAO
			WHERE FORM.ID_PROFISSIONAL = $id";
		$result = mysqli_query($conn, $query);

		return $result;
	}

	public function retornaFormacao($id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$query = "SELECT FORM.ID_FORMACAO,
					FORM.ID_CURSO,
					CUR.nome_curso AS NOMECURSO,
					FORM.ID_INSTITUICAO,
					INS.nome_instituicao AS NOMEINSTITUICAO,
					FORM.ID_NIVEL_FORMACAO,
					NIV.descricao AS NIVEL,
					FORM.ID_SITUACAO_FORMACAO,
					SIT.descricao AS SITUACAO,
					FORM.data_conclusao
					FROM tbl_formacao FORM
					INNER JOIN sis_curso CUR ON CUR.ID_CURSO = FORM.ID_CURSO
					INNER JOIN sis_instituicao INS ON INS.ID_INSTITUICAO = FORM.ID_INSTITUICAO
		            INNER JOIN sis_nivel_curso NIV ON NIV.ID_NIVEL = FORM.ID_NIVEL_FORMACAO
		            INNER JOIN sis_situacao_curso SIT ON SIT.ID_SITUACAO = FORM.ID_SITUACAO_FORMACAO
					WHERE FORM.ID_FORMACAO = $id";
		$result = mysqli_query($conn, $query);

		return $result;
	}

	public function novaExperiencia($cargo,$empresa,$atividades,$id,$dataini,$datafim){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$insert = "INSERT INTO tbl_experiencia
			(cargo,
			empresa,
			atividades,
			ID_PROFISSIONAL,
			data_ini,
			data_fim)
			VALUES
			('$cargo',
			'$empresa',
			'$atividades',
			$id,
			'$dataini',
			'$datafim')";

		if (!mysqli_query($conn, $insert)) {
			echo "Error: " . $insert . "<br>" . mysqli_error($conn);
			exit();
		}

		return "ok";
	}

	public function retornaExperiencias($id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$query = "SELECT * FROM tbl_experiencia WHERE ID_PROFISSIONAL = $id";
		$result = mysqli_query($conn, $query);

		return $result;
	}

	public function retornaExperiencia($id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$query = "SELECT * FROM tbl_experiencia WHERE ID_EXPERIENCIA = $id";
		$result = mysqli_query($conn, $query);

		return $result;
	}

	public function editarExperiencia($cargo,$empresa,$atividades,$id,$dataini,$datafim){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$update = " UPDATE tbl_experiencia
					SET
					cargo = '$cargo',
					empresa = '$empresa',
					atividades = '$atividades',
					data_ini = '$dataini',
					data_fim = '$datafim'
					WHERE ID_EXPERIENCIA = $id;";

		if (!mysqli_query($conn, $update)) {
			echo "Error: " . $update . "<br>" . mysqli_error($conn);
			exit();
		}

		return "ok";
	}

	public function deletarExperiencia($id){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$delete = "DELETE FROM tbl_experiencia WHERE ID_EXPERIENCIA = $id;";

		if (!mysqli_query($conn, $delete)) {
			echo "Error: " . $delete . "<br>" . mysqli_error($conn);
			exit();
		}

		return "ok";
	}

	public function retornaProfissionais(){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$query = "SELECT PRO.ID_PROFISSIONAL AS ID,
			PRO.url_foto AS FOTO,
			PRO.nome AS NOME,
			PRO.valor_sessao AS VALORSESSAO,
			PRO.duracao_sessao AS DURACAOSESSAO,
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
			PAI.nome AS PAIS,
			GROUP_CONCAT(ESP2.nome_especialidade SEPARATOR ', ') AS ESPECIALIDADES
			FROM tbl_profissional PRO
			LEFT JOIN tbl_endereco ENDE ON ENDE.ID_ENDERECO = PRO.ID_ENDERECO 
			AND ENDE.ID_PROFISSIONAL = PRO.ID_PROFISSIONAL
			LEFT JOIN sis_estados EST ON EST.ID_IBGE = ENDE.ID_ESTADO
			LEFT JOIN sis_municipios MUN ON MUN.ID_IBGE = ENDE.ID_MUNICIPIO
			LEFT JOIN sis_paises PAI ON PAI.ID_PAIS = ENDE.ID_PAIS
			LEFT JOIN tbl_profissional_especialidade ESP ON ESP.ID_PROFISSIONAL = PRO.ID_PROFISSIONAL
            LEFT JOIN tbl_especialidade ESP2 ON ESP2.ID_ESPECIALIDADE = ESP.ID_ESPECIALIDADE
            GROUP BY PRO.ID_PROFISSIONAL";
		$result = mysqli_query($conn, $query);

		return $result;
	}




}

?>