<?php

namespace App\Models;

use MF\Model\Model;

class Tempo extends Model
{
    private $idtmpatleta;
    private $tempoAtleta;
    private $id_prova;
    private $id_atleta;

    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function getAllTempo()
    {
        $tempo = "SELECT * FROM tb_tempoAtleta ORDER BY ID_PROVA ASC";
        $stmt = $this->db->prepare($tempo);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function saveTempo()
    {
        $tempo = "INSERT INTO tb_tempoAtleta (tempoAtleta, id_prova, id_atleta) VALUES (:tempoAtleta, :id_prova, :id_atleta)";
        $stmt = $this->db->prepare($tempo);
        $stmt->bindValue(':tempoAtleta', $this->__get('tempoAtleta'));
        $stmt->bindValue(':id_prova', $this->__get('id_prova'));
        $stmt->bindValue(':id_atleta', $this->__get('id_atleta'));
        $stmt->execute();

        return $this;
    }
}
