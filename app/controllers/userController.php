<?php

session_start();

require '../dao/daoUser.php';

$teste = new daoUser;

switch($_GET["function"]) {

	case 'login':

		if((isset($_POST['email'])) && (isset($_POST['senha']))){
		    $usuario = $_POST['email'];
		    $senha = md5($_POST['senha']);

		    $resultado = $teste->login($usuario,$senha);
		    
		    if(isset($resultado)){

		    	if ($resultado['email_confirmado'] == 1) {

		    		if($resultado['profissional'] == 1){
		                $_SESSION['email_user'] = $usuario;
		                sleep(1);
			            header("Location: ../../");
			        }elseif($resultado['paciente'] == 1){
		                $_SESSION['email_user'] = $usuario;
		                sleep(1);
		                if ($_POST['origem'] == '') {
		                    header("Location: ../../");
		                }else{
		                    header("Location: ".$_POST['origem']);
		                }
			            
			        }

		    	}else{
			        $_SESSION['loginErro'] = "E-mail não validado!";
			        header("Location: ../../account/login.php");
		    	}

		    }else{    
		        //Váriavel global recebendo a mensagem de erro
		        $_SESSION['loginErro'] = "Usuário ou senha Inválido!";
			    header("Location: ../../account/login.php");
		    }

		}else{
		    $_SESSION['loginErro'] = "Usuário ou senha inválido!";
			header("Location: ../../account/login.php");
		}

		break;

	case 'registrar_paciente':

		$email = $_POST['email'];
		$senha = md5($_POST['senha']);
		$nome = $_POST['nome'];

		$teste->registrar_paciente($email,$senha,$nome);

		break;

	case 'registrar_profissional':

		$email = $_POST['email'];
		$senha = md5($_POST['senha']);
		$nome = $_POST['nome'];

		$teste->registrar_profissional($email,$senha,$nome);

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

	case 'resetar_senha':

		$email = $_POST['email'];

		header('location: ../../account/email-forgot-pass.php?hash='.md5($email));

		break;

	case 'update_senha':

		$email = $_POST['email'];
		$senha = md5($_POST['senha1']);

		$row_email = $teste->update_senha($email,$senha);

		break;

}

?>