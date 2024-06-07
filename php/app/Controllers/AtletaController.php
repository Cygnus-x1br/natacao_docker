<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

session_start();
class AtletaController extends Action
{
    public function index_atleta()
    {
        Assets::authenticate();
        $atleta = Container::getModel('Atleta');
        $atleta->__set('idatleta', $_GET['id']);
        $atleta_data = $atleta->getAtletabyID();
        // print_r($atleta_data);
        if ($_SESSION['nome'] != $atleta_data['emailAtleta'] && $_SESSION['permissao'] != '2') {
            header('Location: /error?error=1002');
            die();
        }
        $this->viewData->atleta = $atleta_data;

        $tempoAtleta = Container::getModel('Tempo');
        $tempoAtleta->__set('id_atleta', $_GET['id']);
        $tempoAtleta_data = $tempoAtleta->getTempo();
        $this->viewData->tempoAtleta = $tempoAtleta_data;


        $idade = date('Y') - (explode('-', $atleta_data['dataNascAtleta']))[0];
        $idade = $idade > 19 ? 99 : ($idade < 7 ? 7 : $idade);
        $this->viewData->categoria = $this->test_category($idade);

        $this->viewData->melhores_tempos = Tempo::melhores_tempos();

        $this->render('index_atleta');
    }
    public function view_atleta()
    {
        Assets::authenticate();

        if (isset($_GET['edit']) && $_GET['edit'] == 'true') {
            $this->setHtmlData->edit = '';
        } else {
            $this->setHtmlData->edit = 'disabled';
        }

        $atleta = Container::getModel('Atleta');
        $atleta->__set('idatleta', $_GET['id']);
        $atleta_data = $atleta->getAtletabyID();
        if ($_SESSION['nome'] != $atleta_data['emailAtleta'] && $_SESSION['permissao'] != '2') {
            header('Location: /error?error=1002');
            die();
        }
        $this->viewData->atleta = $atleta_data;

        $idade = date('Y') - (explode('-', $atleta_data['dataNascAtleta']))[0];
        $idade = $idade > 19 ? 99 : ($idade < 7 ? 7 : $idade);
        $this->viewData->categoria = $this->test_category($idade);
        $this->viewData->equipes = $this->list_equipes();

        $tempo = Container::getModel('Tempo');
        $tempo->__set('id_atleta', $_GET['id']);
        $this->viewData->tempos = $tempo->getTempo();
        $this->viewData->display = 'disabled';

        $this->render('view_atleta');
    }

    public function select_atleta()
    {
        Assets::authenticate();

        if ($_SESSION['permissao'] != '2') {
            header('Location: /index_atleta?id=' . $_SESSION['id']);
            die();
        }
        $this->render('select_atleta');
    }

    public function add_atleta()
    {
        $idade = 0;
        $this->viewData->equipes = $this->list_equipes();
        $this->viewData->categoria = $this->test_category($idade);
        $this->render('add_atleta');
    }

