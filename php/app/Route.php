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

        $routes['select_atleta'] = array(
            'route' => '/select_atleta',
            'controller' => 'AtletaController',
            'action' => 'select_atleta'
        );
        $routes['view_atleta'] = array(
            'route' => '/view_atleta',
            'controller' => 'AtletaController',
            'action' => 'view_atleta'
        );
        $routes['index_atleta'] = array(
            'route' => '/index_atleta',
            'controller' => 'AtletaController',
            'action' => 'index_atleta'
        );
        $routes['add_atleta'] = array(
            'route' => '/add_atleta',
            'controller' => 'AtletaController',
            'action' => 'add_atleta'
        );
        $routes['save_atleta'] = array(
            'route' => '/save_atleta',
            'controller' => 'AtletaController',
            'action' => 'save_atleta'
        );
        $routes['edit_atleta'] = array(
            'route' => '/edit_atleta',
            'controller' => 'AtletaController',
            'action' => 'edit_atleta'
        );
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
        $routes['list_federacao'] = array(
            'route' => '/list_federacao',
            'controller' => 'FederacaoController',
            'action' => 'list_federacao'
        );
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
        // $routes['view_note'] = array(
        //     'route' => '/view_note',
        //     'controller' => 'IndexController',
        //     'action' => 'view_note'
        // );
        // $routes['view_all_curses'] = array(
        //     'route' => '/view_all_curses',
        //     'controller' => 'IndexController',
        //     'action' => 'view_all_curses'
        // );
        // $routes['search'] = array(
        //     'route' => '/search',
        //     'controller' => 'IndexController',
        //     'action' => 'search'
        // );

        // $routes['signin'] = array(
        //     'route' => '/signin',
        //     'controller' => 'SigninController',
        //     'action' => 'signin'
        // );
        // $routes['log_out'] = array(
        //     'route' => '/log_out',
        //     'controller' => 'SigninController',
        //     'action' => 'log_out'
        // );
        // $routes['authenticate'] = array(
        //     'route' => '/authenticate',
        //     'controller' => 'SigninController',
        //     'action' => 'authenticate'
        // );
        // $routes['add_user'] = array(
        //     'route' => '/add_user',
        //     'controller' => 'UserController',
        //     'action' => 'add_user'
        // );
        // $routes['list_user'] = array(
        //     'route' => '/list_user',
        //     'controller' => 'UserController',
        //     'action' => 'list_user'
        // );

        // $routes['add_note'] = array(
        //     'route' => '/add_note',
        //     'controller' => 'NoteController',
        //     'action' => 'add_note'
        // );
        // $routes['edit_note'] = array(
        //     'route' => '/edit_note',
        //     'controller' => 'NoteController',
        //     'action' => 'edit_note'
        // );
        // $routes['save_note'] = array(
        //     'route' => '/save_note',
        //     'controller' => 'NoteController',
        //     'action' => 'save_note'
        // );
        // $routes['change_note'] = array(
        //     'route' => '/change_note',
        //     'controller' => 'NoteController',
        //     'action' => 'change_note'
        // );
        // $routes['delete_note'] = array(
        //     'route' => '/delete_note',
        //     'controller' => 'NoteController',
        //     'action' => 'delete_note'
        // );
        // $routes['list_notes'] = array(
        //     'route' => '/list_notes',
        //     'controller' => 'NoteController',
        //     'action' => 'list_notes'
        // );

        // $routes['add_subject'] = array(
        //     'route' => '/add_subject',
        //     'controller' => 'SubjectController',
        //     'action' => 'add_subject'
        // );
        // $routes['edit_subject'] = array(
        //     'route' => '/edit_subject',
        //     'controller' => 'SubjectController',
        //     'action' => 'edit_subject'
        // );
        // $routes['save_subject'] = array(
        //     'route' => '/save_subject',
        //     'controller' => 'SubjectController',
        //     'action' => 'save_subject'
        // );
        // $routes['change_subject'] = array(
        //     'route' => '/change_subject',
        //     'controller' => 'SubjectController',
        //     'action' => 'change_subject'
        // );
        // $routes['delete_subject'] = array(
        //     'route' => '/delete_subject',
        //     'controller' => 'SubjectController',
        //     'action' => 'delete_subject'
        // );
        // $routes['list_subjects'] = array(
        //     'route' => '/list_subjects',
        //     'controller' => 'SubjectController',
        //     'action' => 'list_subjects'
        // );

        // $routes['add_school'] = array(
        //     'route' => '/add_school',
        //     'controller' => 'SchoolController',
        //     'action' => 'add_school'
        // );
        // $routes['edit_school'] = array(
        //     'route' => '/edit_school',
        //     'controller' => 'SchoolController',
        //     'action' => 'edit_school'
        // );
        // $routes['save_school'] = array(
        //     'route' => '/save_school',
        //     'controller' => 'SchoolController',
        //     'action' => 'save_school'
        // );
        // $routes['change_school'] = array(
        //     'route' => '/change_school',
        //     'controller' => 'SchoolController',
        //     'action' => 'change_school'
        // );
        // $routes['delete_school'] = array(
        //     'route' => '/delete_school',
        //     'controller' => 'SchoolController',
        //     'action' => 'delete_school'
        // );
        // $routes['list_schools'] = array(
        //     'route' => '/list_schools',
        //     'controller' => 'SchoolController',
        //     'action' => 'list_schools'
        // );

        // $routes['add_curse'] = array(
        //     'route' => '/add_curse',
        //     'controller' => 'CurseController',
        //     'action' => 'add_curse'
        // );
        // $routes['edit_curse'] = array(
        //     'route' => '/edit_curse',
        //     'controller' => 'CurseController',
        //     'action' => 'edit_curse'
        // );
        // $routes['save_curse'] = array(
        //     'route' => '/save_curse',
        //     'controller' => 'CurseController',
        //     'action' => 'save_curse'
        // );
        // $routes['change_curse'] = array(
        //     'route' => '/change_curse',
        //     'controller' => 'CurseController',
        //     'action' => 'change_curse'
        // );
        // $routes['delete_curse'] = array(
        //     'route' => '/delete_curse',
        //     'controller' => 'CurseController',
        //     'action' => 'delete_curse'
        // );
        // $routes['list_selected_curses'] = array(
        //     'route' => '/list_selected_curses',
        //     'controller' => 'CurseController',
        //     'action' => 'list_selected_curses'
        // );
        // $routes['list_curses'] = array(
        //     'route' => '/list_curses',
        //     'controller' => 'CurseController',
        //     'action' => 'list_curses'
        // );

        // $routes['add_subtitle'] = array(
        //     'route' => '/add_subtitle',
        //     'controller' => 'SubtitleController',
        //     'action' => 'add_subtitle'
        // );
        // $routes['edit_subtitle'] = array(
        //     'route' => '/edit_subtitle',
        //     'controller' => 'SubtitleController',
        //     'action' => 'edit_subtitle'
        // );
        // $routes['save_subtitle'] = array(
        //     'route' => '/save_subtitle',
        //     'controller' => 'SubtitleController',
        //     'action' => 'save_subtitle'
        // );
        // $routes['change_subtitle'] = array(
        //     'route' => '/change_subtitle',
        //     'controller' => 'SubtitleController',
        //     'action' => 'change_subtitle'
        // );
        // $routes['delete_subtitle'] = array(
        //     'route' => '/delete_subtitle',
        //     'controller' => 'SubtitleController',
        //     'action' => 'delete_subtitle'
        // );
        // $routes['list_subtitles'] = array(
        //     'route' => '/list_subtitles',
        //     'controller' => 'SubtitleController',
        //     'action' => 'list_subtitles'
        // );

        // $routes['add_class'] = array(
        //     'route' => '/add_class',
        //     'controller' => 'ClassController',
        //     'action' => 'add_class'
        // );
        // $routes['edit_class'] = array(
        //     'route' => '/edit_class',
        //     'controller' => 'ClassController',
        //     'action' => 'edit_class'
        // );
        // $routes['save_class'] = array(
        //     'route' => '/save_class',
        //     'controller' => 'ClassController',
        //     'action' => 'save_class'
        // );
        // $routes['change_class'] = array(
        //     'route' => '/change_class',
        //     'controller' => 'ClassController',
        //     'action' => 'change_class'
        // );
        // $routes['delete_class'] = array(
        //     'route' => '/delete_class',
        //     'controller' => 'ClassController',
        //     'action' => 'delete_class'
        // );
        // $routes['list_classes'] = array(
        //     'route' => '/list_classes',
        //     'controller' => 'ClassController',
        //     'action' => 'list_classes'
        // );
        // $routes['view_classes'] = array(
        //     'route' => '/view_classes',
        //     'controller' => 'ClassController',
        //     'action' => 'view_classes'
        // );
        // $routes['view_class'] = array(
        //     'route' => '/view_class',
        //     'controller' => 'ClassController',
        //     'action' => 'view_class'
        // );


        $this->setRoutes($routes);
    }
}
