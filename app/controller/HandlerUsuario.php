<?php

session_start();

require './UsuarioController.php';
require './EmailController.php';

$uc = new UsuarioController;
$ec = new EmailController;

switch($_GET["function"]) {

	case 'login':

		if((isset($_POST['email'])) && (isset($_POST['senha']))){

		    $usuario = $_POST['email'];
		    $senha = md5($_POST['senha']);

		    $resultado = $uc->login($usuario,$senha);

			if($resultado == 1){

				$return = "Admin";

			//PACIENTE
			}elseif($resultado == 2){

				sleep(1);
				$_SESSION['email_user'] = $usuario;
				
				$resultado2 = $uc->session_validation($usuario);
				$uc->set_variables($resultado2);

				header("Location: ../../");

			//PROFISSIONAL
			}elseif($resultado == 3){

				sleep(1);
				$_SESSION['email_user'] = $usuario;

				$resultado2 = $uc->session_validation($usuario);
				$uc->set_variables($resultado2);

				header("Location: ../../");

			}elseif($resultado == "email_nao_validado"){

				sleep(1);
				$_SESSION['loginErro'] = "E-mail não validado!";
				header("Location: ../../public/login");

			}else{

			    $_SESSION['loginErro'] = "Usuário ou senha inválido!";
				header("Location: ../../public/login");

			}
		    
		}else{
		    $_SESSION['loginErro'] = "Usuário ou senha inválido!";
			header("Location: ../../public/login");
		}

		break;

	case 'session_validation':

		if (isset($_SESSION['email_user'])) {

		    $usuario = $_SESSION['email_user'];

		    $resultado = $uc->session_validation($usuario);
		    
			$uc->set_variables($resultado2);

		}

		break;

	case 'registrar_paciente':

		$email = $_POST['email'];
		$senha = md5($_POST['senha']);
		$nome = $_POST['nome'];

		$response = $uc->registrar_paciente($email,$senha,$nome);

		if ($response == "ok") {

			$return = $ec->envia_email_confirmacao($email,$nome);
			sleep(1);
			$_SESSION['email_temp'] = $email;
			header('location: ../../public/email_confirmacao');

		} else {
			echo "Error: " . $response . "<br>";
		}

		break;

	case 'registrar_profissional':

		$email = $_POST['email'];
		$senha = md5($_POST['senha']);
		$nome = $_POST['nome'];

		$response = $uc->registrar_profissional($email,$senha,$nome);

		if ($response == "ok") {

			$return = $ec->envia_email_confirmacao($email,$nome);
			sleep(1);
			$_SESSION['email_temp'] = $email;
			header('location: ../../public/email_confirmacao');

		} else {
			echo "Error: " . $response . "<br>";
		}

		break;

	case 'confirma_email':

		$hash = $_GET['hash'];

		$response = $uc->valida_email($hash);

		break;

	case 'resetar_senha':

		$email = $_POST['email'];

		$nometemp = explode('@',$email);
		$nome = $nometemp[0];

		$response = $ec->envia_email_senha($email,$nome);

		header('location: ../../public/email_esqueceu_senha?email='.$email);

		break;

	case 'update_senha':

		$token = $_POST['token'];
		$senha = md5($_POST['senha1']);

		$response = $uc->update_senha($token,$senha);

		if ($response == "ok") {
			$_SESSION['msg_senhatrocada'] = "Senha redefinida com sucesso!";
			header('location: ../../public/login');
		}else{
			echo $response;
		}

		break;

	case 'check_email':

		$email = $_POST['email'];

		$teste->check_email($email);

		$row_email = $teste->check_email($email);

		if (isset($row_email['email'])) {
			echo "1";
		}else{
			echo "0";
		}

		break;

}

?>