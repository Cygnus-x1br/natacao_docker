<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

session_start([
    'cookie_lifetime' => 86400,
]);

class IndicesController extends Action
{
    public function list_indices():void
    {
        $indices = Container::getModel('Indices');
        $indices_data = $indices->getIndicesFiltered();
        $this->viewData->indices = $indices_data;

        $this->viewData->anosIndice = GenerateLists::list_anos_indices();
        $this->viewData->tipoIndice = GenerateLists::list_tipos();
        $this->viewData->categorias = GenerateLists::list_categorias();
        $this->viewData->piscinas = GenerateLists::list_piscinas();

        $this->render('list_indices');
    }

    public function filtra_indices():void
    {
        $indices = Container::getModel('Indices');
        $indices->__set('anoIndice', $_POST['anoIndice']);
        $indices->__set('tipoIndice', $_POST['tipoIndice']);
        $indices->__set('generoIndice', $_POST['generoIndice']);
        $indices->__set('id_categoria', $_POST['id_categoria']);
        $indices_data = $indices->getIndicesFiltered();
        $this->viewData->indices = $indices_data;

        $this->viewData->anosIndice = GenerateLists::list_anos_indices();
        $this->viewData->tipoIndice = GenerateLists::list_tipos();
        $this->viewData->categorias = GenerateLists::list_categorias();
        $this->viewData->piscinas = GenerateLists::list_piscinas();
        $this->render('list_indices');
    }
    public function filtra_indices_grafico():void
    {
        $indices = Container::getModel('Indices');
        $indices->__set('anoIndice', $_POST['anoIndice']);
        $indices->__set('tipoIndice', $_POST['tipoIndice']);
        $indices->__set('generoIndice', $_POST['generoIndice']);
        $indices->__set('id_categoria', $_POST['id_categoria']);
        $indices_data = $indices->getIndicesFilteredGrafico();
        $this->viewData->indices = $indices_data;

        $this->viewData->anosIndice = GenerateLists::list_anos_indices();
        $this->viewData->tipoIndice = GenerateLists::list_tipos();
        $this->viewData->categorias = GenerateLists::list_categorias();
        $this->viewData->piscinas = GenerateLists::list_piscinas();
        $this->render('list_indices');
    }
    public function filtra_indices_tabela():void
    {
        $indices = Container::getModel('Indices');
        $indices->__set('anoIndice', $_POST['anoIndice']);
        $indices->__set('tipoIndice', $_POST['tipoIndice']);
        $indices->__set('generoIndice', $_POST['generoIndice']);
        $indices->__set('id_categoria', $_POST['id_categoria']);
        $indices_data = $indices->getIndicesFiltered();
        $this->viewData->indices = $indices_data;

        $this->viewData->anosIndice = GenerateLists::list_anos_indices();
        $this->viewData->tipoIndice = GenerateLists::list_tipos();
        $this->viewData->categorias = GenerateLists::list_categorias();
        $this->viewData->piscinas = GenerateLists::list_piscinas();
        $this->render('indice_admin');
    }

    public function add_indice():void
    {
        Assets::authenticate();

        $tempoAtleta = Container::getModel('Tempo');
        $tempoAtleta->__set('id_atleta', $_SESSION['user_id']);
        $tempoAtleta_data = $tempoAtleta->getTempo();
        $this->viewData->tempoAtleta = $tempoAtleta_data;
        
        $this->viewData->torneios = GenerateLists::list_torneios();
        $this->viewData->distanciaEstilo = GenerateLists::list_todos_estilos();
        $this->viewData->categorias = GenerateLists::list_categorias();

        $provas = Container::getModel('Prova');
        $provas_data = $provas->getAllProvas();
        $this->viewData->provas = $provas_data;

        $this->render('add_indice');
    }
    public function save_indice():void
    {
        $indices = Container::getModel('Indices');
        $indices->__set('anoIndice', $_POST['anoIndice']);
        $indices->__set('tempoIndice', '00:' . $_POST['tempoIndice']);
        $indices->__set('id_categoria', $_POST['id_categoria']);
        $indices->__set('generoIndice', $_POST['generoIndice']);
        $indices->__set('tipoIndice', $_POST['tipoIndice']);
        $indices->__set('id_distanciaestilo', $_POST['id_distanciaestilo']);
        $indices->__set('id_piscina', $_POST['id_piscina']);

        $testaInclusao = $indices->verificaIndice();
        if ($testaInclusao != '') {
            header('Location: /error?error=4001');
        } else {
            $indices->saveIndice();
            header('Location: /indice_admin');
        }
       
    }
}
