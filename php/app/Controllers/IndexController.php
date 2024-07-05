<?php


namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

session_start([
    'cookie_lifetime' => 86400,
]);
class IndexController extends Action
{
    public function index()
    {
        $torneio = Container::getModel('Torneio');
        $torneio_data = $torneio->getAllTorneios();
        $this->viewData->torneios = $torneio_data;

        $this->render('index');
    }

    public function register()
    {
        $this->render('register', 'sign_in_layout');
    }
}
