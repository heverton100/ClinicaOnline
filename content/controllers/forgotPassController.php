<?php

session_start();

include("../conf/conexao.php");

switch($_GET["function"]) {

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

	case 'resetarsenha':

		$email = $_POST['email'];

		header('location: ../../account/email-forgot-pass.php?hash='.md5($email));

		break;

	case 'updatesenha':

		$email = $_POST['email'];
		$senha = md5($_POST['senha1']);

		$insert2 = "UPDATE sis_usuario SET senha='$senha', date_update=NOW() WHERE email = '$email'";

		if (mysqli_query($conn, $insert2)) {

			$_SESSION['msg_senhatrocada'] = "Senha redefinida com sucesso!";

			mysqli_close($conn);

			header('location: ../../account/login.php');
		} else {
			echo "Error: " . $insert2 . "<br>" . mysqli_error($conn);
		}

		break;
}

?>