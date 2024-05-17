<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class AtletaController extends Action
{
  public function view_atleta()
  {
    $atleta = Container::getModel('Atleta');
    $atleta_data = $atleta->getAtleta();
    $this->viewData->atleta = $atleta_data;

    $idade = date('Y') - (explode('-', $atleta_data['dataNascAtleta']))[0];
    $categoria = Container::getModel('Categoria');
    $categoria->__set('idcategoria', $idade);
    $categoria_atleta = $categoria->getCategoria();
    $this->viewData->categoria = $categoria_atleta;


    $equipes = Container::getModel('Equipe');
    $equipe_data = $equipes->getAllEquipes();
    $this->viewData->equipes = $equipe_data;

    $this->render('view_atleta');
  }
}
