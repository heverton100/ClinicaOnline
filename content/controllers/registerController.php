<?php

session_start();

include("../conf/conexao.php");

switch($_POST["tipo"]) {

	case 'paciente':

		$email = $_POST['email'];
		$senha = md5($_POST['senha']);
		$nome = $_POST['nome'];

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

		mysqli_close($conn);


		break;
	
	case 'profissional':

		$email = $_POST['email'];
		$senha = md5($_POST['senha']);
		$nome = $_POST['nome'];

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

		mysqli_close($conn);

	
		break;


	case 'checkemail':

		//CHECAGEM DE EMAIL DUPLICADO
		$select_email = "SELECT email FROM sis_usuario WHERE email = '".$_POST['email']."'";
		$result_email = mysqli_query($conn, $select_email);
		$row_email = mysqli_fetch_assoc($result_email);

		if (isset($row_email['email'])) {
			echo "1";
		}else{
			echo "0";
		}

		break;
}

?>