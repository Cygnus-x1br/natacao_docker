<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

session_start([
    'cookie_lifetime' => 86400,
]);
class FederacaoController extends Action
{
    public function list_federacao():void
    {
        $federacao = Container::getModel('Federacao');
        $federacao_data = $federacao->getAllFederacoes();
        $this->viewData->federacoes = $federacao_data;

        $this->render('list_federacao');
    }

    /** Funções de CRUD */
    public function add_federacao():void
    {
        Assets::admin_authenticate();
        $this->viewData->estados = Assets::list_estados();

        $this->render('add_federacao', 'admin_layout');
    }

    public function save_federacao():void
    {
        Assets::admin_authenticate();
 
        $federacao = Container::getModel('Federacao');
        if (($_FILES['logoFederacao']['size'] !== 0)) {
            $file_save = $this->upload_file();
            $federacao->__set('logoFederacao', $file_save);
        }
        $this->setSaveAndUpdateFederacao($federacao);
        $federacao->addFederacao();
 
        header('Location: /federacao_admin');
    }

    public function edit_federacao():void
    {
        Assets::admin_authenticate();
        $this->viewData->estados = Assets::list_estados();

        $federacao = Container::getModel('Federacao');
        $federacao->__set('idfederacao', $_GET['idfederacao']);
        $federacao_data = $federacao->getFederacao();
        $this->viewData->federacao = $federacao_data;

        $this->render('edit_federacao', 'admin_layout');
    }

    public function update_federacao():void
    {
        Assets::admin_authenticate();

        $federacao = Container::getModel('Federacao');
        if (($_FILES['logoFederacao']['size'] !== 0)) {
            $file_save = $this->upload_file();
            $federacao->__set('logoFederacao', $file_save);
        } else {
            $federacao->__set('logoFederacao', $_POST['logoAntiga']);
        }
        $this->setSaveAndUpdateFederacao($federacao);
        $federacao->__set('idfederacao', $_POST['idfederacao']);
        $federacao->updateFederacao();

        header('Location: /federacao_admin');
    }

    public function delete_federacao():void
    {
        Assets::admin_authenticate();
        $federacao = Container::getModel('Federacao');
        $federacao->__set('idfederacao', $_GET['idfederacao']);
        $federacao->deleteFederacao();
  
        header('Location: /federacao_admin');
    }

    /** Funções auxiliares */

    /**
     * @param mixed $federacao
     * @return void
     */
    public function setSaveAndUpdateFederacao(mixed $federacao): void
    {
        $federacao->__set('nomeFederacao', $_POST['nomeFederacao']);
        $federacao->__set('nomeFantasiaFederacao', $_POST['nomeFantasiaFederacao']);
        $federacao->__set('siteFederacao', $_POST['siteFederacao']);
        $federacao->__set('emailFederacao', $_POST['emailFederacao']);
        $federacao->__set('telefoneFederacao', $_POST['telefoneFederacao']);
        $federacao->__set('facebookFederacao', $_POST['facebookFederacao']);
        $federacao->__set('instagramFederacao', $_POST['instagramFederacao']);
        $federacao->__set('id_estado', $_POST['id_estado']);
    }
    private function upload_file():string
    {
        $file = $_FILES['logoFederacao'];
        $ext = explode('.', $file['name']);
        $extensao = end($ext);
        $allowedTypes = [
            'image/gif',
            'image/jpg',
            'image/jpeg',
            'image/png',
        ];
        if (!in_array($file['type'], $allowedTypes)) {
            header('Location: add_federacao?file_type=error');
            exit;
        }

        $tmp_file = $file['tmp_name'];
        $path = './images/logos/';
        $save_file = $path . 'logo' . str_replace(' ', '', mb_convert_encoding($_POST['nomeFantasiaFederacao'], "UTF-8")) . '.' . $extensao;
        $teste = move_uploaded_file($tmp_file, $save_file);
        if ($teste == 1) {
            return $save_file;
        } else {
            return '';
        }
    }
}
