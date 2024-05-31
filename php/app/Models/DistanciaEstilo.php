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

    // public function saveProva()
    // {
    //     $prova = "INSERT INTO tb_prova (IDPROVA, numeroProva, genero, ID_TORNEIO, ID_DISTANCIAESTILO, ID_CATEGORIA_MIN, ID_CATEGORIA_MAX) VALUES (NULL, :numeroProva, :genero, :id_torneio, :id_distanciaestilo, :id_categoria_min, :id_categoria_max)";
    //     $stmt = $this->db->prepare($prova);
    //     $stmt->bindValue(':numeroProva', $this->__get('numeroProva'));
    //     $stmt->bindValue(':genero', $this->__get('genero'));
    //     $stmt->bindValue(':id_torneio', $this->__get('id_torneio'));
    //     $stmt->bindValue(':id_distanciaestilo', $this->__get('id_distanciaestilo'));
    //     $stmt->bindValue(':id_categoria_min', $this->__get('id_categoria_min'));
    //     $stmt->bindValue(':id_categoria_max', $this->__get('id_categoria_max'));
    //     $stmt->execute();
    //     return $this;
    // }
}
