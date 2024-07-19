<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

session_start([
    'cookie_lifetime' => 86400,
]);
class TorneioController extends Action
{
    public function add_torneio(): void
    {
        if (!isset($_SESSION['id'])) {
            header('Location: /error?error=1001');
            die();
        }

        $this->viewData->piscinas = GenerateLists::list_todas_piscinas();
        $this->viewData->federacoes = GenerateLists::list_federacoes();
        $this->viewData->complexos = GenerateLists::list_complexos();

        $this->render('add_torneio');
    }
    public function edit_torneio(): void
    {
        if (!isset($_SESSION['id'])) {
            header('Location: /error?error=1001');
            die();
        }

        $torneio = Container::getModel('Torneio');
        $torneio->__set('idtorneio', $_GET['id']);
        $torneio_data = $torneio->getTorneio();
        $this->viewData->torneio = $torneio_data;
        $this->viewData->piscinas = GenerateLists::list_todas_piscinas();
        $this->viewData->federacoes = GenerateLists::list_federacoes();
        $this->viewData->complexos = GenerateLists::list_complexos();

        $this->render('edit_torneio');
    }

    public function save_torneio(): void
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

    public function update_torneio(): void
    {
        $torneio = Container::getModel('Torneio');
        $torneio->__set('idtorneio', $_POST['idtorneio']);
        $torneio->__set('nomeTorneio', $_POST['nomeTorneio']);
        $torneio->__set('dataTorneio', $_POST['dataTorneio']);
        $torneio->__set('dataFimTorneio', $_POST['dataFimTorneio']);
        $torneio->__set('id_piscina', $_POST['id_piscina']);
        $torneio->__set('id_federacao', $_POST['id_federacao']);
        $torneio->__set('id_complexo', $_POST['id_complexo']);

        $torneio->updateTorneio();

        if ($_SESSION['permissao'] == 2) {
            header('Location: /torneio_admin');
        } else {
            header('Location: /list_torneios');
        }
    }

    public function list_torneios(): void
    {
        $this->viewData->torneios = GenerateLists::list_torneios();
        $this->render('list_torneios');
    }
    public function view_torneio(): void
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

    public function delete_torneio(): void
    {
        $torneio = Container::getModel('Torneio');
        $torneio->__set('idtorneio', $_GET['id']);
        $torneio->deleteTorneio();
        header('Location: /torneio_admin');
    }
}
