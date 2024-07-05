<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

session_start([
    'cookie_lifetime' => 86400,
]);

class RecordesController extends Action
{
    public function list_recordes()
    {
        $recordes = Container::getModel('Recordes');
        $recordes_data = $recordes->getRecordesFiltered();
        $this->viewData->recordes = $recordes_data;

        $this->viewData->tipoRecorde = Assets::list_tipos_recorde();
        $this->viewData->categorias = Assets::list_categorias();
        $this->viewData->piscinas = Assets::list_piscinas();

        $this->render('list_recordes');
    }

    public function filtra_recordes()
    {
        $recordes = Container::getModel('Recordes');
        $recordes->__set('anoRecorde', $_POST['anoRecorde']);
        $recordes->__set('tipoRecorde', $_POST['tipoRecorde']);
        $recordes->__set('generoRecorde', $_POST['generoRecorde']);
        $recordes->__set('id_categoria', $_POST['id_categoria']);
        $recordes_data = $recordes->getRecordesFiltered();
        $this->viewData->recordes = $recordes_data;

        $this->viewData->anosIndice = Assets::list_anos_indices();
        $this->viewData->tipoRecorde = Assets::list_tipos_recorde();
        $this->viewData->categorias = Assets::list_categorias();
        $this->viewData->piscinas = Assets::list_piscinas();
        $this->render('list_recordes');
    }
    public function filtra_recordes_grafico()
    {
        $recordes = Container::getModel('Recordes');
        $recordes->__set('anoRecorde', $_POST['anoRecorde']);
        $recordes->__set('tipoRecorde', $_POST['tipoRecorde']);
        $recordes->__set('generoRecorde', $_POST['generoRecorde']);
        $recordes->__set('id_categoria', $_POST['id_categoria']);
        $recordes_data = $recordes->getRecordesFilteredGrafico();
        $this->viewData->recordes = $recordes_data;

        $this->viewData->anosIndice = Assets::list_anos_indices();
        $this->viewData->tipoRecorde = Assets::list_tipos_recorde();
        $this->viewData->categorias = Assets::list_categorias();
        $this->viewData->piscinas = Assets::list_piscinas();
        $this->render('list_recordes');
    }
    public function filtra_recordes_tabela()
    {
        $indices = Container::getModel('Recordes');
        $indices->__set('dataRecorde', $_POST['dataRecorde']);
        $indices->__set('tipoRecorde', $_POST['tipoRecorde']);
        $indices->__set('generoRecorde', $_POST['generoRecorde']);
        $indices->__set('id_categoria', $_POST['id_categoria']);
        $indices_data = $indices->getRecordesFiltered();
        $this->viewData->indices = $indices_data;

        $this->viewData->anosIndice = Assets::list_anos_indices();
        $this->viewData->tipoRecorde = Assets::list_tipos_recorde();
        $this->viewData->categorias = Assets::list_categorias();
        $this->viewData->piscinas = Assets::list_piscinas();
        $this->render('recorde_admin');
    }

    public function add_recordes()
    {
        Assets::authenticate();

        $tempoAtleta = Container::getModel('Tempo');
        $tempoAtleta->__set('id_atleta', $_SESSION['user_id']);
        $tempoAtleta_data = $tempoAtleta->getTempo();
        $this->viewData->tempoAtleta = $tempoAtleta_data;

        $torneio = Container::getModel('Torneio');
        $torneio_data = $torneio->getAllTorneios();
        $this->viewData->torneios = $torneio_data;

        // $distanciaEstilo = Container::getModel('DistanciaEstilo');
        // $distanciaEstilo_data = $distanciaEstilo->getAllDistanciaEstilo();
        // $this->viewData->distanciaEstilo = $distanciaEstilo_data;
        $this->viewData->distanciaEstilo = Assets::list_todos_estilos();

        // $categoria = Container::getModel('Categoria');
        // $categoria_data = $categoria->getAllCategorias();
        // $this->viewData->categorias = $categoria_data;
        $this->viewData->categorias = Assets::list_categorias();

        $provas = Container::getModel('Prova');
        $provas_data = $provas->getAllProvas();
        $this->viewData->provas = $provas_data;

        $this->render('add_recordes');
    }

    public function edit_recorde()
    {
        Assets::authenticate();

        $recorde = Container::getModel('Recordes');
        $recorde->__set('idrecorde', $_GET['id']);
        $recorde_data = $recorde->getRecorde();
        $this->viewData->recordes = $recorde_data;

        $this->viewData->tipoRecorde = Assets::list_tipos_recorde();
        $this->viewData->categorias = Assets::list_categorias();
        $this->viewData->piscinas = Assets::list_piscinas();
        $this->viewData->estilos = Assets::list_todos_estilos();

        $this->render('edit_recordes', 'admin_layout');
    }
    public function save_recorde()
    {
        $recordes = Container::getModel('Recordes');
        $recordes->__set('dataRecorde', $_POST['dataRecorde']);
        $recordes->__set('tempoRecorde', '00:' . $_POST['tempoRecorde']);
        $recordes->__set('id_categoria', $_POST['id_categoria']);
        $recordes->__set('generoRecorde', $_POST['generoRecorde']);
        $recordes->__set('tipoRecorde', $_POST['tipoRecorde']);
        $recordes->__set('localRecorde', $_POST['localRecorde']);
        $recordes->__set('nacionalidadeRecorde', $_POST['nacionalidadeRecorde']);
        $recordes->__set('nomeAtletaRecorde', $_POST['nomeAtletaRecorde']);
        $recordes->__set('id_distanciaestilo', $_POST['id_distanciaestilo']);
        $recordes->__set('id_piscina', $_POST['id_piscina']);

        $testaInclusao = $recordes->verificaRecorde();

        if ($testaInclusao != '') {
            header('Location: /error?error=4001');
        } else {
            $recordes->saveRecorde();
            header('Location: /recordes_admin');
        }
    }

    public function update_recorde()
    {
        $recordes = Container::getModel('Recordes');
        $recordes->__set('dataRecorde', $_POST['dataRecorde']);
        $recordes->__set('tempoRecorde', '00:' . $_POST['tempoRecorde']);
        $recordes->__set('id_categoria', $_POST['id_categoria']);
        $recordes->__set('generoRecorde', $_POST['generoRecorde']);
        $recordes->__set('tipoRecorde', $_POST['tipoRecorde']);
        $recordes->__set('localRecorde', $_POST['localRecorde']);
        $recordes->__set('nacionalidadeRecorde', $_POST['nacionalidadeRecorde']);
        $recordes->__set('nomeAtletaRecorde', $_POST['nomeAtletaRecorde']);
        $recordes->__set('id_distanciaestilo', $_POST['id_distanciaestilo']);
        $recordes->__set('id_piscina', $_POST['id_piscina']);
        $recordes->__set('idrecorde', $_POST['idrecorde']);

        $recordes->updateRecorde();
        header('Location: /recordes_admin');
    }

    public function delete_recorde()
    {
        $recordes = Container::getModel('Recordes');
        $recordes->__set('idrecorde', $_GET['id']);
        $recordes->deleteRecorde();
        header('Location: /recordes_admin');
    }
}
