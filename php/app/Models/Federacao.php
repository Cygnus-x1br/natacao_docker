<?php

namespace App\Models;

use MF\Model\Model;

class Federacao extends Model
{
  private $idfederacao;
  private $nomeFederacao;
  private $noteFantasiaFederacao;
  private $logoFederacao;
  private $ID_ESTADO;

  public function __get($atribute)
  {
    return $this->$atribute;
  }

  public function __set($atribute, $value)
  {
    $this->$atribute = $value;
  }

  public function getAllFederacoes()
  {
    $federacao = "SELECT *, e.nomeEstado AS nomeEstado, e.siglaEstado AS siglaEstado FROM tb_federacao INNER JOIN tb_estado AS e ON ID_ESTADO = e.IDESTADO ORDER BY nomeFederacao DESC";
    $stmt = $this->db->prepare($federacao);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
}
