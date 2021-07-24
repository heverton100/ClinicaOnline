<?php 
session_start(); 

include("../conf/conexao.php");

//O campo usuário e senha preenchido entra no if para validar
if((isset($_POST['email'])) && (isset($_POST['senha']))){
    $usuario = $_POST['email'];
    $senha = md5($_POST['senha']);
        
    $result_usuario = "SELECT * FROM sis_usuario WHERE email = '$usuario' && senha = '$senha' LIMIT 1";
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    $resultado = mysqli_fetch_assoc($resultado_usuario);
    
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



?>