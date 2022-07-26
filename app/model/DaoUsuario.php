<?php

require_once 'C:/xampp/htdocs/clinica/clinicanova/app/model/ConexaoOO.php';

class DaoUsuario extends ConexaoOO {

	public function login($usuario,$senha){

		$conn = ConexaoOO::connection();

		$query = "SELECT * FROM sis_usuario WHERE email = '$usuario' && senha = '$senha' LIMIT 1";
		$result = mysqli_query($conn, $query);
		$resultado = mysqli_fetch_assoc($result);

		return $resultado;
	}

	public function session_validation($usuario){

		$conn = ConexaoOO::connection();

		$query = "SELECT SIS.*,
		(CASE WHEN SIS.id_perfil_usuario = 2 THEN PAC.nome
			WHEN SIS.id_perfil_usuario = 3 THEN PRO.nome END) AS NOME,
		(CASE WHEN SIS.id_perfil_usuario = 2 THEN PAC.url_foto
			WHEN SIS.id_perfil_usuario = 3 THEN PRO.url_foto END) AS URLFOTO,
		(CASE WHEN SIS.id_perfil_usuario = 2 THEN PAC.id_paciente
			WHEN SIS.id_perfil_usuario = 3 THEN PRO.id_profissional END) AS ID
		FROM sis_usuario SIS 
        LEFT JOIN tbl_profissional PRO ON PRO.id_usuario = SIS.id_usuario 
        LEFT JOIN tbl_paciente PAC ON PAC.id_usuario = SIS.id_usuario
        WHERE SIS.email = '$usuario' LIMIT 1";
		$result = mysqli_query($conn, $query);
		$resultado = mysqli_fetch_assoc($result);

		return $resultado;
	}

	public function registrar_profissional($email,$senha,$nome){

		$conn = ConexaoOO::connection();

		$insert_usuario = "INSERT INTO sis_usuario (
			email, 
			senha, 
			date_create, 
			id_perfil_usuario, 
			email_confirmado, 
			token
			) VALUES (
			'$email',
			'$senha',
			NOW(),
			3,
			0,
			'".md5($email)."')";

		if (!mysqli_query($conn, $insert_usuario)) {
		  echo "Error: " . $insert_usuario . "<br>" . mysqli_error($conn);
		  exit();
		}

		$selectultimo = "SELECT id_usuario FROM sis_usuario WHERE email = '".$email. "' 
		AND id_perfil_usuario = 3 ORDER BY id_usuario DESC";

		$result = mysqli_query($conn, $selectultimo);
		$row = mysqli_fetch_assoc($result);

		$insert_profissional = "INSERT INTO tbl_profissional(id_usuario, nome) VALUES (".$row['id_usuario'].",'$nome')";

		if (mysqli_query($conn, $insert_profissional)) {
			return "ok";
		} else {
			return "Error: " . $insert_profissional . "<br>" . mysqli_error($conn);
		}
		
	}


	public function registrar_paciente($email,$senha,$nome){

		$conn = ConexaoOO::connection();

		$insert_usuario = "INSERT INTO sis_usuario (
			email,
			senha,
			date_create,
			id_perfil_usuario,
			email_confirmado,
			token
			)VALUES(
			'$email',
			'$senha',
			NOW(),
			2,
			0,
			'".md5($email)."')";

		if (!mysqli_query($conn, $insert_usuario)) {
		  echo "Error: " . $insert_usuario . "<br>" . mysqli_error($conn);
		  exit();
		}

		$selectultimo = "SELECT id_usuario FROM sis_usuario WHERE email = '".$email. "' AND id_perfil_usuario = 2 ORDER BY ID_USUARIO DESC";
		$result = mysqli_query($conn, $selectultimo);
		$row = mysqli_fetch_assoc($result);

		$insert_paciente = "INSERT INTO tbl_paciente(id_usuario, nome) VALUES (".$row['id_usuario'].",'$nome')";

		if (mysqli_query($conn, $insert_paciente)) {
			return "ok";
		} else {
			return "Error: " . $insert_paciente . "<br>" . mysqli_error($conn);
		}

		return "ok";
	}


	public function valida_email($hash){

		$conn = ConexaoOO::connection();

		$update = "UPDATE sis_usuario SET email_confirmado = 1 WHERE token = '".$hash."'";

		if (!mysqli_query($conn, $update)) {
		  echo "Error: " . $update . "<br>" . mysqli_error($conn);
		  exit();
		}

		return 'ok';
	}

	public function update_senha($token,$senha){

		$conn = ConexaoOO::connection();

		$update = "UPDATE sis_usuario SET senha='$senha', date_update=NOW() WHERE token = '$token'";

		if (mysqli_query($conn, $update)) {

			return "ok";

		} else {
			return "Error: " . $update . "<br>" . mysqli_error($conn);
		}

	}

	public function check_email($email){

		$conn = ConexaoOO::connection();

		//CHECAGEM DE EMAIL DUPLICADO
		$select_email = "SELECT email FROM sis_usuario WHERE email = '".$email."'";
		$result_email = mysqli_query($conn, $select_email);
		$row_email = mysqli_fetch_assoc($result_email);

		return $row_email;
	}


}

?>