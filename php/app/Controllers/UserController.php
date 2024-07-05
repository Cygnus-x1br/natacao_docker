<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

session_start([
    'cookie_lifetime' => 86400,
]);
class UserController extends Action
{
    public function add_atleta()
    {
        $idade = 0;
        $this->viewData->equipes = Assets::list_equipes();
        $this->viewData->categoria = Assets::test_category($idade);
        $this->render('add_atleta');
    }

    public function save_atleta()
    {

        if ($_POST['nomeAtleta'] == '') {
            header("Location: /error?error=1003");
        } elseif ($_POST['dataNascAtleta'] == '') {
            header("Location: /error?error=1004");
        }

        $verificaCPF = Assets::verificaCPF($_POST['cpfAtleta']);
        if (!$verificaCPF) {
            header('Location: error?error=2005');
            die();
        } else {
            Assets::verificaCadastroAtleta($_POST['sobreNomeAtleta'], $_POST['dataNascAtleta'], $_POST['cpfAtleta'], $_POST['emailAtleta'], $_POST['numRegistroAtleta'], $_POST['nomeAtleta']);
        }

        $atleta = Container::getModel('Atleta');
        if ($_FILES['fotoAtleta']['size'] !== 0) {
            $file_save = $this->upload_file();
            $atleta->__set('fotoAtleta', $file_save);
            // } else if ($edit == 'edit' && ($_FILES['logoEquipe']['size'] == 0)) {
            //   $equipe->__set('logoEquipe', $_POST['logoEquipe']);
        }
        $atleta->__set('nomeAtleta', ucwords($_POST['nomeAtleta']));
        $atleta->__set('sobreNomeAtleta', ucwords($_POST['sobreNomeAtleta']));
        $atleta->__set('apelidoAtleta', $_POST['apelidoAtleta']);
        $atleta->__set('emailAtleta', $_POST['emailAtleta']);
        $atleta->__set('dataNascAtleta', $_POST['dataNascAtleta']);
        $atleta->__set('cpfAtleta', $_POST['cpfAtleta']);
        $atleta->__set('numRegistroAtleta', $_POST['numRegistroAtleta']);
        $atleta->__set('sexoAtleta', $_POST['sexoAtleta']);
        $atleta->__set('rgAtleta', $_POST['rgAtleta']);
        $atleta->__set('instagramAtleta', $_POST['instagramAtleta']);
        $atleta->__set('facebookAtleta', $_POST['facebookAtleta']);
        $atleta->__set('whatsappAtleta', $_POST['whatsappAtleta']);
        $atleta->__set('telefoneAtleta', $_POST['telefoneAtleta']);
        $atleta->__set('id_equipe', $_POST['id_equipe']);

        $atleta->saveAtleta();

        if (isset($_POST['idUsuario']) && isset($_POST['permissaoUsuario']) && $_POST['permissaoUsuario'] == 2) {
            echo "$atleta->nomeAtleta $atleta->sobreNomeAtleta incluido com sucesso";
            header("Location: /atleta_admin");
        }
        // echo $atleta->emailAtleta;
        $this->create_user($atleta->emailAtleta);
    }

    private function create_user($emailAtleta, $error = null)
    {
        if ($error != null) {
            $this->viewData->error = $error;
        }
        $atleta = Container::getModel('Atleta');
        $atleta->__set('emailAtleta', $emailAtleta);
        $atleta_data = $atleta->getAtletaEmail();

        $this->viewData->atleta = $atleta_data;

        $this->render('create_user', 'sign_in_layout');
    }

    public function save_user()
    {
        if ($_POST['passwd'] == '' || $_POST['passwd_confirm'] == '' || $_POST['passwd'] != $_POST['passwd_confirm']) {
            echo 'Erro';
            $this->create_user($_POST['emailAtleta'], '2006');
        } else {
            $user = Container::getModel('Users');
            $user->__set('user_id', $_POST['idAtleta']);
            $user->__set('username', $_POST['emailAtleta']);
            $user->__set('passwd', $_POST['passwd']);
            $user->__set('user_name', $_POST['emailAtleta']);
            $user->__set('permission', 1);
            $user->saveUser();

            $user->login($_POST['emailAtleta'], $_POST['passwd']);
            header("Location: /sign_in");
        }
    }

    private function upload_file()
    {
        $file = $_FILES['fotoAtleta'];
        $ext = explode('.', $file['name']);
        $extensao = end($ext);
        $allowedTypes = [
            'image/gif',
            'image/jpg',
            'image/jpeg',
            'image/png',
        ];
        if (!in_array($file['type'], $allowedTypes)) {
            header('Location: add_atleta?file_type=error');
            exit;
        }

        $tmp_file = $file['tmp_name'];
        $path = './images/fotos/';
        $save_file = $path . 'foto_' . str_replace(' ', '', mb_convert_encoding($_POST['nomeAtleta'], "UTF-8"))  . '_' . str_replace(' ', '', mb_convert_encoding($_POST['sobreNomeAtleta'], "UTF-8")) . '_' . $_POST['dataNascAtleta'] . '.' . $extensao;
        $teste = move_uploaded_file($tmp_file, $save_file);
        if ($teste == 1) {
            return $save_file;
        } else {
            return '';
        }
    }
}
