<?php

require_once 'C:/xampp/htdocs/clinica/conf/ConexaoOO.php';

class daoUser{

	public function login($usuario,$senha){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$query = "SELECT * FROM sis_usuario WHERE email = '$usuario' && senha = '$senha' LIMIT 1";
		$result = mysqli_query($conn, $query);
		$resultado = mysqli_fetch_assoc($result);

		return $resultado;
	}

	public function session_validation($usuario){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$query = "SELECT SIS.*,
        (CASE WHEN SIS.profissional = 1 THEN PRO.nome
            WHEN SIS.paciente = 1 THEN PAC.nome END) AS NOME,
        (CASE WHEN SIS.profissional = 1 THEN PRO.url_foto
            WHEN SIS.paciente = 1 THEN PAC.url_foto END) AS URLFOTO,
        (CASE WHEN SIS.profissional = 1 THEN PRO.ID_PROFISSIONAL
            WHEN SIS.paciente = 1 THEN PAC.ID_PACIENTE END) AS ID
        FROM sis_usuario SIS 
        LEFT JOIN tbl_profissional PRO ON PRO.ID_USUARIO = SIS.ID_USUARIO 
        LEFT JOIN tbl_paciente PAC ON PAC.ID_USUARIO = SIS.ID_USUARIO
        WHERE SIS.email = '$usuario' LIMIT 1";
		$result = mysqli_query($conn, $query);
		$resultado = mysqli_fetch_assoc($result);

		return $resultado;
	}

	public function registrar_paciente($email,$senha,$nome){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$insert = "INSERT INTO sis_usuario (email, senha, date_create, paciente, email_confirmado, token) VALUES 
		('$email','$senha',NOW(),1,0,'".md5($email)."')";

		if (!mysqli_query($conn, $insert)) {
		  echo "Error: " . $insert . "<br>" . mysqli_error($conn);
		  exit();
		}

		$selectultimo = "SELECT ID_USUARIO FROM sis_usuario WHERE email = '".$email. "' AND paciente = 1 ORDER BY ID_USUARIO DESC";
		$result = mysqli_query($conn, $selectultimo);
		$row = mysqli_fetch_assoc($result);

		$insert2 = "INSERT INTO tbl_paciente(ID_USUARIO, nome) VALUES (".$row['ID_USUARIO'].",'$nome')";

		if (mysqli_query($conn, $insert2)) {
		  header('location: ../../account/email-validation.php?hash='.md5($email));
		} else {
		  echo "Error: " . $insert2 . "<br>" . mysqli_error($conn);
		}

		return "ok";
	}

	public function retorna_email($tipo,$hash){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		if ($tipo == '1') {
			$select = "SELECT SIS.email,PRO.nome FROM sis_usuario SIS 
			INNER JOIN tbl_profissional PRO ON PRO.ID_USUARIO = SIS.ID_USUARIO WHERE SIS.token = '".$hash."'";
		}else{
			$select = "SELECT SIS.email,PAC.nome FROM sis_usuario SIS 
			INNER JOIN tbl_paciente PAC ON PAC.ID_USUARIO = SIS.ID_USUARIO WHERE SIS.token = '".$hash."'";
		}

		$result = mysqli_query($conn, $select);
		$row = mysqli_fetch_assoc($result);

		return $row;
	}

	public function valida_email($hash){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$update = "UPDATE sis_usuario SET email_confirmado = 1 WHERE token = '".$hash."'";

		if (!mysqli_query($conn, $update)) {
		  echo "Error: " . $update . "<br>" . mysqli_error($conn);
		  exit();
		}

		return 'ok';
	}

	public function registrar_profissional($email,$senha,$nome){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$insert = "INSERT INTO sis_usuario (email, senha, date_create, profissional, email_confirmado, token) VALUES ('$email','$senha',NOW(),1,0,'".md5($email)."')";

		if (!mysqli_query($conn, $insert)) {
		  echo "Error: " . $insert . "<br>" . mysqli_error($conn);
		  exit();
		}

		$selectultimo = "SELECT ID_USUARIO FROM sis_usuario WHERE email = '".$email. "' AND profissional = 1 ORDER BY ID_USUARIO DESC";
		$result = mysqli_query($conn, $selectultimo);
		$row = mysqli_fetch_assoc($result);

		$insert2 = "INSERT INTO tbl_profissional(ID_USUARIO, nome) VALUES (".$row['ID_USUARIO'].",'$nome')";

		if (mysqli_query($conn, $insert2)) {
		  header('location: ../../account/email-validation.php?hash='.md5($email).'&profissional=1');
		} else {
		  echo "Error: " . $insert2 . "<br>" . mysqli_error($conn);
		}

		return "ok";
	}

	public function check_email($email){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		//CHECAGEM DE EMAIL DUPLICADO
		$select_email = "SELECT email FROM sis_usuario WHERE email = '".$email."'";
		$result_email = mysqli_query($conn, $select_email);
		$row_email = mysqli_fetch_assoc($result_email);

		return $row_email;
	}

	public function retorna_nome_email($hash){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$select_email = "SELECT SIS.email AS EMAIL, (CASE WHEN SIS.profissional = 1 THEN PRO.nome
			WHEN SIS.paciente = 1 THEN PAC.nome END) AS NOME FROM sis_usuario SIS 
			LEFT JOIN tbl_profissional PRO ON PRO.ID_USUARIO = SIS.ID_USUARIO 
			LEFT JOIN tbl_paciente PAC ON PAC.ID_USUARIO = SIS.ID_USUARIO
			WHERE SIS.token = '".$hash."'";
		$result_email = mysqli_query($conn, $select_email);
		$row_email = mysqli_fetch_assoc($result_email);

		return $row_email;
	}

	public function update_senha($email,$senha){

		$conexao = new ConexaoOO;
		$conn = $conexao->connection();

		$update = "UPDATE sis_usuario SET senha='$senha', date_update=NOW() WHERE email = '$email'";

		if (mysqli_query($conn, $update)) {

			$_SESSION['msg_senhatrocada'] = "Senha redefinida com sucesso!";

			header('location: ../../account/login.php');

		} else {
			echo "Error: " . $update . "<br>" . mysqli_error($conn);
		}

		return "ok";
	}

}

?>