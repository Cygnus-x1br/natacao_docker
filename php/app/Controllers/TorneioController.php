<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

session_start([
    'cookie_lifetime' => 86400,
]);
class TorneioController extends Action
{
    public function add_torneio()
    {
        if (!isset($_SESSION['id'])) {
            header('Location: /error?error=1001');
            die();
        }

        $piscina = Container::getModel('Piscina');
        $piscinas = $piscina->getPiscinas();
        $this->viewData->piscinas = $piscinas;

        // $federacao = Container::getModel('Federacao');
        // $federacoes = $federacao->getAllFederacoes();
        $this->viewData->federacoes = Assets::list_federacoes();

        $complexo = Container::getModel('Complexo');
        $complexos = $complexo->getAllComplexos();
        $this->viewData->complexos = $complexos;


        $this->render('add_torneio');
    }

    public function save_torneio()
    {
        $torneio = Container::getModel('Torneio');
        $torneio->__set('nomeTorneio', $_POST['nomeTorneio']);
        $torneio->__set('dataTorneio', $_POST['dataTorneio']);
        $torneio->__set('dataFimTorneio', $_POST['dataFimTorneio']);
        $torneio->__set('id_piscina', $_POST['id_piscina']);
        $torneio->__set('id_federacao', $_POST['id_federacao']);
        $torneio->__set('id_complexo', $_POST['id_complexo']);

        $torneio->saveTorneio();

        if ($_SESSION['permissao'] == 2) {
            header('Location: /torneio_admin');
        } else {
            header('Location: /list_torneios');
        }
    }

    public function list_torneios()
    {
        $torneio = Container::getModel('Torneio');
        $torneios = $torneio->getAllTorneios();
        $this->viewData->torneios = $torneios;
        $this->render('list_torneios');
    }
    public function view_torneio()
    {
        $torneio = Container::getModel('Torneio');
        $torneio->__set('idtorneio', $_GET['id']);
        $torneios = $torneio->getTorneio();
        $this->viewData->torneios = $torneios;

        $provas = Container::getModel('Prova');
        $provas->__set('id_torneio', $_GET['id']);
        $provas_data = $provas->getProvasTorneio();
        $this->viewData->provas = $provas_data;


        $this->render('view_torneio');
    }

    public function delete_torneio()
    {
        $torneio = Container::getModel('Torneio');
        $torneio->__set('idtorneio', $_GET['id']);
        $torneio->deleteTorneio();
        header('Location: /torneio_admin');
    }
}
