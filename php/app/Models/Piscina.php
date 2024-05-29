<?php

namespace App\Models;

use MF\Model\Model;

class Piscina extends Model
{
    private $idpiscina;
    private $tamanhoPiscina;


    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function getPiscinas()
    {
        $piscina = "SELECT * FROM tb_piscina ORDER BY tamanhoPiscina ASC";
        $stmt = $this->db->prepare($piscina);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
