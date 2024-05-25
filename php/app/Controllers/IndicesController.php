<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class IndicesController extends Action
{
  public function list_indices()
  {
    $indices = Container::getModel('Indices');
    $indices_data = $indices->getIndicesSorted();
    $this->viewData->indices = $indices_data;

    $this->viewData->anosIndice = $this->list_anos();
    $this->viewData->tipoIndice = $this->list_tipos();
    $this->viewData->categorias = $this->list_categorias();

    $this->render('list_indices');
  }
  public function list_anos()
  {
    $indices = Container::getModel('Indices');
    $indices_data = $indices->getIndicesSorted();
    foreach ($indices_data as $key => $value) {
      $anos[] = $value['anoIndice'];
    }
    return array_unique($anos);
  }
  public function list_tipos()
  {
    $indices = Container::getModel('Indices');
    $indices_data = $indices->getIndicesSorted();
    foreach ($indices_data as $key => $value) {
      $tipoIndice[] = $value['tipoIndice'];
    }
    return array_unique($tipoIndice);
  }
  public function list_categorias()
  {
    $categorias = Container::getModel('Categoria');
    $categorias_data = $categorias->getAllCategorias();
    return $categorias_data;
  }

  public function filtra_indices()
  {
    print_r($_POST);
    $indices = Container::getModel('Indices');
    $indices->__set('anoIndice', $_POST['anoIndice']);
    $indices->__set('tipoIndice', $_POST['tipoIndice']);
    $indices->__set('generoIndice', $_POST['generoIndice']);
    $indices->__set('id_categoria', $_POST['id_categoria']);
    $indices_data = $indices->getIndicesFiltered();
    $this->viewData->indices = $indices_data;

    $this->viewData->anosIndice = $this->list_anos();
    $this->viewData->tipoIndice = $this->list_tipos();
    $this->viewData->categorias = $this->list_categorias();
    $this->render('list_indices');
  }
}
