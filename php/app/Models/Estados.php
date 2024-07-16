<?php

namespace App\Models;

use MF\Model\Model;

class Estados extends Model
{
    private int $idestado;
    private string $nomeEstado;
    private string $siglaEstado;

    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function getAllEstados()
    {
        $estado = "SELECT * FROM tb_estado ORDER BY nomeEstado ASC";
        $stmt = $this->db->prepare($estado);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
