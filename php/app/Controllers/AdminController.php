<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

session_start([
    'cookie_lifetime' => 86400,
]);
class AdminController extends Action
{

    public function index_admin()
    {
        Assets::authenticate();

        if ($_SESSION['permissao'] != '2') {
            header('Location: /error?error=1002');
            die();
        }

        $this->render('index_admin');
    }
    public function select_atleta()
    {
        Assets::authenticate();

        if ($_SESSION['permissao'] != '2') {
            header('Location: /index_atleta?id=' . $_SESSION['id']);
            die();
        }
        $this->render('select_atleta');
    }
}
