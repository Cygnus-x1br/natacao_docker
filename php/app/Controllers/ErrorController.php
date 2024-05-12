<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class ErrorController extends Action
{
  public function erro()
  {
    $this->render('erro', 'layout');
  }
}
