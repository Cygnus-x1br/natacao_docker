<?php

namespace App\Models;

use MF\Model\Model;

class DistanciaEstilo extends Model
{
    private $iddistanciaestilo;
    private $id_estilo;
    private $id_distancia;
    private $idestilo;
    private $nomeEstilo;
    private $iddistancia;
    private $distancia;

    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function getAllDistanciaEstilo()
    {
        $prova = "SELECT *, e.nomeEstilo, d.distancia FROM tba_distancia_estilo INNER JOIN tb_estilo AS e ON (tba_distancia_estilo.ID_ESTILO = e.IDESTILO) INNER JOIN tb_distancia AS d ON (tba_distancia_estilo.ID_DISTANCIA = d.IDDISTANCIA) ORDER BY e.IDESTILO ASC";
        $stmt = $this->db->prepare($prova);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
