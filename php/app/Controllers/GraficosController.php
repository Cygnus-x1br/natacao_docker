<?php

namespace App\Controllers;

use App\Models\DistanciaEstilo;
use MF\Controller\Action;
use MF\Model\Container;

session_start([
    'cookie_lifetime' => 86400,
]);
class GraficosController extends Action
{
    public function create_graph()
    {
        Assets::authenticate();

        $this->viewData->anos = Assets::list_anos($_SESSION['user_id']);
        $this->viewData->torneiosParticipados = Assets::list_torneios($_SESSION['user_id']);
        $this->viewData->estilos = Assets::list_estilos($_SESSION['user_id']);

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

        $tempoAtleta = Container::getModel('Tempo');
        $tempoAtleta->__set('id_atleta', $_SESSION['user_id']);
        $tempoAtleta_data = $tempoAtleta->getTemposFiltered();
        $this->viewData->tempoAtleta = $tempoAtleta_data;

        $this->render('create_graph');
    }

    public function graficos_tempo_filtrado()
    {

        Assets::authenticate();
        $this->viewData->anos = Assets::list_anos($_SESSION['user_id']);
        $this->viewData->torneiosParticipados = Assets::list_torneios($_SESSION['user_id']);
        $this->viewData->estilos = Assets::list_estilos($_SESSION['user_id']);

        $atleta = Container::getModel('Atleta');
        $atleta->__set('idatleta', $_SESSION['user_id']);
        $atleta_data = $atleta->getAtletabyID();
        $this->viewData->atleta = $atleta_data;

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

        $indices = Container::getModel('Indices');
        $indices->__set('id_distanciaestilo', $_POST['distanciaEstilo']);
        $indices->__set('generoIndice', $atleta_data['sexoAtleta']);
        $indices->__set('id_categoria', date('Y') - (explode('-', $atleta_data['dataNascAtleta']))[0]);
        $indices->__set('p1', $_POST['p1'] ?? '');
        $indices->__set('p2', $_POST['p2'] ?? '');
        $indices->__set('i1', $_POST['i1'] ?? '');
        $indices->__set('i2', $_POST['i2'] ?? '');
        $indices->__set('jv1', $_POST['jv1'] ?? '');
        $indices->__set('jv2', $_POST['jv2'] ?? '');
        $indices->__set('jr1', $_POST['jr1'] ?? '');
        $indices->__set('jr2', $_POST['jr2'] ?? '');
        $indices_data = $indices->getIndicesFilteredGrafico();
        $this->viewData->indices = $indices_data;

        $tempos = Container::getModel('Tempo');
        $tempos->__set('id_atleta', $_SESSION['user_id']);
        $tempos->__set('anoTempo', $_POST['anoTempo']);
        $tempos->__set('nomeTorneio', $_POST['nomeTorneio']);
        $tempos->__set('tamanhoPiscina', $_POST['tamanhoPiscina']);
        $tempos->__set('distanciaEstilo', $_POST['distanciaEstilo']);
        $tempoAtleta_data = $tempos->getTemposFilteredCronologico();
        $this->viewData->tempoAtleta = $tempoAtleta_data;

        $this->render('graficos_tempo');
    }
}
