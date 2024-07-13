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
    public function create_graph():void
    {
        Assets::authenticate();
        $this->listDataFromModels();

        $provas = Container::getModel('Prova');
        $provas_data = $provas->getAllProvas();
        $this->viewData->provas = $provas_data;

        $tempoAtleta = Container::getModel('Tempo');
        $tempoAtleta->__set('id_atleta', $_SESSION['user_id']);
        $tempoAtleta_data = $tempoAtleta->getTemposFiltered();
        $this->viewData->tempoAtleta = $tempoAtleta_data;

        $this->render('create_graph');
    }

    public function graficos_tempo_filtrado():void
    {
        Assets::authenticate();
        if($_POST['distanciaEstilo'] == ''){
            header('Location: create_graph?error=1');
        }
        $this->listDataFromModels();

        $atleta = Container::getModel('Atleta');
        $atleta->__set('idatleta', $_SESSION['user_id']);
        $atleta_data = $atleta->getAtletabyID();
        $this->viewData->atleta = $atleta_data;
        
        $indicesMundial = Container::getModel('Recordes');
        $indicesMundial->__set('tipoRecorde', 'Recorde Mundial');
        $indice_data = $indicesMundial->getRecordesFiltered();
        $this->viewData->indices_mundial = $indice_data;

        $provas = Container::getModel('Prova');
        $provas_data = $provas->getAllProvas();
        $this->viewData->provas = $provas_data;

        
        $categoria = date('Y') - (explode('-', $atleta_data['dataNascAtleta']))[0];
        
        $indices = Container::getModel('Indices');
        $indices->__set('id_distanciaestilo', $_POST['distanciaEstilo']);
        $indices->__set('generoIndice', $atleta_data['sexoAtleta']);
        $indices->__set('id_categoria', Assets::adjustCategory($categoria));
        $indices->__set('tamanhoPiscina', $_POST['tamanhoPiscina']);
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

    /**
     * @return void
     */
    public function listDataFromModels(): void
    {
        $this->viewData->anos = GenerateLists::list_anos($_SESSION['user_id']);
        $this->viewData->torneiosParticipados = GenerateLists::list_torneios_atleta($_SESSION['user_id']);
        $this->viewData->estilos = GenerateLists::list_estilos($_SESSION['user_id']);
        $this->viewData->piscinas = GenerateLists::list_todas_piscinas();
        $this->viewData->torneios = GenerateLists::list_torneios();
        $this->viewData->distanciaEstilo = GenerateLists::list_todos_estilos();
        $this->viewData->categorias = GenerateLists::list_categorias();
    }
}
