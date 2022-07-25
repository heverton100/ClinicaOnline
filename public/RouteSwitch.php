<?php

abstract class RouteSwitch
{
    public function home()
    {
        require __DIR__ . '../../app/view/index.php';
    }

    public function login()
    {
        require __DIR__ . '../../app/view/account/login.php';
    }

    public function registro_paciente()
    {
        require __DIR__ . '../../app/view/account/registro-paciente.php';
    }

    public function registro_profissional()
    {
        require __DIR__ . '../../app/view/account/registro-profissional.php';
    }

    public function esqueceu_senha()
    {
        require __DIR__ . '../../app/view/account/esqueceu-senha.php';
    }

    public function email_confirmacao()
    {
        require __DIR__ . '../../app/view/account/email-confirmacao.php';
    }

    public function valida_email()
    {
        require __DIR__ . '../../app/view/account/validacao-sucesso.php';
    }

    public function email_esqueceu_senha()
    {
        require __DIR__ . '../../app/view/account/email-esqueceu-senha.php';
    }

    public function redefinicao_senha()
    {
        require __DIR__ . '../../app/view/account/redefinicao-senha.php';
    }


    public function logout()
    {
        session_start(); 
        session_destroy();
        require __DIR__ . '../../app/view/account/login.php';
    }
    
    public function __call($name, $arguments)
    {
        http_response_code(404);
        require __DIR__ . '/pages/404.html';
    }
}