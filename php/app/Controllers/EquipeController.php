<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class EquipeController extends Action
{
  public function view_equipe()
  {
    $this->render('view_equipe');
  }
}
