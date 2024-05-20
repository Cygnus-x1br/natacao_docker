<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class EquipeController extends Action
{
  public function list_equipes()
  {
    $equipe = Container::getModel('Equipe');
    $equipe_data = $equipe->getAllEquipes();
    $this->viewData->equipes = $equipe_data;

    $this->render('list_equipes');
  }
}
