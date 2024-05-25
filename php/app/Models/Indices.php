<?php

namespace App\Models;

use MF\Model\Model;

class Indices extends Model
{
  private $idindice;
  private $anoIndice;
  private $tempoIndice;
  private $id_categoria;
  private $generoIndice;
  private $tipoIndice;
  private $id_distanciaestlo;
  private $id_piscina;

  public function __get($atribute)
  {
    return $this->$atribute;
  }

  public function __set($atribute, $value)
  {
    $this->$atribute = $value;
  }

  public function getAllIndices()
  {
    $categoria = "SELECT * FROM tb_indices ORDER BY IDINDICE ASC";
    $stmt = $this->db->prepare($categoria);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
  public function getIndicesSorted()
  {
    $categoria = "SELECT anoIndice, tempoIndice, generoIndice, tipoIndice, ID_CATEGORIA, p.tamanhoPiscina, c.nomeCategoria, d.distancia, e.nomeEstilo FROM tb_indices
     INNER JOIN tb_categoria AS c ON ID_CATEGORIA = c.IDCATEGORIA
     INNER JOIN tb_distancia AS d ON 
     (SELECT ID_DISTANCIA AS dist FROM tba_distancia_estilo WHERE tb_indices.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = d.IDDISTANCIA
     INNER JOIN tb_estilo AS e ON 
     (SELECT ID_ESTILO AS est FROM tba_distancia_estilo WHERE tb_indices.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = e.IDESTILO
     INNER JOIN tb_piscina AS p ON ID_PISCINA = p.IDPISCINA 
     ORDER BY generoIndice DESC, ID_DISTANCIAESTILO ASC, anoIndice DESC;;";
    $stmt = $this->db->prepare($categoria);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
  public function getIndicesFiltered()
  {
    $indices = "SELECT anoIndice, tempoIndice, generoIndice, tipoIndice, ID_CATEGORIA, p.tamanhoPiscina, c.nomeCategoria, d.distancia, e.nomeEstilo FROM tb_indices
     INNER JOIN tb_categoria AS c ON ID_CATEGORIA = c.IDCATEGORIA
     INNER JOIN tb_distancia AS d ON 
     (SELECT ID_DISTANCIA AS dist FROM tba_distancia_estilo WHERE tb_indices.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = d.IDDISTANCIA
     INNER JOIN tb_estilo AS e ON 
     (SELECT ID_ESTILO AS est FROM tba_distancia_estilo WHERE tb_indices.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = e.IDESTILO
     INNER JOIN tb_piscina AS p ON ID_PISCINA = p.IDPISCINA
     WHERE ";
    if (!empty($this->__get('anoIndice'))) {
      $indices .= "anoIndice = :anoIndice AND ";
    }
    if (!empty($this->__get('generoIndice'))) {
      $indices .= "generoIndice = :generoIndice AND ";
    }
    if (!empty($this->__get('tipoIndice'))) {
      $indices .= "tipoIndice = :tipoIndice AND ";
    }
    if (!empty($this->__get('id_categoria'))) {
      $indices .= "ID_CATEGORIA = :categoria AND ";
    }
    $indices .= "1 = 1 ";
    $indices .= "ORDER BY generoIndice DESC, ID_DISTANCIAESTILO ASC, anoIndice DESC;";

    $stmt = $this->db->prepare($indices);
    if (!empty($this->__get('anoIndice'))) {
      $stmt->bindValue(':anoIndice', $this->__get('anoIndice'));
    }
    if (!empty($this->__get('generoIndice'))) {
      $stmt->bindValue(':generoIndice', $this->__get('generoIndice'));
    }
    if (!empty($this->__get('tipoIndice'))) {
      $stmt->bindValue(':tipoIndice', $this->__get('tipoIndice'));
    }
    if (!empty($this->__get('id_categoria'))) {
      $stmt->bindValue(':categoria', $this->__get('id_categoria'));
    }

    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
}
