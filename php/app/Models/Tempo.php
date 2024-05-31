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

    public function getTempo()
    {
        $tempo = "SELECT numeroProva, genero, tempoAtleta, a.nomeAtleta, a.sobreNomeAtleta, t.nomeTorneio, t.dataTorneio, p.tamanhoPiscina, d.distancia, e.nomeEstilo, cmin.nomeCategoria AS CategoriaMinima, cmax.nomeCategoria AS CategoriaMaxima FROM tb_tempoAtleta
        INNER JOIN tb_prova AS pr ON ID_PROVA = pr.IDPROVA
        INNER JOIN tb_atleta AS a ON ID_ATLETA = a.IDATLETA
        INNER JOIN tb_torneio AS t ON pr.ID_TORNEIO = t.IDTORNEIO
        INNER JOIN tb_distancia AS d ON 
        (SELECT ID_DISTANCIA AS dist FROM tba_distancia_estilo WHERE pr.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = d.IDDISTANCIA
        INNER JOIN tb_estilo AS e ON 
        (SELECT ID_ESTILO AS est FROM tba_distancia_estilo WHERE pr.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = e.IDESTILO
        INNER JOIN tb_piscina AS p ON t.ID_PISCINA = p.IDPISCINA
        INNER JOIN tb_categoria AS cmin ON ID_CATEGORIA_MIN = cmin.IDCATEGORIA
        INNER JOIN tb_categoria AS cmax ON ID_CATEGORIA_MAX = cmax.IDCATEGORIA
        WHERE ID_ATLETA = :id_atleta ORDER BY t.dataTorneio DESC;";
        $stmt = $this->db->prepare($tempo);
        $stmt->bindValue(':id_atleta', $this->__get('id_atleta'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTempoSimpl()
    {
        $tempo = "SELECT tempoAtleta FROM tb_tempoAtleta WHERE ID_ATLETA = :id_atleta";
        $stmt = $this->db->prepare($tempo);
        $stmt->bindValue(':id_atleta', $this->__get('id_atleta'));
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
