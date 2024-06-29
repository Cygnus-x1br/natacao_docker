<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

session_start([
    'cookie_lifetime' => 86400,
]);

class IndicesController extends Action
{
    public function list_indices()
    {
        $indices = Container::getModel('Indices');
        $indices_data = $indices->getIndicesFiltered();
        $this->viewData->indices = $indices_data;

        $this->viewData->anosIndice = Assets::list_anos_indices();
        $this->viewData->tipoIndice = Assets::list_tipos();
        $this->viewData->categorias = Assets::list_categorias();
        $this->viewData->piscinas = Assets::list_piscinas();

        $this->render('list_indices');
    }

    public function filtra_indices()
    {
        $indices = Container::getModel('Indices');
        $indices->__set('anoIndice', $_POST['anoIndice']);
        $indices->__set('tipoIndice', $_POST['tipoIndice']);
        $indices->__set('generoIndice', $_POST['generoIndice']);
        $indices->__set('id_categoria', $_POST['id_categoria']);
        $indices_data = $indices->getIndicesFiltered();
        $this->viewData->indices = $indices_data;

        $this->viewData->anosIndice = Assets::list_anos_indices();
        $this->viewData->tipoIndice = Assets::list_tipos();
        $this->viewData->categorias = Assets::list_categorias();
        $this->viewData->piscinas = Assets::list_piscinas();
        $this->render('list_indices');
    }
    public function filtra_indices_grafico()
    {
        $indices = Container::getModel('Indices');
        $indices->__set('anoIndice', $_POST['anoIndice']);
        $indices->__set('tipoIndice', $_POST['tipoIndice']);
        $indices->__set('generoIndice', $_POST['generoIndice']);
        $indices->__set('id_categoria', $_POST['id_categoria']);
        $indices_data = $indices->getIndicesFilteredGrafico();
        $this->viewData->indices = $indices_data;

        $this->viewData->anosIndice = Assets::list_anos_indices();
        $this->viewData->tipoIndice = Assets::list_tipos();
        $this->viewData->categorias = Assets::list_categorias();
        $this->viewData->piscinas = Assets::list_piscinas();
        $this->render('list_indices');
    }
    public function filtra_indices_tabela()
    {
        $indices = Container::getModel('Indices');
        $indices->__set('anoIndice', $_POST['anoIndice']);
        $indices->__set('tipoIndice', $_POST['tipoIndice']);
        $indices->__set('generoIndice', $_POST['generoIndice']);
        $indices->__set('id_categoria', $_POST['id_categoria']);
        $indices_data = $indices->getIndicesFiltered();
        $this->viewData->indices = $indices_data;

        $this->viewData->anosIndice = Assets::list_anos_indices();
        $this->viewData->tipoIndice = Assets::list_tipos();
        $this->viewData->categorias = Assets::list_categorias();
        $this->viewData->piscinas = Assets::list_piscinas();
        $this->render('indice_admin');
    }

    public function add_indice()
    {
        Assets::authenticate();

        $tempoAtleta = Container::getModel('Tempo');
        $tempoAtleta->__set('id_atleta', $_SESSION['user_id']);
        $tempoAtleta_data = $tempoAtleta->getTempo();
        $this->viewData->tempoAtleta = $tempoAtleta_data;

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

        $this->render('add_indice');
    }
    public function save_indice()
    {
        $indices = Container::getModel('Indices');
        $indices->__set('anoIndice', $_POST['anoIndice']);
        $indices->__set('tempoIndice', '00:' . $_POST['tempoIndice']);
        $indices->__set('id_categoria', $_POST['id_categoria']);
        $indices->__set('generoIndice', $_POST['generoIndice']);
        $indices->__set('tipoIndice', $_POST['tipoIndice']);
        $indices->__set('id_distanciaestilo', $_POST['id_distanciaestilo']);
        $indices->__set('id_piscina', $_POST['id_piscina']);

        print_r($_POST);
        $indices->saveIndice();
        header('Location: /indice_admin');
    }
}
