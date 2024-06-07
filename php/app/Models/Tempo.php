<?php

namespace App\Models;

use MF\Model\Model;

class Tempo extends Model
{
    private $idtmpatleta;
    private $tempoAtleta;
    private $id_prova;
    private $id_atleta;
    private $anoTempo;
    private $nomeTorneio;
    private $tamanhoPiscina;
    private $distanciaEstilo;


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
        $tempo = "SELECT numeroProva, genero, tempoAtleta, pr.ID_DISTANCIAESTILO AS distanciaEstilo, a.nomeAtleta, a.sobreNomeAtleta, t.nomeTorneio, t.dataTorneio, p.tamanhoPiscina, d.distancia, e.nomeEstilo, cmin.nomeCategoria AS CategoriaMinima, cmax.nomeCategoria AS CategoriaMaxima FROM tb_tempoAtleta
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

    public function getMelhorTempo()
    {
        $tempo = "SELECT ID_PROVA, numeroProva, genero, tempoAtleta, pr.ID_DISTANCIAESTILO, a.nomeAtleta, a.sobreNomeAtleta, t.nomeTorneio, t.dataTorneio, p.tamanhoPiscina, d.distancia, e.nomeEstilo, cmin.nomeCategoria AS CategoriaMinima, cmax.nomeCategoria AS CategoriaMaxima FROM tb_tempoAtleta
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
        WHERE ID_ATLETA = :id_atleta ORDER BY pr.ID_DISTANCIAESTILO ASC, tempoAtleta ASC;";
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

    public function getTemposFiltered()
    {
        $tempos = $tempo = "SELECT numeroProva, genero, tempoAtleta, pr.ID_DISTANCIAESTILO AS distanciaEstilo, a.nomeAtleta, a.sobreNomeAtleta, t.nomeTorneio, t.dataTorneio, p.tamanhoPiscina, d.distancia, e.nomeEstilo, cmin.nomeCategoria AS CategoriaMinima, cmax.nomeCategoria AS CategoriaMaxima FROM tb_tempoAtleta
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
        WHERE ID_ATLETA = :id_atleta AND ";
        if (!empty($this->__get('anoTempo'))) {
            $tempos .= "t.dataTorneio LIKE :anoTempo AND ";
        }
        if (!empty($this->__get('nomeTorneio'))) {
            $tempos .= "t.nomeTorneio = :nomeTorneio AND ";
        }
        if (!empty($this->__get('tamanhoPiscina'))) {
            $tempos .= "p.tamanhoPiscina = :tamanhoPiscina AND ";
        }
        if (!empty($this->__get('distanciaEstilo'))) {
            $tempos .= "pr.ID_DISTANCIAESTILO = :distanciaEstilo AND ";
        }
        $tempos .= "1 = 1 ";
        $tempos .= "ORDER BY dataTorneio DESC, ID_DISTANCIAESTILO ASC;";

        $stmt = $this->db->prepare($tempos);
        $stmt->bindValue(':id_atleta', $this->__get('id_atleta'));
        if (!empty($this->__get('anoTempo'))) {
            $stmt->bindValue(':anoTempo', $this->__get('anoTempo'));
        }
        if (!empty($this->__get('nomeTorneio'))) {
            $stmt->bindValue(':nomeTorneio', $this->__get('nomeTorneio'));
        }
        if (!empty($this->__get('tamanhoPiscina'))) {
            $stmt->bindValue(':tamanhoPiscina', $this->__get('tamanhoPiscina'));
        }
        if (!empty($this->__get('distanciaEstilo'))) {
            $stmt->bindValue(':distanciaEstilo', $this->__get('distanciaEstilo'));
        }

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
