<?php

namespace App\Controllers;

use App\Models\DistanciaEstilo;
use MF\Controller\Action;
use MF\Model\Container;

session_start([
    'cookie_lifetime' => 86400,
]);
class TempoController extends Action
{
    public function tempos_atleta()
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

        $indicesMundial = Container::getModel('Recordes');
        $indicesMundial->__set('tipoRecorde', 'Recorde Mundial');
        $indice_data = $indicesMundial->getRecordesFiltered();
        $this->viewData->indices_mundial = $indice_data;


        $this->render('tempos_atleta');
    }

    public function add_tempo()
    {
        Assets::authenticate();

        $tempoAtleta = Container::getModel('Tempo');
        $tempoAtleta->__set('id_atleta', $_SESSION['user_id']);
        $tempoAtleta_data = $tempoAtleta->getTempos();
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

        $this->render('add_tempo');
    }

    public function save_tempo()
    {
        Assets::authenticate();

        $prova = Container::getModel('Prova');
        $prova->__set('idprova', $_POST['id_prova']);
        $prova_data = $prova->getProvaMin();
        // $this->viewData->provas = $provas_data;

        $atleta = Container::getModel('Atleta');
        $atleta->__set('idatleta', $_SESSION['user_id']);
        $atleta_data = $atleta->getAtletabyID();
        // $this->viewData->atleta = $atleta_data;

        if ($atleta_data['sexoAtleta'] != $prova_data['genero']) {
            header("Location: /error?error=3001");
            die();
        }

        if (((explode('-', $prova_data['dataTorneio']))[0] - (explode('-', $atleta_data['dataNascAtleta']))[0]) < $prova_data['ID_CATEGORIA_MIN']) {
            header("Location: /error?error=3002&" . $prova_data['ID_CATEGORIA_MIN']);
            die();
        }
        if (((explode('-', $prova_data['dataTorneio']))[0] - (explode('-', $atleta_data['dataNascAtleta']))[0]) > $prova_data['ID_CATEGORIA_MAX']) {
            header("Location: /error?error=3002&" . $prova_data['ID_CATEGORIA_MAX']);
            die();
        }

        $tempoAtleta = Container::getModel('Tempo');
        $tempoAtleta->__set('id_atleta', $_SESSION['user_id']);
        $tempoAtleta->__set('id_prova', $_POST['id_prova']);
        $tempoAtleta->__set('final', $_POST['final'] ?? 'N');
        $tempoAtleta->__set('tempoAtleta', '00:' . $_POST['tempoAtleta']);

        $testaInclusao = $tempoAtleta->verificaTempo();
        print_r($testaInclusao);

        if ($testaInclusao != '') {
            header('Location: /error?error=4001');
        } else {
            $tempoAtleta->saveTempo();
            header('Location: /tempos_atleta?id=' . $_SESSION['user_id']);
        }
    }

    public function edit_tempo()
    {

        Assets::authenticate();

        $tempoAtleta = Container::getModel('Tempo');
        $tempoAtleta->__set('id_atleta', $_SESSION['user_id']);
        $tempoAtleta->__set('idtmpatleta', $_GET['id']);
        $tempoAtleta_data = $tempoAtleta->getTempo();
        $this->viewData->tempoAtleta = $tempoAtleta_data;

        $torneio = Container::getModel('Torneio');
        $torneio_data = $torneio->getAllTorneios();
        $this->viewData->torneios = $torneio_data;

        $this->viewData->distanciaEstilo = Assets::list_todos_estilos();
        $this->viewData->categorias = Assets::list_categorias();

        $provas = Container::getModel('Prova');
        $provas_data = $provas->getAllProvas();
        $this->viewData->provas = $provas_data;

        $this->render('edit_tempo');
    }

    public function update_tempo()
    {
        Assets::authenticate();

        $tempoAtleta = Container::getModel('Tempo');
        $tempoAtleta->__set('idtmpatleta', $_POST['idtmpatleta']);
        $tempoAtleta->__set('final', $_POST['final'] ?? 'N');
        $tempoAtleta->__set('tempoAtleta', '00:' . $_POST['tempoAtleta']);
        $tempoAtleta->updateTempo();

        header("Location: /tempos_atleta?id=" . $_SESSION['user_id']);
    }

    public function delete_tempo()
    {
        Assets::authenticate();

        $tempoAtleta = Container::getModel('Tempo');
        $tempoAtleta->__set('idtmpatleta', $_GET['id']);
        $tempoAtleta->deleteTempo();

        header("Location: /tempos_atleta?id=" . $_SESSION['user_id']);
    }
    public function filtra_tempos()
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

        $this->viewData->categorias = Assets::list_categorias();

        $indicesMundial = Container::getModel('Recordes');
        $indicesMundial->__set('tipoRecorde', 'Recorde Mundial');
        $indice_data = $indicesMundial->getRecordesFiltered();
        $this->viewData->indices_mundial = $indice_data;

        $provas = Container::getModel('Prova');
        $provas_data = $provas->getAllProvas();
        $this->viewData->provas = $provas_data;

        $tempos = Container::getModel('Tempo');
        $tempos->__set('id_atleta', $_SESSION['user_id']);
        $tempos->__set('anoTempo', $_POST['anoTempo']);
        $tempos->__set('nomeTorneio', $_POST['nomeTorneio']);
        $tempos->__set('tamanhoPiscina', $_POST['tamanhoPiscina']);
        $tempos->__set('distanciaEstilo', $_POST['distanciaEstilo']);
        $tempoAtleta_data = $tempos->getTemposFiltered();

        $this->viewData->tempoAtleta = $tempoAtleta_data;
        $this->render('tempos_atleta');
    }
}
