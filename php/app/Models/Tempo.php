<?php

namespace App\Models;

use MF\Model\Model;

class Tempo extends Model
{
    private int $idtmpatleta;
    private string $tempoAtleta;
    private int $id_prova;
    private int $id_atleta;
    private string $final;
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

    public function getAllTempo(): array
    {
        $tempo = "SELECT * FROM tb_tempoAtleta ORDER BY ID_PROVA ASC";
        $stmt = $this->db->prepare($tempo);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTempo(): array
    {
        $tempo = "SELECT IDTMPATLETA, ID_PROVA, final, numeroProva, genero, tempoAtleta, pr.ID_DISTANCIAESTILO AS distanciaEstilo, a.nomeAtleta, a.sobreNomeAtleta, t.nomeTorneio, t.dataTorneio, p.tamanhoPiscina, d.distancia, e.nomeEstilo, cmin.nomeCategoria AS CategoriaMinima, cmax.nomeCategoria AS CategoriaMaxima FROM tb_tempoAtleta
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
        WHERE ID_ATLETA = :id_atleta AND IDTMPATLETA = :IDTMPATLETA ORDER BY t.dataTorneio DESC;";
        $stmt = $this->db->prepare($tempo);
        $stmt->bindValue(':id_atleta', $this->__get('id_atleta'));
        $stmt->bindValue(':IDTMPATLETA', $this->__get('idtmpatleta'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function saveTempo(): object
    {
        $tempo = "INSERT INTO tb_tempoAtleta (tempoAtleta, id_prova, id_atleta, final) VALUES (:tempoAtleta, :id_prova, :id_atleta, :final);";
        $stmt = $this->db->prepare($tempo);
        $stmt->bindValue(':tempoAtleta', $this->__get('tempoAtleta'));
        $stmt->bindValue(':id_prova', $this->__get('id_prova'));
        $stmt->bindValue(':id_atleta', $this->__get('id_atleta'));
        $stmt->bindValue(':final', $this->__get('final'));
        $stmt->execute();

        return $this;
    }

    public function updateTempo(): object
    {
        $tempo = "UPDATE tb_tempoAtleta SET tempoAtleta = :tempoAtleta, final = :final WHERE IDTMPATLETA = :IDTMPATLETA;";
        $stmt = $this->db->prepare($tempo);
        $stmt->bindValue(':tempoAtleta', $this->__get('tempoAtleta'));
        $stmt->bindValue(':IDTMPATLETA', $this->__get('idtmpatleta'));
        $stmt->bindValue(':final', $this->__get('final'));
        $stmt->execute();

        return $this;
    }

    public function deleteTempo(): object
    {
        $tempo = "DELETE FROM tb_tempoAtleta WHERE IDTMPATLETA = :idtmpatleta";
        $stmt = $this->db->prepare($tempo);
        $stmt->bindValue(':idtmpatleta', $this->__get('idtmpatleta'));
        $stmt->execute();

        return $this;
    }
    public function deleteTemposAtleta(): object
    {
        $tempo = "DELETE FROM tb_tempoAtleta WHERE ID_ATLETA = :id_atleta";
        $stmt = $this->db->prepare($tempo);
        $stmt->bindValue(':id_atleta', $this->__get('id_atleta'));
        $stmt->execute();

        return $this;
    }

    public function getTempos(): array
    {
        $tempo = "SELECT IDTMPATLETA, ID_PROVA, final, numeroProva, genero, tempoAtleta, pr.ID_DISTANCIAESTILO AS distanciaEstilo, a.nomeAtleta, a.sobreNomeAtleta, t.nomeTorneio, t.dataTorneio, p.tamanhoPiscina, d.distancia, e.nomeEstilo, cmin.nomeCategoria AS CategoriaMinima, cmax.nomeCategoria AS CategoriaMaxima FROM tb_tempoAtleta
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
        WHERE ID_ATLETA = :id_atleta ORDER BY t.dataTorneio DESC, ID_PROVA DESC, final ASC;";
        $stmt = $this->db->prepare($tempo);
        $stmt->bindValue(':id_atleta', $this->__get('id_atleta'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getMelhorTempo(): array
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

    public function getTempoSimpl(): array
    {
        $tempo = "SELECT tempoAtleta FROM tb_tempoAtleta WHERE ID_ATLETA = :id_atleta";
        $stmt = $this->db->prepare($tempo);
        $stmt->bindValue(':id_atleta', $this->__get('id_atleta'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTemposFiltered(): array
    {
        $tempos = "SELECT IDTMPATLETA, numeroProva, genero, final, tempoAtleta, pr.ID_DISTANCIAESTILO AS distanciaEstilo, a.nomeAtleta, a.sobreNomeAtleta, t.nomeTorneio, t.dataTorneio, p.tamanhoPiscina, d.distancia, e.nomeEstilo, cmin.nomeCategoria AS CategoriaMinima, cmax.nomeCategoria AS CategoriaMaxima FROM tb_tempoAtleta
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
            $tempos .= "year(t.dataTorneio) = :anoTempo AND ";
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
        $tempos .= "ORDER BY dataTorneio DESC, ID_DISTANCIAESTILO ASC, numeroProva DESC, final ASC;";

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

    public function getTemposFilteredCronologico(): array
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
            $tempos .= "year(t.dataTorneio) LIKE :anoTempo AND ";
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
        $tempos .= "ORDER BY dataTorneio ASC, pr.ID_DISTANCIAESTILO ASC, final DESC;";

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

    public function verificaTempo(): mixed
    {
        $recorde = "SELECT * FROM tb_tempoAtleta WHERE ID_PROVA = :id_prova AND final = :final AND ID_ATLETA = :id_atleta;";
        $stmt = $this->db->prepare($recorde);
        $stmt->bindValue(':id_prova', $this->__get('id_prova'));
        $stmt->bindValue(':id_atleta', $this->__get('id_atleta'));
        $stmt->bindValue(':final', $this->__get('final'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
