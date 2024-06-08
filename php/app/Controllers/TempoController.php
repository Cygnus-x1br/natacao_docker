<?php

namespace App\Controllers;

use App\Models\DistanciaEstilo;
use MF\Controller\Action;
use MF\Model\Container;

session_start();
class TempoController extends Action
{
    public function tempos_atleta()
    {
        Assets::authenticate();

        $this->viewData->anos = $this->list_anos($_SESSION['user_id']);
        $this->viewData->torneiosParticipados = $this->list_torneios($_SESSION['user_id']);
        $this->viewData->estilos = $this->list_estilos($_SESSION['user_id']);

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

        $this->render('tempos_atleta');
    }

    public function add_tempo()
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

        if ((date('Y') - (explode('-', $atleta_data['dataNascAtleta']))[0]) < $prova_data['ID_CATEGORIA_MIN']) {
            header("Location: /error?error=3002&" . $prova_data['ID_CATEGORIA_MIN']);
            die();
        }
        if ((date('Y') - (explode('-', $atleta_data['dataNascAtleta']))[0]) > $prova_data['ID_CATEGORIA_MAX']) {
            header("Location: /error?error=3002&" . $prova_data['ID_CATEGORIA_MAX']);
            die();
        }

        $tempoAtleta = Container::getModel('Tempo');
        $tempoAtleta->__set('id_atleta', $_SESSION['user_id']);
        $tempoAtleta->__set('id_prova', $_POST['id_prova']);
        $tempoAtleta->__set('tempoAtleta', '00:' . $_POST['tempoAtleta']);
        $tempoAtleta->saveTempo();

        header("Location: /index_atleta?id=" . $_SESSION['user_id']);
    }

    public function filtra_tempos()
    {
        $this->viewData->anos = $this->list_anos($_SESSION['user_id']);
        $this->viewData->torneiosParticipados = $this->list_torneios($_SESSION['user_id']);
        $this->viewData->estilos = $this->list_estilos($_SESSION['user_id']);

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

    public function graficos_tempo()
    {
        Assets::authenticate();

        $this->viewData->anos = $this->list_anos($_SESSION['user_id']);
        $this->viewData->torneiosParticipados = $this->list_torneios($_SESSION['user_id']);
        $this->viewData->estilos = $this->list_estilos($_SESSION['user_id']);

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

        $this->render('graficos_tempo');
    }

    public function graficos_tempo_filtrado()
    {
        $this->viewData->anos = $this->list_anos($_SESSION['user_id']);
        $this->viewData->torneiosParticipados = $this->list_torneios($_SESSION['user_id']);
        $this->viewData->estilos = $this->list_estilos($_SESSION['user_id']);

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
        $indices_data = $indices->getIndicesFiltered();
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


    // Funcões auxiliares para filtro de provas do atleta
    public function list_anos($user_id)
    {
        $tempos = Container::getModel('Tempo');
        $tempos->__set('id_atleta', $user_id);
        $tempos_data = $tempos->getTempo();

        foreach ($tempos_data as $key => $value) {
            $ano = (explode('-', $value['dataTorneio']))[0];
            $anos[] = $ano;
        }
        return array_unique($anos);
    }
    public function list_torneios($user_id)
    {
        $torneios = Container::getModel('Tempo');
        $torneios->__set('id_atleta', $user_id);
        $torneios_data = $torneios->getTempo();

        foreach ($torneios_data as $key => $value) {
            $torneio[] = $value['nomeTorneio'];
        }
        return array_unique($torneio);
    }
    public function list_estilos($user_id)
    {
        $estilos = Container::getModel('Tempo');
        $estilos->__set('id_atleta', $user_id);
        $estilos_data = $estilos->getTempo();

        foreach ($estilos_data as $key => $value) {
            $estilo[] = $value['distancia'] . ' m ' . $value['nomeEstilo'] . '*' . $value['distanciaEstilo'];
            // print_r($estilo);
        }
        return array_unique($estilo);
    }
}
