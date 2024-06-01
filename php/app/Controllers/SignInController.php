<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class SignInController extends Action
{
    public function sign_in()
    {
        $this->setHtmlData->referer = $_SERVER['HTTP_REFERER'];
        // $this->setHtmlData->signed = 'enabled';
        $this->render('sign_in', 'sign_in_layout');
    }

    public function authenticate()
    {
        if (empty($_POST['username']) || empty($_POST['passwd'])) {
            header('Location: /sign_in?login=erro');
        }
        $user = Container::getModel('users');
        $user->__set('username', $_POST['username']);
        $user->__set('passwd', $_POST['passwd']);
        $user->login();

        if ($user->__get('iduser') && $user->__get('username')) {

            session_start(['cookie_lifetime' => 86400]);
            $_SESSION['id'] = $user->__get('iduser');
            $_SESSION['nome'] = $user->__get('username');
            $_SESSION['permissao'] = $user->__get('permission');
            $_SESSION['user_id'] = $user->__get('iduser');
            $_SESSION['user_name'] = $user->__get('user_name');

            $this->setHtmlData->signed = 'enabled';
            header('Location:' . $_POST['location']);
        } else {
            header('Location: /sing_in?login=erro');
        }
    }
    public function log_out()
    {
        session_start();
        unset($_SESSION["id"]);
        unset($_SESSION["nome"]);
        unset($_SESSION['permissao']);
        header("location: /");
    }

    public static function validaAutenticacao()
    {
        session_start();
        if (!$_SESSION['id'] || !$_SESSION['nome']) {
            header('Location: signin?login=error');
            die();
        }
    }
}
