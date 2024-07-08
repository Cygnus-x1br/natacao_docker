<?php


namespace App;

class Route extends \MF\Init\Bootstrap
{
    public function initRoutes()
    {
        $routes['home'] = array(
            'route' => '/',
            'controller' => 'IndexController',
            'action' => 'index'
        );
        $routes['register'] = array(
            'route' => '/register',
            'controller' => 'IndexController',
            'action' => 'register'
        );
        // Error
        $routes['error'] = array(
            'route' => '/error',
            'controller' => 'ErrorController',
            'action' => 'error'
        );
        // Signin
        $routes['signin'] = array(
            'route' => '/sign_in',
            'controller' => 'SignInController',
            'action' => 'sign_in'
        );
        $routes['log_out'] = array(
            'route' => '/log_out',
            'controller' => 'SignInController',
            'action' => 'log_out'
        );
        $routes['authenticate'] = array(
            'route' => '/authenticate',
            'controller' => 'SignInController',
            'action' => 'authenticate'
        );
        // Admin
        $routes['index_admin'] = array(
            'route' => '/index_admin',
            'controller' => 'AdminController',
            'action' => 'index_admin'
        );
        $routes['select_atleta'] = array(
            'route' => '/select_atleta',
            'controller' => 'AdminController',
            'action' => 'select_atleta'
        );

        $routes['user_admin'] = array(
            'route' => '/user_admin',
            'controller' => 'AdminController',
            'action' => 'user_admin'
        );
        $routes['atleta_admin'] = array(
            'route' => '/atleta_admin',
            'controller' => 'AdminController',
            'action' => 'atleta_admin'
        );
        $routes['complexo_admin'] = array(
            'route' => '/complexo_admin',
            'controller' => 'AdminController',
            'action' => 'complexo_admin'
        );
        $routes['indice_admin'] = array(
            'route' => '/indice_admin',
            'controller' => 'AdminController',
            'action' => 'indice_admin'
        );
        $routes['filtra_indices_tabela'] = array(
            'route' => '/filtra_indices_tabela',
            'controller' => 'AdminController',
            'action' => 'filtra_indices_tabela'
        );
        $routes['federacao_admin'] = array(
            'route' => '/federacao_admin',
            'controller' => 'AdminController',
            'action' => 'federacao_admin'
        );
        $routes['equipe_admin'] = array(
            'route' => '/equipe_admin',
            'controller' => 'AdminController',
            'action' => 'equipe_admin'
        );
        $routes['torneio_admin'] = array(
            'route' => '/torneio_admin',
            'controller' => 'AdminController',
            'action' => 'torneio_admin'
        );
        $routes['recordes_admin'] = array(
            'route' => '/recordes_admin',
            'controller' => 'AdminController',
            'action' => 'recordes_admin'
        );
        // User
        $routes['add_atleta'] = array(
            'route' => '/add_atleta',
            'controller' => 'UserController',
            'action' => 'add_atleta'
        );
        $routes['create_user'] = array(
            'route' => '/create_user',
            'controller' => 'UserController',
            'action' => 'create_user'
        );
        $routes['save_user'] = array(
            'route' => '/save_user',
            'controller' => 'UserController',
            'action' => 'save_user'
        );
        $routes['save_atleta'] = array(
            'route' => '/save_atleta',
            'controller' => 'UserController',
            'action' => 'save_atleta'
        );
        // Atletas
        $routes['index_atleta'] = array(
            'route' => '/index_atleta',
            'controller' => 'AtletaController',
            'action' => 'index_atleta'
        );
        $routes['view_atleta'] = array(
            'route' => '/view_atleta',
            'controller' => 'AtletaController',
            'action' => 'view_atleta'
        );
        $routes['edit_atleta'] = array(
            'route' => '/edit_atleta',
            'controller' => 'AtletaController',
            'action' => 'edit_atleta'
        );
        $routes['update_atleta'] = array(
            'route' => '/update_atleta',
            'controller' => 'AtletaController',
            'action' => 'update_atleta'
        );
        $routes['insert_atleta'] = array(
            'route' => '/insert_atleta',
            'controller' => 'AtletaController',
            'action' => 'insert_atleta'
        );
        $routes['delete_atleta'] = array(
            'route' => '/delete_atleta',
            'controller' => 'AtletaController',
            'action' => 'delete_atleta'
        );

        //Tempos
        $routes['tempos_atleta'] = array(
            'route' => '/tempos_atleta',
            'controller' => 'TempoController',
            'action' => 'tempos_atleta'
        );
        $routes['add_tempo'] = array(
            'route' => '/add_tempo',
            'controller' => 'TempoController',
            'action' => 'add_tempo'
        );
        $routes['save_tempo'] = array(
            'route' => '/save_tempo',
            'controller' => 'TempoController',
            'action' => 'save_tempo'
        );
        $routes['filtra_tempos'] = array(
            'route' => '/filtra_tempos',
            'controller' => 'TempoController',
            'action' => 'filtra_tempos'
        );
        $routes['edit_tempo'] = array(
            'route' => '/edit_tempo',
            'controller' => 'TempoController',
            'action' => 'edit_tempo'
        );
        $routes['update_tempo'] = array(
            'route' => '/update_tempo',
            'controller' => 'TempoController',
            'action' => 'update_tempo'
        );
        $routes['delete_tempo'] = array(
            'route' => '/delete_tempo',
            'controller' => 'TempoController',
            'action' => 'delete_tempo'
        );
        // Gráficos
        $routes['create_graph'] = array(
            'route' => '/create_graph',
            'controller' => 'GraficosController',
            'action' => 'create_graph'
        );
        $routes['graficos_tempo'] = array(
            'route' => '/graficos_tempo',
            'controller' => 'GraficosController',
            'action' => 'graficos_tempo'
        );
        $routes['graficos_tempo_filtrado'] = array(
            'route' => '/graficos_tempo_filtrado',
            'controller' => 'GraficosController',
            'action' => 'graficos_tempo_filtrado'
        );
        // Equipes
        $routes['list_equipes'] = array(
            'route' => '/list_equipes',
            'controller' => 'EquipeController',
            'action' => 'list_equipes'
        );
        $routes['view_equipe'] = array(
            'route' => '/view_equipe',
            'controller' => 'EquipeController',
            'action' => 'view_equipe'
        );
        $routes['add_equipe'] = array(
            'route' => '/add_equipe',
            'controller' => 'EquipeController',
            'action' => 'add_equipe'
        );
        $routes['edit_equipe'] = array(
            'route' => '/edit_equipe',
            'controller' => 'EquipeController',
            'action' => 'edit_equipe'
        );
        $routes['save_equipe'] = array(
            'route' => '/save_equipe',
            'controller' => 'EquipeController',
            'action' => 'save_equipe'
        );
        $routes['update_equipe'] = array(
            'route' => '/update_equipe',
            'controller' => 'EquipeController',
            'action' => 'update_equipe'
        );
        $routes['delete_equipe'] = array(
            'route' => '/delete_equipe',
            'controller' => 'EquipeController',
            'action' => 'delete_equipe'
        );
        // Federacoes
        $routes['list_federacao'] = array(
            'route' => '/list_federacao',
            'controller' => 'FederacaoController',
            'action' => 'list_federacao'
        );
        $routes['edit_federacao'] = array(
            'route' => '/edit_federacao',
            'controller' => 'FederacaoController',
            'action' => 'edit_federacao'
        );
        $routes['add_federacao'] = array(
            'route' => '/add_federacao',
            'controller' => 'FederacaoController',
            'action' => 'add_federacao'
        );
        $routes['save_federacao'] = array(
            'route' => '/save_federacao',
            'controller' => 'FederacaoController',
            'action' => 'save_federacao'
        );
        $routes['update_federacao'] = array(
            'route' => '/update_federacao',
            'controller' => 'FederacaoController',
            'action' => 'update_federacao'
        );
        $routes['delete_federacao'] = array(
            'route' => '/delete_federacao',
            'controller' => 'FederacaoController',
            'action' => 'delete_federacao'
        );
        // Complexos
        $routes['list_complexos'] = array(
            'route' => '/list_complexos',
            'controller' => 'ComplexoController',
            'action' => 'list_complexos'
        );
        $routes['view_complexo'] = array(
            'route' => '/view_complexo',
            'controller' => 'ComplexoController',
            'action' => 'view_complexo'
        );
        $routes['add_complexo'] = array(
            'route' => '/add_complexo',
            'controller' => 'ComplexoController',
            'action' => 'add_complexo'
        );
        $routes['save_complexo'] = array(
            'route' => '/save_complexo',
            'controller' => 'ComplexoController',
            'action' => 'save_complexo'
        );
        $routes['edit_complexo'] = array(
            'route' => '/edit_complexo',
            'controller' => 'ComplexoController',
            'action' => 'edit_complexo'
        );
        $routes['update_complexo'] = array(
            'route' => '/update_complexo',
            'controller' => 'ComplexoController',
            'action' => 'update_complexo'
        );
        $routes['delete_complexo'] = array(
            'route' => '/delete_complexo',
            'controller' => 'ComplexoController',
            'action' => 'delete_complexo'
        );
        // Torneios
        $routes['add_torneio'] = array(
            'route' => '/add_torneio',
            'controller' => 'TorneioController',
            'action' => 'add_torneio'
        );
        $routes['save_torneio'] = array(
            'route' => '/save_torneio',
            'controller' => 'TorneioController',
            'action' => 'save_torneio'
        );
        $routes['list_torneios'] = array(
            'route' => '/list_torneios',
            'controller' => 'TorneioController',
            'action' => 'list_torneios'
        );
        $routes['view_torneio'] = array(
            'route' => '/view_torneio',
            'controller' => 'TorneioController',
            'action' => 'view_torneio'
        );
        $routes['delete_torneio'] = array(
            'route' => '/delete_torneio',
            'controller' => 'TorneioController',
            'action' => 'delete_torneio'
        );
        // Indices
        $routes['list_indices'] = array(
            'route' => '/list_indices',
            'controller' => 'IndicesController',
            'action' => 'list_indices'
        );
        $routes['filtra_indices'] = array(
            'route' => '/filtra_indices',
            'controller' => 'IndicesController',
            'action' => 'filtra_indices'
        );
        $routes['add_indice'] = array(
            'route' => '/add_indice',
            'controller' => 'IndicesController',
            'action' => 'add_indice'
        );
        $routes['save_indice'] = array(
            'route' => '/save_indice',
            'controller' => 'IndicesController',
            'action' => 'save_indice'
        );
        // Recordes
        $routes['list_recordes'] = array(
            'route' => '/list_recordes',
            'controller' => 'RecordesController',
            'action' => 'list_recordes'
        );
        $routes['filtra_recordes'] = array(
            'route' => '/filtra_recordes',
            'controller' => 'RecordesController',
            'action' => 'filtra_recordes'
        );
        $routes['add_recordes'] = array(
            'route' => '/add_recordes',
            'controller' => 'RecordesController',
            'action' => 'add_recordes'
        );
        $routes['save_recorde'] = array(
            'route' => '/save_recorde',
            'controller' => 'RecordesController',
            'action' => 'save_recorde'
        );
        $routes['edit_recorde'] = array(
            'route' => '/edit_recorde',
            'controller' => 'RecordesController',
            'action' => 'edit_recorde'
        );
        $routes['update_recorde'] = array(
            'route' => '/update_recorde',
            'controller' => 'RecordesController',
            'action' => 'update_recorde'
        );
        $routes['delete_recorde'] = array(
            'route' => '/delete_recorde',
            'controller' => 'RecordesController',
            'action' => 'delete_recorde'
        );
        //Provas
        $routes['list_provas'] = array(
            'route' => '/list_provas',
            'controller' => 'ProvaController',
            'action' => 'list_provas'
        );
        $routes['add_prova'] = array(
            'route' => '/add_prova',
            'controller' => 'ProvaController',
            'action' => 'add_prova'
        );
        $routes['save_prova'] = array(
            'route' => '/save_prova',
            'controller' => 'ProvaController',
            'action' => 'save_prova'
        );


        $this->setRoutes($routes);
    }
}
