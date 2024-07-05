<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

session_start([
    'cookie_lifetime' => 86400,
]);
class ComplexoController extends Action
{
    public function list_complexos()
    {
        $complexos = Container::getModel('Complexo');
        $complexos_data = $complexos->getAllComplexos();
        $this->viewData->complexos = $complexos_data;

        $this->render('list_complexos');
    }

    /** Funções de CRUD */
    public function view_complexo()
    {

        $this->viewData->estados = Assets::list_estados();

        $complexo = Container::getModel('Complexo');
        $complexo->__set('idcomplexo', $_GET['idcomplexo']);
        $complexo_data = $complexo->getComplexo();
        $this->viewData->complexo = $complexo_data;

        $this->render('view_complexo');
    }

    public function add_complexo()
    {
        Assets::authenticate();

        $this->viewData->estados = Assets::list_estados();

        $this->render('add_complexo');
    }
    public function save_complexo()
    {
        Assets::authenticate();

        if ($_POST['nomeComplexo'] == '') {
            header("Location: /add_complexo?error=1");
        } elseif ($_POST['id_estado'] == '') {
            header("Location: /add_complexo?error=2");
        }

        $complexo = Container::getModel('Complexo');
        if (($_FILES['fotoComplexo']['size'] !== 0)) {
            $file_save = $this->upload_file();
            $complexo->__set('fotoComplexo', $file_save);
        }
        $complexo->__set('nomeComplexo', $_POST['nomeComplexo']);
        $complexo->__set('nomeFantasiaComplexo', $_POST['nomeFantasiaComplexo']);
        $complexo->__set('enderecoComplexo', $_POST['enderecoComplexo']);
        $complexo->__set('bairroComplexo', $_POST['bairroComplexo']);
        // $complexo->__set('cepComplexo', $_POST['cepComplexo']);
        $complexo->__set('cidadeComplexo', $_POST['cidadeComplexo']);
        // $complexo->__set('latitudeComplexo', $_POST['latitudeComplexo']);
        // $complexo->__set('longitudeComplexo', $_POST['longitudeComplexo']);
        $complexo->__set('observacaoComplexo', $_POST['observacaoComplexo']);
        $complexo->__set('id_estado', $_POST['id_estado']);

        $complexo->saveComplexo();

        header("Location: /list_complexos");
    }

    public function edit_complexo()
    {
        Assets::admin_authenticate();

        $this->viewData->estados = Assets::list_estados();

        $complexo = Container::getModel('Complexo');
        $complexo->__set('idcomplexo', $_GET['idcomplexo']);
        $complexo_data = $complexo->getComplexo();
        $this->viewData->complexo = $complexo_data;

        $this->render('edit_complexo', 'admin_layout');
    }
    public function update_complexo()
    {
        if ($_POST['nomeComplexo'] == '') {
            header("Location: /add_complexo?error=1");
        } elseif ($_POST['id_estado'] == '') {
            header("Location: /add_complexo?error=2");
        }

        $complexo = Container::getModel('Complexo');
        if (($_FILES['fotoComplexo']['size'] !== 0)) {
            $file_save = $this->upload_file();
            $complexo->__set('fotoComplexo', $file_save);
        } elseif ($_FILES['fotoComplexo']['size'] === 0) {
            $complexo->__set('fotoComplexo', $_POST['fotoAntiga']);
        }

        $complexo->__set('nomeComplexo', $_POST['nomeComplexo']);
        $complexo->__set('nomeFantasiaComplexo', $_POST['nomeFantasiaComplexo']);
        $complexo->__set('enderecoComplexo', $_POST['enderecoComplexo']);
        $complexo->__set('bairroComplexo', $_POST['bairroComplexo']);
        // $complexo->__set('cepComplexo', $_POST['cepComplexo']);
        $complexo->__set('cidadeComplexo', $_POST['cidadeComplexo']);
        // $complexo->__set('latitudeComplexo', $_POST['latitudeComplexo']);
        // $complexo->__set('longitudeComplexo', $_POST['longitudeComplexo']);
        $complexo->__set('observacaoComplexo', $_POST['observacaoComplexo']);
        $complexo->__set('id_estado', $_POST['id_estado']);
        $complexo->__set('idcomplexo', $_POST['idcomplexo']);

        $complexo->updateComplexo();

        header("Location: /complexo_admin");
    }

    public function delete_complexo()
    {
        Assets::admin_authenticate();

        $complexo = Container::getModel('Complexo');
        $complexo->__set('idcomplexo', $_GET['idcomplexo']);
        $complexo->deleteComplexo();

        header('Location: /complexo_admin');
    }

    /** Funções auxiliares */

    private function upload_file()
    {
        $file = $_FILES['fotoComplexo'];
        $ext = explode('.', $file['name']);
        $extensao = end($ext);
        $allowedTypes = [
            'image/gif',
            'image/jpg',
            'image/jpeg',
            'image/png',
        ];
        if (!in_array($file['type'], $allowedTypes)) {
            header('Location: add_complexo?file_type=error');
            exit;
        }

        $tmp_file = $file['tmp_name'];
        $path = './images/fotos/';
        $save_file = $path . 'piscina_' . str_replace(' ', '', mb_convert_encoding($_POST['nomeFantasiaComplexo'], "UTF-8")) . '.' . $extensao;
        $teste = move_uploaded_file($tmp_file, $save_file);
        if ($teste == 1) {
            return $save_file;
        } else {
            return '';
        }
    }
}
