<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

session_start();
class ErrorController extends Action
{
    public function error()
    {
        $url = $_SERVER['HTTP_REFERER'] ?? '/';
        if ($_GET['error'] == 1001) {
            $this->setHtmlData->error = 'Voce deve estar logado para executar essa tarefa';
            $this->setHtmlData->url = $url;
        } elseif ($_GET['error'] == 1002) {
            $this->setHtmlData->error = 'Voce não tem permissao para acessar dados de atletas';
            $this->setHtmlData->url = $url;
        }
        $this->render('erro', 'error_layout');
    }
}
