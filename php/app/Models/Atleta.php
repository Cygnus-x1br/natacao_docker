<?php

namespace App\Models;

use MF\Model\Model;

class Atleta extends Model
{
    private $idatleta;
    private $dataNascAtleta;
    private $cpfAtleta;
    private $numRegistroAtleta;
    private $sexoAtleta;
    private $rgAtleta;


    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function getAtleta()
    {
        $atleta = "SELECT * FROM tb_atleta WHERE IDATLETA=2";
        $stmt = $this->db->prepare($atleta);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
