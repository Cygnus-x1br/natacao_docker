<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

session_start([
    'cookie_lifetime' => 86400,
]);
class AdminController extends Action
{
    public function index_admin():void
    {
        Assets::admin_authenticate();

        $this->viewData->count_complexos = Assets::count_complexos();
        $this->viewData->count_equipes = Assets::count_equipes();
        $this->viewData->count_atletas = Assets::count_atletas();
        $this->viewData->count_torneios = Assets::count_torneios();

        $this->render('index_admin', 'admin_layout');
    }
    public function select_atleta():void
    {
        Assets::admin_authenticate();

        $this->render('select_atleta', 'admin_layout');
    }

    public function user_admin():void
    {
        Assets::admin_authenticate();

        $users = Container::getModel('Users');
        $users_data = $users->getAllUsers();
        $this->viewData->users = $users_data;

        $this->render('user_admin', 'admin_layout');
    }
    public function atleta_admin():void
    {
        Assets::admin_authenticate();

        $atletas = Container::getModel('Atleta');
        $atletas_data = $atletas->getAllAtletas();
        $this->viewData->atletas = $atletas_data;

        $this->render('atleta_admin', 'admin_layout');
    }
    public function indice_admin():void
    {
        Assets::admin_authenticate();

        $indices = Container::getModel('Indices');
        $indices_data = $indices->getIndicesFiltered();
        $this->viewData->indices = $indices_data;

        $this->viewData->anosIndice = Assets::list_anos_indices();
        $this->viewData->tipoIndice = Assets::list_tipos();
        $this->viewData->categorias = Assets::list_categorias();
        $this->viewData->piscinas = Assets::list_piscinas();
        $this->viewData->estilos = Assets::list_todos_estilos();

        $this->render('indice_admin', 'admin_layout');
    }
    public function recordes_admin():void
    {
        Assets::admin_authenticate();

        $recordes = Container::getModel('Recordes');
        $recordes_data = $recordes->getRecordesFiltered();
        $this->viewData->recordes = $recordes_data;

        $this->viewData->tipoRecorde = Assets::list_tipos_recorde();
        $this->viewData->categorias = Assets::list_categorias();
        $this->viewData->piscinas = Assets::list_piscinas();
        $this->viewData->estilos = Assets::list_todos_estilos();

        $this->render('recordes_admin', 'admin_layout');
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

        $this->viewData->anosIndice = Assets::list_anos_indices();
        $this->viewData->tipoIndice = Assets::list_tipos();
        $this->viewData->categorias = Assets::list_categorias();
        $this->viewData->piscinas = Assets::list_piscinas();
        $this->viewData->estilos = Assets::list_todos_estilos();
        $this->render('indice_admin', 'admin_layout');
    }

    public function complexo_admin():void
    {
        Assets::admin_authenticate();
        $this->viewData->piscinas = Assets::list_complexos();
        $this->render('complexo_admin', 'admin_layout');
    }

    public function federacao_admin():void
    {
        Assets::admin_authenticate();
        $this->viewData->federacoes = Assets::list_federacoes();
        $this->render('federacao_admin', 'admin_layout');
    }
    public function equipe_admin():void
    {
        Assets::admin_authenticate();
        $this->viewData->equipes = Assets::list_equipes();
        $this->render('equipe_admin', 'admin_layout');
    }
    public function torneio_admin():void
    {
        Assets::admin_authenticate();
        $this->viewData->torneios = Assets::list_torneios();
        $this->render('torneio_admin', 'admin_layout');
    }
}
