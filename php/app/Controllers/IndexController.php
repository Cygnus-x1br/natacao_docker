<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

session_start([
    'cookie_lifetime' => 86400,
]);
class IndexController extends Action
{
    public function index():void
    {
        $this->viewData->torneios = Assets::list_torneios();
        $this->render('index');
    }
    public function register():void
    {
        $this->render('register', 'sign_in_layout');
    }
}
