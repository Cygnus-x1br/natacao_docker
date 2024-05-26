<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class AtletaController extends Action
{
  public function view_atleta()
  {

    $atleta = Container::getModel('Atleta');
    $atleta->__set('idatleta', $_GET['id']);
    $atleta_data = $atleta->getAtleta();
    $this->viewData->atleta = $atleta_data;

    $idade = date('Y') - (explode('-', $atleta_data['dataNascAtleta']))[0];

    $idade = $idade > 19 ? 99 : ($idade < 7 ? 7 : $idade);
    $this->viewData->categoria = $this->test_category($idade);

    $this->viewData->equipes = $this->list_equipes();

    $this->render('view_atleta');
  }

  public function select_atleta()
  {
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

    print_r($_POST);

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
    $atleta->__set('nomeAtleta', $_POST['nomeAtleta']);
    $atleta->__set('sobreNomeAtleta', $_POST['sobreNomeAtleta']);
    $atleta->__set('apelidoAtleta', $_POST['apelidoAtleta']);
    $atleta->__set('emailAtleta', $_POST['emailAtleta']);
    $atleta->__set('dataNascAtleta', $_POST['dataNascAtleta']);
    $atleta->__set('cpfAtleta', $_POST['cpfAtleta']);
    $atleta->__set('numRegistroAtleta', $_POST['numRegistroAtleta']);
    $atleta->__set('sexoAtleta', $_POST['sexoAtleta']);
    $atleta->__set('rgAtleta', $_POST['rgAtleta']);
    // $atleta->__set('fotoAtleta', $_POST['fotoAtleta']);
    $atleta->__set('instagramAtleta', $_POST['instagramAtleta']);
    $atleta->__set('facebookAtleta', $_POST['facebookAtleta']);
    $atleta->__set('whatsappAtleta', $_POST['whatsappAtleta']);
    $atleta->__set('telefoneAtleta', $_POST['telefoneAtleta']);
    $atleta->__set('id_equipe', $_POST['id_equipe']);

    $atleta->addAtleta();


    // $id = $atleta->getAtletaNome();

    header("Location: /view_atleta?id=" . $atleta->__get('idAtleta'));
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
    $save_file = $path . 'foto' . $_POST['nomeAtleta']  . '_' . $_POST['sobreNomeAtleta'] . '_' . $_POST['dataNascAtleta'] . '.' . $extensao;
    $teste = move_uploaded_file($tmp_file, $save_file);
    if ($teste == 1) {
      return $save_file;
    } else {
      return '';
    }
  }
}
