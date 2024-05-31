<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

session_start();
class ComplexoController extends Action
{
    public function list_complexos()
    {
        $complexos = Container::getModel('Complexo');
        $complexos_data = $complexos->getAllComplexos();
        $this->viewData->complexos = $complexos_data;

        $this->render('list_complexos');
    }
    public function view_complexo()
    {
        $estado = Container::getModel('Estados');
        $estado_data = $estado->getAllEstados();
        $this->viewData->estados = $estado_data;

        $complexo = Container::getModel('Complexo');
        $complexo->__set('idcomplexo', $_GET['idcomplexo']);
        $complexo_data = $complexo->getComplexo();
        $this->viewData->complexo = $complexo_data;

        $this->render('view_complexo');
    }

    public function add_complexo()
    {
        $estado = Container::getModel('Estados');
        $estado_data = $estado->getAllEstados();
        $this->viewData->estados = $estado_data;

        $this->render('add_complexo');
    }
    public function save_complexo()
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
        // $equipe->__set('logoEquipe', $_POST['logoEquipe']);
        $complexo->__set('id_estado', $_POST['id_estado']);

        $complexo->addComplexo();

        header("Location: /list_complexos");
    }
    public function edit_complexo()
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
        // $equipe->__set('logoEquipe', $_POST['logoEquipe']);
        $complexo->__set('id_estado', $_POST['id_estado']);
        $complexo->__set('idcomplexo', $_POST['idcomplexo']);

        $complexo->editComplexo();

        header("Location: /list_complexos");
    }

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
