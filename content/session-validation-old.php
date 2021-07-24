<?php 

if (isset($_SESSION['email_user'])) {

	$usuario = $_SESSION['email_user'];

	$result_usuario = "SELECT SIS.*,
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
    $resultado_usuario = mysqli_query($conn, $result_usuario);
    $resultado = mysqli_fetch_assoc($resultado_usuario);
    
    if(isset($resultado)){

        if (isset($resultado['URLFOTO'])) {
            $_SESSION['URLFOTO'] = $resultado['URLFOTO'];
        }else{
            $_SESSION['URLFOTO'] = "../../assets/img/doctors/doctor-thumb-02.jpg";
        }
        $_SESSION['NOME'] = $resultado['NOME'];

		if($resultado['profissional'] == 1){
            $_SESSION['IDPROFISSIONAL'] = $resultado['ID'];
            if (strpos($_SERVER['PHP_SELF'], "login.php") == true) {
                header("Location: ../dashboard/profissional/index.php");
            }else{
                header("Location: dashboard/profissional/index.php");
            }
        }elseif($resultado['paciente'] == 1){
            $_SESSION['IDPACIENTE'] = $resultado['ID'];
            if (strpos($_SERVER['PHP_SELF'], "login.php") == true) {
                header("Location: ../dashboard/paciente/index.php");
            }else{
                header("Location: dashboard/paciente/index.php");
            }
        }
    }

}else{
    if (strpos($_SERVER['PHP_SELF'], "login.php") == false) {
        header("Location: account/login.php");
    }elseif(strpos($_SERVER['PHP_SELF'], "login.php") == true){
        //
    }
}

?>