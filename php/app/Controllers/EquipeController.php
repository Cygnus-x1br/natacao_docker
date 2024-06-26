<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

session_start([
    'cookie_lifetime' => 86400,
]);
class EquipeController extends Action
{
    public function list_equipes()
    {
        $equipes = Container::getModel('Equipe');
        $equipes_data = $equipes->getAllEquipes();
        $this->viewData->equipes = $equipes_data;

        $this->render('list_equipes');
    }
    public function view_equipe()
    {
        Assets::authenticate();

        if (isset($_GET['edit']) && $_GET['edit'] == 'true') {
            $this->setHtmlData->edit = '';
        } else {
            $this->setHtmlData->edit = 'disabled';
        }
        $equipe = Container::getModel('Equipe');
        $equipe->__set('idequipe', $_GET['idequipe']);
        $equipe_data = $equipe->getEquipe();
        $this->viewData->equipe = $equipe_data;

        $federacao = Container::getModel('Federacao');
        $federacao_data = $federacao->getAllFederacoes();
        $this->viewData->federacoes = $federacao_data;

        $this->render('view_equipe');
    }

    public function add_equipe()
    {
        Assets::authenticate();

        $federacao = Container::getModel('Federacao');
        $federacao_data = $federacao->getAllFederacoes();
        $this->viewData->federacoes = $federacao_data;

        $this->render('add_equipe');
    }
    public function save_equipe()
    {
        Assets::authenticate();

        $federacao = Container::getModel('Federacao');
        $federacao_data = $federacao->getAllFederacoes();
        $this->viewData->federacoes = $federacao_data;

        if ($_POST['nomeEquipe'] == '') {
            header("Location: /add_equipe?error=1");
        } elseif ($_POST['id_federacao'] == '') {
            header("Location: /add_equipe?error=2");
        }

        $equipe = Container::getModel('Equipe');
        if (($_FILES['logoEquipe']['size'] !== 0)) {
            $file_save = $this->upload_file();
            $equipe->__set('logoEquipe', $file_save);
        }
        $equipe->__set('nomeEquipe', $_POST['nomeEquipe']);
        $equipe->__set('nomeFantasiaEquipe', $_POST['nomeFantasiaEquipe']);
        $equipe->__set('siteEquipe', $_POST['siteEquipe']);
        $equipe->__set('emailEquipe', $_POST['emailEquipe']);
        $equipe->__set('telefoneEquipe', $_POST['telefoneEquipe']);
        $equipe->__set('facebookEquipe', $_POST['facebookEquipe']);
        $equipe->__set('instagramEquipe', $_POST['instagramEquipe']);
        $equipe->__set('id_federacao', $_POST['id_federacao']);


        if ($equipe->verificaCadastro('nomeEquipe') != '') {
            header("Location: /add_equipe?error=3");
        } elseif ($equipe->verificaCadastro('nomeFantasiaEquipe') != '') {
            header("Location: /add_equipe?error=4");
        } else {
            $equipe->addEquipe();

            header("Location: /list_equipes");
        }
    }

    public function edit_equipe()
    {
        Assets::authenticate();

        $federacao = Container::getModel('Federacao');
        $federacao_data = $federacao->getAllFederacoes();
        $this->viewData->federacoes = $federacao_data;

        $equipe = Container::getModel('Equipe');
        $equipe->__set('idequipe', $_GET['idequipe']);
        $equipe_data = $equipe->getEquipe();
        $this->viewData->equipe = $equipe_data;

        $this->render('edit_equipe', 'admin_layout');
    }
    public function update_equipe()
    {
        Assets::authenticate();
        $federacao = Container::getModel('Federacao');
        $federacao_data = $federacao->getAllFederacoes();
        $this->viewData->federacoes = $federacao_data;

        if ($_POST['nomeEquipe'] == '') {
            header("Location: /add_equipe?error=1");
        } elseif ($_POST['id_federacao'] == '') {
            header("Location: /add_equipe?error=2");
        }

        $equipe = Container::getModel('Equipe');
        if (($_FILES['logoEquipe']['size'] !== 0)) {
            $file_save = $this->upload_file();
            $equipe->__set('logoEquipe', $file_save);
        } elseif ($_FILES['logoEquipe']['size'] === 0) {
            $equipe->__set('logoEquipe', $_POST['logoAntiga']);
        }
        $equipe->__set('nomeEquipe', $_POST['nomeEquipe']);
        $equipe->__set('nomeFantasiaEquipe', $_POST['nomeFantasiaEquipe']);
        $equipe->__set('siteEquipe', $_POST['siteEquipe']);
        $equipe->__set('emailEquipe', $_POST['emailEquipe']);
        $equipe->__set('telefoneEquipe', $_POST['telefoneEquipe']);
        $equipe->__set('facebookEquipe', $_POST['facebookEquipe']);
        $equipe->__set('instagramEquipe', $_POST['instagramEquipe']);
        $equipe->__set('id_federacao', $_POST['id_federacao']);
        $equipe->__set('idequipe', $_POST['idequipe']);
        $equipe->editEquipe();

        header("Location: /equipe_admin");
    }

    public function delete_equipe()
    {
        Assets::admin_authenticate();
        $equipe = Container::getModel('Equipe');
        $equipe->__set('idequipe', $_GET['idequipe']);
        $equipe->deleteEquipe();
        header('Location: /equipe_admin');
    }

    private function upload_file()
    {
        $file = $_FILES['logoEquipe'];
        $ext = explode('.', $file['name']);
        $extensao = end($ext);
        $allowedTypes = [
            'image/gif',
            'image/jpg',
            'image/jpeg',
            'image/png',
        ];
        if (!in_array($file['type'], $allowedTypes)) {
            header('Location: add_equipe?file_type=error');
            exit;
        }

        $tmp_file = $file['tmp_name'];
        $path = './images/logos/';
        $save_file = $path . 'logo' . str_replace(' ', '', mb_convert_encoding($_POST['nomeFantasiaEquipe'], "UTF-8")) . '.' . $extensao;
        $teste = move_uploaded_file($tmp_file, $save_file);
        if ($teste == 1) {
            return $save_file;
        } else {
            return '';
        }
    }
}
