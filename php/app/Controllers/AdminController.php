<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

session_start([
    'cookie_lifetime' => 86400,
]);
class AdminController extends Action
{
    public function index_admin(): void
    {
        Assets::admin_authenticate();

        $this->viewData->count_complexos = Assets::count_complexos();
        $this->viewData->count_equipes = Assets::count_equipes();
        $this->viewData->count_atletas = Assets::count_atletas();
        $this->viewData->count_torneios = Assets::count_torneios();

        $this->render('index_admin', 'admin_layout');
    }
    public function select_atleta(): void
    {
        Assets::admin_authenticate();

        $this->render('select_atleta', 'admin_layout');
    }

    public function user_admin(): void
    {
        Assets::admin_authenticate();

        $users = Container::getModel('Users');
        $users_data = $users->getAllUsers();
        $this->viewData->users = $users_data;

        $this->render('user_admin', 'admin_layout');
    }
    public function atleta_admin(): void
    {
        Assets::admin_authenticate();

        $atletas = Container::getModel('Atleta');
        $atletas_data = $atletas->getAllAtletas();
        $this->viewData->atletas = $atletas_data;

        $this->render('atleta_admin', 'admin_layout');
    }
    public function indice_admin(): void
    {
        Assets::admin_authenticate();

        $indices = Container::getModel('Indices');
        $indices_data = $indices->getIndicesFiltered();
        $this->viewData->indices = $indices_data;

        $this->viewData->anosIndice = GenerateLists::list_anos_indices();
        $this->viewData->tipoIndice = GenerateLists::list_tipos();
        $this->viewData->categorias = GenerateLists::list_categorias();
        $this->viewData->piscinas = GenerateLists::list_piscinas();
        $this->viewData->estilos = GenerateLists::list_todos_estilos();

        $this->render('indice_admin', 'admin_layout');
    }

    public function view_indice(): void
    {
        Assets::admin_authenticate();

        $indice = Container::getModel('Indices');
        $indice->__set('idindice', $_GET['id']);
        $indice_data = $indice->getIndiceFiltered();
        $this->viewData->indice = $indice_data;

        $this->viewData->anosIndice = GenerateLists::list_anos_indices();
        $this->viewData->tipoIndice = GenerateLists::list_tipos();
        $this->viewData->categorias = GenerateLists::list_categorias();
        $this->viewData->piscinas = GenerateLists::list_piscinas();
        $this->viewData->estilos = GenerateLists::list_todos_estilos();

        $this->render('view_indice', 'admin_layout');
    }
    public function recordes_admin(): void
    {
        Assets::admin_authenticate();

        $recordes = Container::getModel('Recordes');
        $recordes_data = $recordes->getRecordesFiltered();
        $this->viewData->recordes = $recordes_data;

        $this->viewData->tipoRecorde = GenerateLists::list_tipos_recorde();
        $this->viewData->categorias = GenerateLists::list_categorias();
        $this->viewData->piscinas = GenerateLists::list_piscinas();
        $this->viewData->estilos = GenerateLists::list_todos_estilos();

        $this->render('recordes_admin', 'admin_layout');
    }
    public function filtra_indices_tabela(): void
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
        $this->viewData->estilos = GenerateLists::list_todos_estilos();
        $this->render('indice_admin', 'admin_layout');
    }

    public function complexo_admin(): void
    {
        Assets::admin_authenticate();
        $this->viewData->piscinas = GenerateLists::list_complexos();
        $this->render('complexo_admin', 'admin_layout');
    }

    public function federacao_admin(): void
    {
        Assets::admin_authenticate();
        $this->viewData->federacoes = GenerateLists::list_federacoes();
        $this->render('federacao_admin', 'admin_layout');
    }
    public function equipe_admin(): void
    {
        Assets::admin_authenticate();
        $this->viewData->equipes = GenerateLists::list_equipes();
        $this->render('equipe_admin', 'admin_layout');
    }
    public function torneio_admin(): void
    {
        Assets::admin_authenticate();
        $this->viewData->torneios = GenerateLists::list_torneios();
        $this->render('torneio_admin', 'admin_layout');
    }
    public function prova_admin(): void
    {
        Assets::admin_authenticate();
        $this->viewData->torneios = GenerateLists::list_torneios();

        if (isset($_POST['idtorneio'])) {
            $prova = Container::getModel('Prova');
            $prova->__set('id_torneio', $_POST['idtorneio'] ?? '');
            $provas = $prova->getProvasTorneio();
            $this->viewData->provas = $provas;
        }
        $this->render('prova_admin', 'admin_layout');
    }
}
