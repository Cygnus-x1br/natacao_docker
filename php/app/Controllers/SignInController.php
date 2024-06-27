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
            $_SESSION['user_id'] = $user->__get('user_id');
            $_SESSION['user_name'] = $user->__get('user_name');

            $this->setHtmlData->signed = 'enabled';

            if ($_SESSION['permissao'] == 2) {
                header('Location:index_admin');
            } elseif ($_SESSION['permissao'] == 1) {
                header('Location:index_atleta?id=' . $_SESSION['user_id']);
            }
        } else {
            header('Location: /error?error=9999');
            die();
        }
    }
    public function log_out()
    {
        session_start();
        unset($_SESSION["id"]);
        unset($_SESSION["nome"]);
        unset($_SESSION['permissao']);
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
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
