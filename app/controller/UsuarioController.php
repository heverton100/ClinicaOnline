<?php

require_once '../model/DaoUsuario.php';

class UsuarioController extends DaoUsuario {

	public function login($usuario,$senha){

		$response = DaoUsuario::login($usuario,$senha);

		if(isset($response)){

	    	if ($response['email_confirmado'] == 1) {

				$return = $response['id_perfil_usuario'];

	    	}else{
		        $return = "email_nao_validado";
	    	}

	    }else{
	        $return = "Usuário ou senha Inválido!";
	    }

		return $return;

	}

	public function session_validation($usuario){

		$response = DaoUsuario::session_validation($usuario);

		return $response;
	}

	public function set_variables($resultado){

		if(isset($resultado)){

			if (isset($resultado['URLFOTO'])) {
			    $_SESSION['URLFOTO'] = $resultado['URLFOTO'];
			}else{
			    $_SESSION['URLFOTO'] = "../public/img/doctors/doctor-thumb-02.jpg";
			}
			$_SESSION['NOME'] = $resultado['NOME'];

			if($resultado['id_perfil_usuario'] == 3){
			    $_SESSION['IDPROFISSIONAL'] = $resultado['ID'];
			}elseif($resultado['id_perfil_usuario'] == 2){
			    $_SESSION['IDPACIENTE'] = $resultado['ID'];
			}

			if (strpos($_SERVER['PHP_SELF'], "login.php") == true) {
			    header("Location: ../index.php");
			}
		}

	}

	public function registrar_profissional($email,$senha,$nome){

		$response = DaoUsuario::registrar_profissional($email,$senha,$nome);

		return $response;
	}

	public function registrar_paciente($email,$senha,$nome){

		$response = DaoUsuario::registrar_paciente($email,$senha,$nome);

		return $response;
	}

	public function valida_email($hash){

		$response = DaoUsuario::valida_email($hash);

		return $response;
	}

	public function update_senha($token,$senha){

		$response = DaoUsuario::update_senha($token,$senha);

		return $response;
	}

	public function check_email($email){
		
		$response = DaoUsuario::check_email($email);

		return $response;
	}

}

?>