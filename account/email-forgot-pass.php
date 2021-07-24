<?php
session_start();

include("../content/conf/conexao.php");

require '../assets/plugins/PHPMailer/src/Exception.php';
require '../assets/plugins/PHPMailer/src/PHPMailer.php';
require '../assets/plugins/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


$select_nome = "SELECT SIS.email AS EMAIL, (CASE WHEN SIS.profissional = 1 THEN PRO.nome
			WHEN SIS.paciente = 1 THEN PAC.nome END) AS NOME FROM sis_usuario SIS 
			LEFT JOIN tbl_profissional PRO ON PRO.ID_USUARIO = SIS.ID_USUARIO 
			LEFT JOIN tbl_paciente PAC ON PAC.ID_USUARIO = SIS.ID_USUARIO
			WHERE SIS.token = '".$_GET['hash']."'";
$result_nome = mysqli_query($conn, $select_nome);
$row_nome = mysqli_fetch_assoc($result_nome);

$nome = $row_nome['NOME'];
$dest = $row_nome['EMAIL'];

enviaEmail($dest,$nome);

$urlreenvio = "?hash=".$_GET['hash']."&reenvio=sim";
if (isset($_GET['reenvio'])) {
	enviaEmail($dest,$nome);
}

function enviaEmail($dest,$nome){

	// Instância da classe
	$mail = new PHPMailer();

	// Configurações do servidor
	$mail->isSMTP();        //Devine o uso de SMTP no envio
	$mail->SMTPAuth = true; //Habilita a autenticação SMTP

	//$mail->SMTPDebug = SMTP::DEBUG_SERVER;

	$mail->Username   = 'heverton.rc.100@gmail.com';
	$mail->Password   = 'dAjmYZgECtcYdX4';
	// Criptografia do envio SSL também é aceito
	//$mail->SMTPSecure = 'ssl';
	// Informações específicadas pelo Google
	$mail->Host = 'smtp-pulse.com';
	$mail->Port = '2525';
	// Define o remetente
	$mail->setFrom('teste@dotipsandtricks.com', 'Heverton');
	// Define o destinatário
	$mail->addAddress($dest, $nome);
	// Conteúdo da mensagem
	$mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
	$mail->CharSet = 'UTF-8'; 
	$mail->Subject = 'Redefinição de Senha - Ibrapsi';
	$mail->Body    = 'Olá '.$nome.',<br>Clique no link abaixo para redefinir sua senha ou copie e cole o link no seu navegador:<br><p><a href="http://localhost/clinica/account/validation-new-pass.php?hash='.$_GET['hash'].'">http://localhost/clinica/account/validation-new-pass.php?hash='.$_GET['hash'].'</a></p>Atenciosamente,<br>Equipe Ibrapsi';
	$mail->AltBody = 'Este é o cortpo da mensagem para clientes de e-mail que não reconhecem HTML';
	// Enviar
	//send the message, check for errors
	if (!$mail->send()) {
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	}

}

?>
<!DOCTYPE html> 
<html lang="en">
	
<head>
		<meta charset="utf-8">
		<title>Ibrapsi - Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
		<!-- Favicons -->
		<link href="../assets/img/favicon.png" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="../assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="../assets/js/html5shiv.min.js"></script>
			<script src="../assets/js/respond.min.js"></script>
		<![endif]-->
	
	</head>
	<body class="account-page">

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<?php include '../content/header.php' ?>
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
					
					<div class="row">
						<div class="col-md-8 offset-md-2">
							
							<!-- Login Tab Content -->
							<div class="account-content">
								<div class="row align-items-center justify-content-center">

									<h1>Confirme seu endereço de e-mail</h1>
									<p>Está quase pronto! Uma mensagem de Redefinição de Senha foi enviada para <b>
										<?php echo $dest;?></b>.</p>
									<p>Basta verificar seu e-mail e clicar no link para terminar de redefinir a sua senha.</p>
									<p>Não está conseguindo visualizar o e-mail? <a href="<?php echo $urlreenvio; ?>">Clique aqui para reenviar o e-mail de confirmação.</a></p>
								</div>
							</div>
							<!-- /Login Tab Content -->
								
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->
   
			<?php include '../content/footer.php' ?>
		   
		</div>
		<!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="../assets/js/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="../assets/js/popper.min.js"></script>
		<script src="../assets/js/bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="../assets/js/script.js"></script>
		
	</body>

</html>