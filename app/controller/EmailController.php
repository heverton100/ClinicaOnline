<?php

require '../../public/plugins/PHPMailer/src/Exception.php';
require '../../public/plugins/PHPMailer/src/PHPMailer.php';
require '../../public/plugins/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class EmailController {

	function envia_email_confirmacao($email_dest,$nome_dest){

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
		$mail->addAddress($email_dest, $nome_dest);
		// Conteúdo da mensagem
		$mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
		$mail->CharSet = 'UTF-8'; 
		$mail->Subject = 'Ativação da Conta - Ibrapsi';
		$mail->Body    = 'Olá '.$nome_dest.',<br>Sua conta no Ibrapsi está quase pronta. Para ativá-la, por favor confirme o seu endereço de email clicando no link abaixo.<br><p><a href="http://localhost/clinica/clinicanova/public/valida_email?hash='.md5($email_dest).'">Confirmar meu e-mail</a></p>Sua conta não será ativada até que seu email seja confirmado.<br>Atenciosamente,<br>Equipe Ibrapsi';
		$mail->AltBody = 'Este é o corpo da mensagem para clientes de e-mail que não reconhecem HTML';
		// Enviar
		//send the message, check for errors
		if (!$mail->send()) {
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		}

	}

	function envia_email_senha($email_dest,$nome_dest){

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
		$mail->addAddress($email_dest, $nome_dest);
		// Conteúdo da mensagem
		$mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
		$mail->CharSet = 'UTF-8'; 
		$mail->Subject = 'Redefinição de Senha - Ibrapsi';
		$mail->Body    = 'Olá,<br>Clique no link abaixo para redefinir sua senha ou copie e cole o link no seu navegador:<br><p><a href="http://localhost/clinica/clinicanova/public/redefinicao_senha?hash='.md5($email_dest).'">http://localhost/clinica/clinicanova/public/redefinicao_senha?hash='.md5($email_dest).'</a></p>Atenciosamente,<br>Equipe Ibrapsi';
		$mail->AltBody = 'Este é o corpo da mensagem para clientes de e-mail que não reconhecem HTML';
		// Enviar
		//send the message, check for errors
		if (!$mail->send()) {
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		}

	}

	

}

?>