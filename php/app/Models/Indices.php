<?php

namespace App\Models;

use MF\Model\Model;

class Indices extends Model
{
    private $idindice;
    private $anoIndice;
    private $tempoIndice;
    private $id_categoria;
    private $generoIndice;
    private $tipoIndice;
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

    public function getAllIndices()
    {
        $categoria = "SELECT * FROM tb_indices ORDER BY IDINDICE ASC";
        $stmt = $this->db->prepare($categoria);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function saveIndice()
    {
        $indices = "INSERT INTO tb_indices (anoIndice, tempoIndice, generoIndice, tipoIndice, ID_CATEGORIA, ID_DISTANCIAESTILO, ID_PISCINA) VALUES (:anoIndice, :tempoIndice, :generoIndice, :tipoIndice, :id_categoria, :id_distanciaestilo, :id_piscina)";
        $stmt = $this->db->prepare($indices);
        $stmt->bindValue(':anoIndice', $this->__get('anoIndice'));
        $stmt->bindValue(':tempoIndice', $this->__get('tempoIndice'));
        $stmt->bindValue(':id_categoria', $this->__get('id_categoria'));
        $stmt->bindValue(':generoIndice', $this->__get('generoIndice'));
        $stmt->bindValue(':tipoIndice', $this->__get('tipoIndice'));
        $stmt->bindValue(':id_distanciaestilo', $this->__get('id_distanciaestilo'));
        $stmt->bindValue(':id_piscina', $this->__get('id_piscina'));
        $stmt->execute();

        return $this;
    }
    public function getIndicesSorted()
    {
        $categoria = "SELECT anoIndice, tempoIndice, generoIndice, tipoIndice, ID_CATEGORIA, p.tamanhoPiscina, c.nomeCategoria, d.distancia, e.nomeEstilo FROM tb_indices
     INNER JOIN tb_categoria AS c ON ID_CATEGORIA = c.IDCATEGORIA
     INNER JOIN tb_distancia AS d ON 
     (SELECT ID_DISTANCIA AS dist FROM tba_distancia_estilo WHERE tb_indices.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = d.IDDISTANCIA
     INNER JOIN tb_estilo AS e ON 
     (SELECT ID_ESTILO AS est FROM tba_distancia_estilo WHERE tb_indices.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = e.IDESTILO
     INNER JOIN tb_piscina AS p ON ID_PISCINA = p.IDPISCINA 
     ORDER BY ID_CATEGORIA ASC, ID_DISTANCIAESTILO ASC, anoIndice DESC;;";
        $stmt = $this->db->prepare($categoria);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getIndicesFiltered()
    {
        $indices = "SELECT anoIndice, tempoIndice, generoIndice, tipoIndice, ID_CATEGORIA, ID_DISTANCIAESTILO, p.tamanhoPiscina, c.nomeCategoria, d.distancia, e.nomeEstilo FROM tb_indices
     INNER JOIN tb_categoria AS c ON ID_CATEGORIA = c.IDCATEGORIA
     INNER JOIN tb_distancia AS d ON 
     (SELECT ID_DISTANCIA AS dist FROM tba_distancia_estilo WHERE tb_indices.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = d.IDDISTANCIA
     INNER JOIN tb_estilo AS e ON 
     (SELECT ID_ESTILO AS est FROM tba_distancia_estilo WHERE tb_indices.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = e.IDESTILO
     INNER JOIN tb_piscina AS p ON ID_PISCINA = p.IDPISCINA
     WHERE ";
        if (!empty($this->__get('anoIndice'))) {
            $indices .= "anoIndice = :anoIndice AND ";
        }
        if (!empty($this->__get('generoIndice'))) {
            $indices .= "generoIndice = :generoIndice AND ";
        }
        if (!empty($this->__get('tipoIndice'))) {
            $indices .= "tipoIndice = :tipoIndice AND ";
        }
        if (!empty($this->__get('id_distanciaestilo'))) {
            $indices .= "ID_DISTANCIAESTILO = :id_distanciaestilo AND ";
        }
        if (!empty($this->__get('id_categoria'))) {
            $indices .= "ID_CATEGORIA = :categoria AND ";
        }
        $indices .= "1 = 1 ";
        $indices .= "ORDER BY ID_DISTANCIAESTILO ASC, ID_CATEGORIA ASC,anoIndice DESC, generoIndice DESC;";

        $stmt = $this->db->prepare($indices);
        if (!empty($this->__get('anoIndice'))) {
            $stmt->bindValue(':anoIndice', $this->__get('anoIndice'));
        }
        if (!empty($this->__get('generoIndice'))) {
            $stmt->bindValue(':generoIndice', $this->__get('generoIndice'));
        }
        if (!empty($this->__get('tipoIndice'))) {
            $stmt->bindValue(':tipoIndice', $this->__get('tipoIndice'));
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

    public function getIndicesFilteredGrafico()
    {
        $indices = "SELECT anoIndice, tempoIndice, generoIndice, tipoIndice, ID_CATEGORIA, ID_DISTANCIAESTILO, p.tamanhoPiscina, c.nomeCategoria, d.distancia, e.nomeEstilo FROM tb_indices
     INNER JOIN tb_categoria AS c ON ID_CATEGORIA = c.IDCATEGORIA
     INNER JOIN tb_distancia AS d ON 
     (SELECT ID_DISTANCIA AS dist FROM tba_distancia_estilo WHERE tb_indices.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = d.IDDISTANCIA
     INNER JOIN tb_estilo AS e ON 
     (SELECT ID_ESTILO AS est FROM tba_distancia_estilo WHERE tb_indices.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = e.IDESTILO
     INNER JOIN tb_piscina AS p ON ID_PISCINA = p.IDPISCINA
     WHERE ";
        if (!empty($this->__get('anoIndice'))) {
            $indices .= "anoIndice = :anoIndice AND ";
        }
        if (!empty($this->__get('generoIndice'))) {
            $indices .= "generoIndice = :generoIndice AND ";
        }
        if (!empty($this->__get('tipoIndice'))) {
            $indices .= "tipoIndice = :tipoIndice AND ";
        }
        if (!empty($this->__get('tamanhoPiscina'))) {
            $indices .= "p.tamanhoPiscina = :tamanhoPiscina AND ";
        }
        if (!empty($this->__get('id_distanciaestilo'))) {
            $indices .= "ID_DISTANCIAESTILO = :id_distanciaestilo AND ";
        }
        if (!empty($this->__get('id_categoria'))) {
            $indices .= "(ID_CATEGORIA = :categoria ";
        }
        if (!empty($this->__get('p1'))) {
            $indices .= "OR ID_CATEGORIA = :p1 ";
        }
        if (!empty($this->__get('p2'))) {
            $indices .= "OR ID_CATEGORIA = :p2 ";
        }
        if (!empty($this->__get('i1'))) {
            $indices .= "OR ID_CATEGORIA = :i1 ";
        }
        if (!empty($this->__get('i2'))) {
            $indices .= "OR ID_CATEGORIA = :i2 ";
        }
        if (!empty($this->__get('jv1'))) {
            $indices .= "OR ID_CATEGORIA = :jv1 ";
        }
        if (!empty($this->__get('jv2'))) {
            $indices .= "OR ID_CATEGORIA = :jv2 ";
        }
        if (!empty($this->__get('jr1'))) {
            $indices .= "OR ID_CATEGORIA = :jr1 ";
        }
        if (!empty($this->__get('jr2'))) {
            $indices .= "OR ID_CATEGORIA = :jr2 ";
        }
        $indices .= ") AND 1 = 1 ";
        $indices .= "ORDER BY ID_DISTANCIAESTILO ASC, ID_CATEGORIA ASC,anoIndice DESC, generoIndice DESC;";

        $stmt = $this->db->prepare($indices);
        if (!empty($this->__get('anoIndice'))) {
            $stmt->bindValue(':anoIndice', $this->__get('anoIndice'));
        }
        if (!empty($this->__get('generoIndice'))) {
            $stmt->bindValue(':generoIndice', $this->__get('generoIndice'));
        }
        if (!empty($this->__get('tipoIndice'))) {
            $stmt->bindValue(':tipoIndice', $this->__get('tipoIndice'));
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
}
