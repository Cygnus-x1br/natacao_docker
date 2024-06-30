<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

session_start([
    'cookie_lifetime' => 86400,
]);
class AtletaController extends Action
{
    public function index_atleta()
    {
        Assets::authenticate();

        if ($_SESSION['permissao'] == 2) {
            $_SESSION['user_id'] = $_GET['id'];
            $_SESSION['atleta_id'] = $_GET['id']; //recuperar dados da tabela de user
        }

        $atleta = Container::getModel('Atleta');
        $atleta->__set('idatleta', $_GET['id']);
        $atleta_data = $atleta->getAtletabyID();

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
        $this->viewData->categoria = Assets::test_category($idade);

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
        $this->viewData->categoria = Assets::test_category($idade);
        $this->viewData->equipes = Assets::list_equipes();

        $tempo = Container::getModel('Tempo');
        $tempo->__set('id_atleta', $_GET['id']);
        $this->viewData->tempos = $tempo->getTempo();
        $this->viewData->display = 'disabled';

        $this->render('view_atleta');
    }

    public function insert_atleta()
    {
        if ($_SESSION['permissao'] == 1) {
            header('Location: /error?error=1001');
        }
        $idade = 0;
        $this->viewData->equipes = Assets::list_equipes();
        $this->viewData->categoria = Assets::test_category($idade);
        $this->render('add_atleta');
    }

    // public function save_atleta()
    // {
    //     if ($_POST['nomeAtleta'] == '') {
    //         header("Location: /error?error=1003");
    //     } elseif ($_POST['dataNascAtleta'] == '') {
    //         header("Location: /error?error=1004");
    //     }

    //     $atleta = Container::getModel('Atleta');
    //     if ($_FILES['fotoAtleta']['size'] !== 0) {
    //         $file_save = $this->upload_file();
    //         $atleta->__set('fotoAtleta', $file_save);
    //         // } else if ($edit == 'edit' && ($_FILES['logoEquipe']['size'] == 0)) {
    //         //   $equipe->__set('logoEquipe', $_POST['logoEquipe']);
    //     }
    //     $atleta->__set('nomeAtleta', ucwords($_POST['nomeAtleta']));
    //     $atleta->__set('sobreNomeAtleta', ucwords($_POST['sobreNomeAtleta']));
    //     $atleta->__set('apelidoAtleta', $_POST['apelidoAtleta']);
    //     $atleta->__set('emailAtleta', $_POST['emailAtleta']);
    //     $atleta->__set('dataNascAtleta', $_POST['dataNascAtleta']);
    //     $atleta->__set('cpfAtleta', $_POST['cpfAtleta']);
    //     $atleta->__set('numRegistroAtleta', $_POST['numRegistroAtleta']);
    //     $atleta->__set('sexoAtleta', $_POST['sexoAtleta']);
    //     $atleta->__set('rgAtleta', $_POST['rgAtleta']);
    //     $atleta->__set('instagramAtleta', $_POST['instagramAtleta']);
    //     $atleta->__set('facebookAtleta', $_POST['facebookAtleta']);
    //     $atleta->__set('whatsappAtleta', $_POST['whatsappAtleta']);
    //     $atleta->__set('telefoneAtleta', $_POST['telefoneAtleta']);
    //     $atleta->__set('id_equipe', $_POST['id_equipe']);

    //     $verificaCPF = Assets::verificaCPF($_POST['cpfAtleta']);
    //     if (!$verificaCPF) {
    //         header('Location: error?error=2005');
    //         die();
    //     } else {
    //         Assets::verificaCadastroAtleta($_POST['sobreNomeAtleta'], $_POST['dataNascAtleta'], $_POST['cpfAtleta'], $_POST['emailAtleta'], $_POST['numRegistroAtleta'], $_POST['nomeAtleta']);
    //         $atleta->addAtleta();
    //         echo $atleta;
    //     }
    // }

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

    public function delete_atleta()
    {
        $atleta = Container::getModel('Atleta');
        $atleta->__set('idatleta', $_GET['id']);
        $atleta->deleteAtleta();
        header('Location: /atleta_admin');
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
