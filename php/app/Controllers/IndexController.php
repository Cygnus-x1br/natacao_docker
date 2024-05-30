<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action
{
    public function index()
    {

        if (isset($_GET['id'])) {
            $atleta = Container::getModel('Atleta');
            $atleta->__set('idatleta', $_GET['id']);
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

            $this->render('index_atleta');
        }

        $this->render('index');
    }

    public function register()
    {

        $this->render('register', 'sign_in_layout');
    }
}
