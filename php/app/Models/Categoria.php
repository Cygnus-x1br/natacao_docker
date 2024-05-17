<?php

namespace App\Models;

use MF\Model\Model;

class Categoria extends Model
{
  private $idcategoria;
  private $nomeCategoria;
  private $idadeCategoria;

  public function __get($atribute)
  {
    return $this->$atribute;
  }

  public function __set($atribute, $value)
  {
    $this->$atribute = $value;
  }

  public function getAllCategorias()
  {
    $categoria = "SELECT * FROM tb_categoria ORDER BY IDCATEGORIA ASC";
    $stmt = $this->db->prepare($categoria);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
  public function getCategoria()
  {
    $categoria = "SELECT * FROM tb_categoria WHERE IDCATEGORIA = :idcategoria";
    $stmt = $this->db->prepare($categoria);
    $stmt->bindValue(':idcategoria', $this->__get('idcategoria'));
    $stmt->execute();

    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }
}
