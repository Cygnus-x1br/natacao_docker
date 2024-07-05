<?php

namespace App\Models;

use MF\Model\Model;

class Recordes extends Model
{
    private $idrecorde;
    private $tipoRecorde;
    private $dataRecorde;
    private $nomeAtletaRecorde;
    private $generoRecorde;
    private $tempoRecorde;
    private $localRecorde;
    private $nacionalidadeRecorde;
    private $id_categoria;
    private $id_distanciaestilo;
    private $id_piscina;
    private $p1;
    private $p2;
    private $i1;
    private $i2;
    private $jv1;
    private $jv2;
    private $jr1;
    private $jr2;
    private $tamanhoPiscina;

    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function getAllRecordes()
    {
        $recorde = "SELECT * FROM tb_recordes ORDER BY IDRECORDE ASC";
        $stmt = $this->db->prepare($recorde);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getRecorde()
    {
        $categoria = "SELECT IDRECORDE, ID_DISTANCIAESTILO, dataRecorde, tempoRecorde, generoRecorde, tipoRecorde, nomeAtletaRecorde, nacionalidadeRecorde, localRecorde, ID_CATEGORIA, p.tamanhoPiscina, c.nomeCategoria, d.distancia, e.nomeEstilo FROM tb_recordes
     INNER JOIN tb_categoria AS c ON ID_CATEGORIA = c.IDCATEGORIA
     INNER JOIN tb_distancia AS d ON 
     (SELECT ID_DISTANCIA AS dist FROM tba_distancia_estilo WHERE tb_recordes.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = d.IDDISTANCIA
     INNER JOIN tb_estilo AS e ON 
     (SELECT ID_ESTILO AS est FROM tba_distancia_estilo WHERE tb_recordes.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = e.IDESTILO
     INNER JOIN tb_piscina AS p ON ID_PISCINA = p.IDPISCINA 
     WHERE IDRECORDE = :idrecorde
     ORDER BY ID_CATEGORIA ASC, ID_DISTANCIAESTILO ASC;";
        $stmt = $this->db->prepare($categoria);
        $stmt->bindValue(':idrecorde', $this->__get('idrecorde'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function saveRecorde()
    {
        $recordes = "INSERT INTO tb_recordes (dataRecorde, tempoRecorde, generoRecorde, tipoRecorde, localRecorde, nomeAtletaRecorde, nacionalidadeRecorde, ID_CATEGORIA, ID_DISTANCIAESTILO, ID_PISCINA) VALUES (:dataRecorde, :tempoRecorde, :generoRecorde, :tipoRecorde, :localRecorde, :nomeAtletaRecorde, :nacionalidadeRecorde, :id_categoria, :id_distanciaestilo, :id_piscina)";
        $stmt = $this->db->prepare($recordes);
        $stmt->bindValue(':dataRecorde', $this->__get('dataRecorde'));
        $stmt->bindValue(':tempoRecorde', $this->__get('tempoRecorde'));
        $stmt->bindValue(':id_categoria', $this->__get('id_categoria'));
        $stmt->bindValue(':generoRecorde', $this->__get('generoRecorde'));
        $stmt->bindValue(':tipoRecorde', $this->__get('tipoRecorde'));
        $stmt->bindValue(':localRecorde', $this->__get('localRecorde'));
        $stmt->bindValue(':nacionalidadeRecorde', $this->__get('nacionalidadeRecorde'));
        $stmt->bindValue(':nomeAtletaRecorde', $this->__get('nomeAtletaRecorde'));
        $stmt->bindValue(':id_distanciaestilo', $this->__get('id_distanciaestilo'));
        $stmt->bindValue(':id_piscina', $this->__get('id_piscina'));
        $stmt->execute();

        return $this;
    }
    public function updateRecorde()
    {
        $recordes = "UPDATE tb_recordes SET dataRecorde = :dataRecorde, tempoRecorde = :tempoRecorde, generoRecorde = :generoRecorde, tipoRecorde = :tipoRecorde, localRecorde = :localRecorde, nomeAtletaRecorde = :nomeAtletaRecorde, nacionalidadeRecorde = :nacionalidadeRecorde, ID_CATEGORIA = :id_categoria, ID_DISTANCIAESTILO = :id_distanciaestilo, ID_PISCINA = :id_piscina WHERE IDRECORDE = :idrecorde";
        $stmt = $this->db->prepare($recordes);
        $stmt->bindValue(':idrecorde', $this->__get('idrecorde'));
        $stmt->bindValue(':dataRecorde', $this->__get('dataRecorde'));
        $stmt->bindValue(':tempoRecorde', $this->__get('tempoRecorde'));
        $stmt->bindValue(':id_categoria', $this->__get('id_categoria'));
        $stmt->bindValue(':generoRecorde', $this->__get('generoRecorde'));
        $stmt->bindValue(':tipoRecorde', $this->__get('tipoRecorde'));
        $stmt->bindValue(':localRecorde', $this->__get('localRecorde'));
        $stmt->bindValue(':nacionalidadeRecorde', $this->__get('nacionalidadeRecorde'));
        $stmt->bindValue(':nomeAtletaRecorde', $this->__get('nomeAtletaRecorde'));
        $stmt->bindValue(':id_distanciaestilo', $this->__get('id_distanciaestilo'));
        $stmt->bindValue(':id_piscina', $this->__get('id_piscina'));
        $stmt->execute();

        return $this;
    }

    public function deleteRecorde()
    {
        $recordes = "DELETE FROM tb_recordes WHERE IDRECORDE = :idrecorde";
        $stmt = $this->db->prepare($recordes);
        $stmt->bindValue(':idrecorde', $this->__get('idrecorde'));
        $stmt->execute();
    }

    public function getRecordesSorted()
    {
        $categoria = "SELECT dataRecorde, tempoRecorde, generoRecorde, tipoRecorde, nomeAtletaRecorde, nacionalidadeRecorde, localRecorde, ID_CATEGORIA, p.tamanhoPiscina, c.nomeCategoria, d.distancia, e.nomeEstilo FROM tb_recordes
     INNER JOIN tb_categoria AS c ON ID_CATEGORIA = c.IDCATEGORIA
     INNER JOIN tb_distancia AS d ON 
     (SELECT ID_DISTANCIA AS dist FROM tba_distancia_estilo WHERE tb_recordes.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = d.IDDISTANCIA
     INNER JOIN tb_estilo AS e ON 
     (SELECT ID_ESTILO AS est FROM tba_distancia_estilo WHERE tb_recordes.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = e.IDESTILO
     INNER JOIN tb_piscina AS p ON ID_PISCINA = p.IDPISCINA 
     ORDER BY ID_CATEGORIA ASC, ID_DISTANCIAESTILO ASC;";
        $stmt = $this->db->prepare($categoria);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getRecordesFiltered()
    {
        $recordes = "SELECT IDRECORDE, dataRecorde, tempoRecorde, generoRecorde, tipoRecorde, nomeAtletaRecorde, nacionalidadeRecorde, localRecorde, ID_CATEGORIA, ID_DISTANCIAESTILO, p.tamanhoPiscina, c.nomeCategoria, d.distancia, e.nomeEstilo FROM tb_recordes
     INNER JOIN tb_categoria AS c ON ID_CATEGORIA = c.IDCATEGORIA
     INNER JOIN tb_distancia AS d ON 
     (SELECT ID_DISTANCIA AS dist FROM tba_distancia_estilo WHERE tb_recordes.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = d.IDDISTANCIA
     INNER JOIN tb_estilo AS e ON 
     (SELECT ID_ESTILO AS est FROM tba_distancia_estilo WHERE tb_recordes.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = e.IDESTILO
     INNER JOIN tb_piscina AS p ON ID_PISCINA = p.IDPISCINA
     WHERE ";
        if (!empty($this->__get('generoRecorde'))) {
            $recordes .= "generoRecorde = :generoRecorde AND ";
        }
        if (!empty($this->__get('tipoRecorde'))) {
            $recordes .= "tipoRecorde = :tipoRecorde AND ";
        }
        if (!empty($this->__get('id_distanciaestilo'))) {
            $recordes .= "ID_DISTANCIAESTILO = :id_distanciaestilo AND ";
        }
        if (!empty($this->__get('id_categoria'))) {
            $recordes .= "ID_CATEGORIA = :categoria AND ";
        }
        $recordes .= "1 = 1 ";
        $recordes .= "ORDER BY ID_DISTANCIAESTILO ASC, ID_CATEGORIA ASC, generoRecorde DESC;";

        $stmt = $this->db->prepare($recordes);
        if (!empty($this->__get('generoRecorde'))) {
            $stmt->bindValue(':generoRecorde', $this->__get('generoRecorde'));
        }
        if (!empty($this->__get('tipoRecorde'))) {
            $stmt->bindValue(':tipoRecorde', $this->__get('tipoRecorde'));
        }
        if (!empty($this->__get('id_categoria'))) {
            $stmt->bindValue(':categoria', $this->__get('id_categoria'));
        }
        if (!empty($this->__get('id_distanciaestilo'))) {
            $stmt->bindValue(':id_distanciaestilo', $this->__get('id_distanciaestilo'));
        }

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getRecordesFilteredGrafico()
    {
        $recordes = "SELECT dataRecorde, tempoRecorde, generoRecorde, tipoRecorde, nomeAtletaRecorde, nacionalidadeRecorde, localRecorde, ID_CATEGORIA, ID_DISTANCIAESTILO, p.tamanhoPiscina, c.nomeCategoria, d.distancia, e.nomeEstilo FROM tb_recordes
     INNER JOIN tb_categoria AS c ON ID_CATEGORIA = c.IDCATEGORIA
     INNER JOIN tb_distancia AS d ON 
     (SELECT ID_DISTANCIA AS dist FROM tba_distancia_estilo WHERE tb_recordes.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = d.IDDISTANCIA
     INNER JOIN tb_estilo AS e ON 
     (SELECT ID_ESTILO AS est FROM tba_distancia_estilo WHERE tb_recordes.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = e.IDESTILO
     INNER JOIN tb_piscina AS p ON ID_PISCINA = p.IDPISCINA
     WHERE ";
        if (!empty($this->__get('generoRecorde'))) {
            $recordes .= "generoRecorde = :generoRecorde AND ";
        }
        if (!empty($this->__get('tipoRecorde'))) {
            $recordes .= "tipoRecorde = :tipoRecorde AND ";
        }
        if (!empty($this->__get('tamanhoPiscina'))) {
            $recordes .= "p.tamanhoPiscina = :tamanhoPiscina AND ";
        }
        if (!empty($this->__get('id_distanciaestilo'))) {
            $recordes .= "ID_DISTANCIAESTILO = :id_distanciaestilo AND ";
        }
        if (!empty($this->__get('id_categoria'))) {
            $recordes .= "(ID_CATEGORIA = :categoria ";
        }
        if (!empty($this->__get('p1'))) {
            $recordes .= "OR ID_CATEGORIA = :p1 ";
        }
        if (!empty($this->__get('p2'))) {
            $recordes .= "OR ID_CATEGORIA = :p2 ";
        }
        if (!empty($this->__get('i1'))) {
            $recordes .= "OR ID_CATEGORIA = :i1 ";
        }
        if (!empty($this->__get('i2'))) {
            $recordes .= "OR ID_CATEGORIA = :i2 ";
        }
        if (!empty($this->__get('jv1'))) {
            $recordes .= "OR ID_CATEGORIA = :jv1 ";
        }
        if (!empty($this->__get('jv2'))) {
            $recordes .= "OR ID_CATEGORIA = :jv2 ";
        }
        if (!empty($this->__get('jr1'))) {
            $recordes .= "OR ID_CATEGORIA = :jr1 ";
        }
        if (!empty($this->__get('jr2'))) {
            $recordes .= "OR ID_CATEGORIA = :jr2 ";
        }
        $recordes .= ") AND 1 = 1 ";
        $recordes .= "ORDER BY ID_DISTANCIAESTILO ASC, ID_CATEGORIA ASC, generoRecorde DESC;";

        $stmt = $this->db->prepare($recordes);
        if (!empty($this->__get('generoRecorde'))) {
            $stmt->bindValue(':generoRecorde', $this->__get('generoRecorde'));
        }
        if (!empty($this->__get('tipoRecorde'))) {
            $stmt->bindValue(':tipoRecorde', $this->__get('tipoRecorde'));
        }
        if (!empty($this->__get('id_categoria'))) {
            $stmt->bindValue(':categoria', $this->__get('id_categoria'));
        }
        if (!empty($this->__get('tamanhoPiscina'))) {
            $stmt->bindValue(':tamanhoPiscina', $this->__get('tamanhoPiscina'));
        }
        if (!empty($this->__get('p1'))) {
            $stmt->bindValue(':p1', $this->__get('p1'));
        }
        if (!empty($this->__get('p2'))) {
            $stmt->bindValue(':p2', $this->__get('p2'));
        }
        if (!empty($this->__get('i1'))) {
            $stmt->bindValue(':i1', $this->__get('i1'));
        }
        if (!empty($this->__get('i2'))) {
            $stmt->bindValue(':i2', $this->__get('i2'));
        }
        if (!empty($this->__get('jv1'))) {
            $stmt->bindValue(':jv1', $this->__get('jv1'));
        }
        if (!empty($this->__get('jv2'))) {
            $stmt->bindValue(':jv2', $this->__get('jv2'));
        }
        if (!empty($this->__get('jr1'))) {
            $stmt->bindValue(':jr1', $this->__get('jr1'));
        }
        if (!empty($this->__get('jr2'))) {
            $stmt->bindValue(':jr2', $this->__get('jr2'));
        }
        if (!empty($this->__get('id_distanciaestilo'))) {
            $stmt->bindValue(':id_distanciaestilo', $this->__get('id_distanciaestilo'));
        }

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function verificaRecorde()
    {
        $recorde = "SELECT * FROM tb_recordes WHERE tipoRecorde = :tipoRecorde AND ID_CATEGORIA = :id_categoria AND ID_DISTANCIAESTILO = :id_distanciaestilo AND ID_PISCINA = :id_piscina AND generoRecorde = :generoRecorde";
        $stmt = $this->db->prepare($recorde);
        $stmt->bindValue(':id_categoria', $this->__get('id_categoria'));
        $stmt->bindValue(':id_distanciaestilo', $this->__get('id_distanciaestilo'));
        $stmt->bindValue(':id_piscina', $this->__get('id_piscina'));
        $stmt->bindValue(':generoRecorde', $this->__get('generoRecorde'));
        $stmt->bindValue(':tipoRecorde', $this->__get('tipoRecorde'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
