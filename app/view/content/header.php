<?php 

include __DIR__.'/header/h-main.php'; 

if (isset($_SESSION['email_user']) && isset($_SESSION['IDPROFISSIONAL'])) {

	include __DIR__.'/header/h-profissional.php'; 

}elseif(isset($_SESSION['email_user']) && isset($_SESSION['IDPACIENTE'])) {

	include __DIR__.'/header/h-paciente.php'; 

}else{

	include __DIR__.'/header/h-no-session.php';

}

?>