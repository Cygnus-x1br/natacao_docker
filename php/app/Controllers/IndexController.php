<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action
{
  public function index()
  {

    $atleta = Container::getModel('Atleta');
    $atleta_data = $atleta->getAtleta();
    $this->viewData->atleta = $atleta_data;



    $equipes = Container::getModel('Equipe');
    $equipe_data = $equipes->getAllEquipes();
    $this->viewData->equipes = $equipe_data;

    $this->render('index');
  }
}
