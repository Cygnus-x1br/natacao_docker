<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class MyException extends \PDOException
{
    public function __construct($message)
    {

        if ($message->errorInfo[1] == 1451) {
            require_once __DIR__ . "../../Views/exception_layout.phtml";
            echo '<div class="container text-center">
            <img src="./images/erro.png" alt="" width="300" class="img-fluid mb-5">
            <div style="margin: 0 250px">
            <h1 class="text-bg-danger mb-5">Erro Fatal</h1>
            </div>
            <p class="lead">Erro no banco de dados</p>
            <p>Esse elemento está em uso por outro registro.</p>
            <a href="' . $_SERVER['HTTP_REFERER'] . '" class="btn btn-secondary w-50">Voltar</a>
            </div>
            </body>';
        }
        die();
    }
}
