<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;



class MyException extends \PDOException
{
    public function __construct($message)
    {
        
        if($message->errorInfo[1] == 1451) {
            require_once __DIR__ . "../../Views/exception_layout.phtml";
            echo '<div class="container text-center">
            <h1 class="text-bg-danger">Erro Fatal</h1>
            <p>Erro no banco de dados</p>
            <p>Para excluir esse elemento voce deve primeiro excluir os elementos ligados a ele.</p>
            <a href="' . $_SERVER['HTTP_REFERER'] . '" class="btn btn-outline-secondary">Voltar</a>
            </div>
            </body>';   
            
        }
        die();
    }
}
