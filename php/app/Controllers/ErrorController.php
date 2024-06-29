<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

session_start([
    'cookie_lifetime' => 86400,
]);
class ErrorController extends Action
{
    public function error()
    {
        $url = $_SERVER['HTTP_REFERER'] ?? '/';
        if ($_GET['error'] == 1001) {
            $this->setHtmlData->error = 'Voce deve estar logado para executar essa tarefa';
            $this->setHtmlData->url = $url;
        } elseif ($_GET['error'] == 1002) {
            $this->setHtmlData->error = 'Voce não tem permissao para acessar dados de atletas';
            $this->setHtmlData->url = $url;
        } elseif ($_GET['error'] == 1003) {
            $this->setHtmlData->error = 'Digite um nome válido';
            $this->setHtmlData->url = $url;
        } elseif ($_GET['error'] == 1004) {
            $this->setHtmlData->error = 'Digite uma data de nascimento válida';
            $this->setHtmlData->url = $url;
        } elseif ($_GET['error'] == 2001) {
            $this->setHtmlData->error = 'Usuário já cadastrado com esse nome e data de nascimento';
            $this->setHtmlData->url = $url;
        } elseif ($_GET['error'] == 2002) {
            $this->setHtmlData->error = 'Usuário já cadastrado com esse email';
            $this->setHtmlData->url = $url;
        } elseif ($_GET['error'] == 2003) {
            $this->setHtmlData->error = 'Usuário já cadastrado com esse cpf';
            $this->setHtmlData->url = $url;
        } elseif ($_GET['error'] == 2004) {
            $this->setHtmlData->error = 'Usuário já cadastrado com esse numero de registro';
            $this->setHtmlData->url = $url;
        } elseif ($_GET['error'] == 2005) {
            $this->setHtmlData->error = 'Número de CPF inválido';
            $this->setHtmlData->url = $url;
        } elseif ($_GET['error'] == 2006) {
            $this->setHtmlData->error = 'Senha inválida';
            $this->setHtmlData->url = $url;
        } elseif ($_GET['error'] == 3001) {
            $this->setHtmlData->error = 'Prova incompativel com o genero do atleta';
            $this->setHtmlData->url = $url;
        } elseif ($_GET['error'] == 3002) {
            $this->setHtmlData->error = 'Prova incompativel com a categoria do atleta';
            $this->setHtmlData->url = $url;
        } elseif ($_GET['error'] == 9001) {
            $this->setHtmlData->error = 'Função exclusiva para administradores';
            $this->setHtmlData->url = $url;
        } elseif ($_GET['error'] == 9999) {
            $this->setHtmlData->error = 'Usuário ou senha incorretos';
            $this->setHtmlData->url = $url;
        }
        $this->render('erro', 'error_layout');
    }
}