    public function save_atleta()
    {
        if ($_POST['nomeAtleta'] == '') {
            header("Location: /add_atleta?error=1");
        } elseif ($_POST['dataNascAtleta'] == '') {
            header("Location: /add_atleta?error=2");
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

        Assets::verificaCadastroAtleta($_POST['sobreNomeAtleta'], $_POST['dataNascAtleta'], $_POST['cpfAtleta'], $_POST['emailAtleta'], $_POST['numRegistroAtleta'], $_POST['nomeAtleta']);

        $verificaCPF = Assets::verificaCPF($_POST['cpfAtleta']);

        if ($verificaCPF == false) {
            header('Location: error?error=2005');
        }
        $atleta->addAtleta();

        $this->create_user($_POST['emailAtleta']);
        //header("Location: /view_atleta?id=" . $atleta['idatleta']);
    }

    private function create_user($emailAtleta)
    {
        //echo $emailAtleta;
        $atleta = Container::getModel('Atleta');
        $atleta->__set('emailAtleta', $emailAtleta);
        $atleta_data = $atleta->getAtletaEmail();
        $this->viewData->atleta = $atleta_data;

        $this->render('create_user', 'sign_in_layout');
    }

    public function save_user()
    {
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

    public function edit_atleta()
    {
        Assets::authenticate();
        // print_r($_POST);
        if ($_POST['nomeAtleta'] == '') {
            header("Location: /add_atleta?error=1");
        } elseif ($_POST['dataNascAtleta'] == '') {
            header("Location: /add_atleta?error=2");
        }

        $atleta = Container::getModel('Atleta');
        $atleta->__set('idatleta', $_POST['idAtleta']);
        if ($_FILES['fotoAtleta']['size'] !== 0) {
            $file_save = $this->upload_file();
            $atleta->__set('fotoAtleta', $file_save);
        } elseif ($_FILES['fotoAtleta']['size'] === 0) {
            $atleta->__set('fotoAtleta', $_POST['fotoAntiga']);
        }
        $atleta->__set('nomeAtleta', $_POST['nomeAtleta']);
        $atleta->__set('sobreNomeAtleta', $_POST['sobreNomeAtleta']);
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
        $atleta->editAtleta();

        header("Location: /index_atleta?id=" . $_POST['idAtleta']);
    }

    public function tempos_atleta()
    {
        $tempoAtleta = Container::getModel('Tempo');
        $tempoAtleta->__set('id_atleta', $_SESSION['user_id']);
        $tempoAtleta_data = $tempoAtleta->getTempo();
        $this->viewData->tempoAtleta = $tempoAtleta_data;

        $torneio = Container::getModel('Torneio');
        $torneio_data = $torneio->getAllTorneios();
        $this->viewData->torneios = $torneio_data;

        $distanciaEstilo = Container::getModel('DistanciaEstilo');
        $distanciaEstilo_data = $distanciaEstilo->getAllDistanciaEstilo();
        $this->viewData->distanciaEstilo = $distanciaEstilo_data;

        $categoria = Container::getModel('Categoria');
        $categoria_data = $categoria->getAllCategorias();
        $this->viewData->categorias = $categoria_data;

        $provas = Container::getModel('Prova');
        $provas_data = $provas->getAllProvas();
        $this->viewData->provas = $provas_data;

        $this->render('tempos_atleta');
    }

    public function melhores_tempos()
    {
        $tempoAtleta = Container::getModel('Tempo');
        $tempoAtleta->__set('id_atleta', $_SESSION['user_id']);
        $tempoAtleta_data = $tempoAtleta->getMelhorTempo();
        $melhor_tempo = [];

        $filtra_prova = 0;
        foreach ($tempoAtleta_data as $tempo) {
            if ($filtra_prova != $tempo['ID_DISTANCIAESTILO'] && $tempo['tamanhoPiscina'] == 25) {
                $filtra_prova = $tempo['ID_DISTANCIAESTILO'];
                $melhor_tempo[] = ['data' => $tempo['dataTorneio'], 'torneio' => $tempo['nomeTorneio'], 'tempo' => $tempo['tempoAtleta'], 'distancia' => $tempo['distancia'], 'estilo' => $tempo['nomeEstilo'], 'piscina' => $tempo['tamanhoPiscina']];;
            }
        }

        foreach ($tempoAtleta_data as $tempo) {
            if ($filtra_prova != $tempo['ID_DISTANCIAESTILO'] && $tempo['tamanhoPiscina'] == 50) {
                $filtra_prova = $tempo['ID_DISTANCIAESTILO'];
                $melhor_tempo[] = ['data' => $tempo['dataTorneio'], 'torneio' => $tempo['nomeTorneio'], 'tempo' => $tempo['tempoAtleta'], 'distancia' => $tempo['distancia'], 'estilo' => $tempo['nomeEstilo'], 'piscina' => $tempo['tamanhoPiscina']];;
            }
        }

        return $melhor_tempo;
    }

    private function list_equipes()
    {
        $equipes = Container::getModel('Equipe');
        return $equipes->getAllEquipes();
    }

    private function test_category($idade)
    {
        $categoria = Container::getModel('Categoria');
        $categoria->__set('idcategoria', $idade);
        return $categoria->getCategoria();
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
