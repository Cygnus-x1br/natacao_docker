<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

session_start();
class ProvaController extends Action
{
    public function list_provas()
    {

        $torneio = Container::getModel('Torneio');
        $torneio_data = $torneio->getAllTorneios();
        $this->viewData->torneios = $torneio_data;

        $distanciaEstilo = Container::getModel('DistanciaEstilo');
        $distanciaEstilo_data = $distanciaEstilo->getAllDistanciaEstilo();
        $this->viewData->distanciaEstilo = $distanciaEstilo_data;

        $categoria = Container::getModel('Categoria');
        $categoria_data = $categoria->getAllCategorias();
        $this->viewData->categorias = $categoria_data;

        $provas = Container::getModel('Prova');
        $provas_data = $provas->getAllProvas();
        $this->viewData->provas = $provas_data;

        $this->render('list_provas');
    }
    public function add_prova()
    {
        if (!isset($_SESSION['id'])) {
            header('Location: /error?error=1001');
            die();
        }

        $torneio = Container::getModel('Torneio');
        $torneio_data = $torneio->getAllTorneios();
        $this->viewData->torneios = $torneio_data;

        $distanciaEstilo = Container::getModel('DistanciaEstilo');
        $distanciaEstilo_data = $distanciaEstilo->getAllDistanciaEstilo();
        $this->viewData->distanciaEstilo = $distanciaEstilo_data;

        $categoria = Container::getModel('Categoria');
        $categoria_data = $categoria->getAllCategorias();
        $this->viewData->categorias = $categoria_data;

        $provas = Container::getModel('Prova');
        $provas_data = $provas->getAllProvas();
        $this->viewData->provas = $provas_data;

        $this->render('add_prova');
    }

    public function save_prova()
    {
        $prova = Container::getModel('Prova');
        $prova->__set('numeroProva', $_POST['numeroProva']);
        $prova->__set('genero', $_POST['genero']);
        $prova->__set('id_torneio', $_POST['id_torneio']);
        $prova->__set('id_distanciaestilo', $_POST['id_distanciaestilo']);
        $prova->__set('id_categoria_min', $_POST['id_categoria_min']);
        $prova->__set('id_categoria_max', $_POST['id_categoria_max']);
        $prova->saveProva();
        header('Location: /add_prova');
    }
}
