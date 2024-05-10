<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action
{
  public function index()
  {

    $equipes = Container::getModel('Equipe');
    $equipe_data = $equipes->getAllEquipes();
    $this->viewData->equipes = $equipe_data;

    $this->render('index');
  }
}
