<?php 

require 'C:/xampp/htdocs/clinica/app/dao/daoUser.php';

$teste = new daoUser;

if (isset($_SESSION['email_user'])) {

	$usuario = $_SESSION['email_user'];

    $resultado = $teste->session_validation($usuario);
    
    if(isset($resultado)){

        if (isset($resultado['URLFOTO'])) {
            $_SESSION['URLFOTO'] = $resultado['URLFOTO'];
        }else{
            $_SESSION['URLFOTO'] = "../../assets/img/doctors/doctor-thumb-02.jpg";
        }
        $_SESSION['NOME'] = $resultado['NOME'];

		if($resultado['profissional'] == 1){
            $_SESSION['IDPROFISSIONAL'] = $resultado['ID'];
        }elseif($resultado['paciente'] == 1){
            $_SESSION['IDPACIENTE'] = $resultado['ID'];
        }

        if (strpos($_SERVER['PHP_SELF'], "login.php") == true) {
            header("Location: ../index.php");
        }
    }

}

?>