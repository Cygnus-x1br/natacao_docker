<?php

namespace App\Models;

use MF\Model\Model;

class Prova extends Model
{
    private $idprova;
    private $numeroProva;
    private $genero;
    private $id_torneio;
    private $id_distanciaestilo;
    private $categoria_min;
    private $categoria_max;
    private $numeroProvasShowed;


    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function getAllProvas()
    {
        $prova = "SELECT idprova ,numeroProva, genero, id_torneio, ID_CATEGORIA_MIN, ID_CATEGORIA_MAX, t.nomeTorneio, t.dataTorneio, f.nomeFantasiaFederacao, p.tamanhoPiscina, d.distancia, e.nomeEstilo, cmin.nomeCategoria AS categoriaMinima, cmax.nomeCategoria AS categoriaMaxima FROM tb_prova
INNER JOIN tb_torneio AS t ON ID_TORNEIO = t.IDTORNEIO
INNER JOIN tb_federacao AS f ON 
(SELECT tb_torneio.ID_FEDERACAO FROM tb_torneio WHERE tb_prova.ID_TORNEIO = tb_torneio.IDTORNEIO) = f.IDFEDERACAO
INNER JOIN tb_distancia AS d ON 
(SELECT ID_DISTANCIA AS dist FROM tba_distancia_estilo WHERE tb_prova.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = d.IDDISTANCIA
INNER JOIN tb_estilo AS e ON 
(SELECT ID_ESTILO AS est FROM tba_distancia_estilo WHERE tb_prova.ID_DISTANCIAESTILO = IDDISTANCIAESTILO) = e.IDESTILO
INNER JOIN tb_piscina AS p ON t.ID_PISCINA = p.IDPISCINA
INNER JOIN tb_categoria AS cmin ON ID_CATEGORIA_MIN = cmin.IDCATEGORIA
INNER JOIN tb_categoria AS cmax ON ID_CATEGORIA_MAX = cmax.IDCATEGORIA
ORDER BY t.dataTorneio DESC, numeroProva ASC;";
        $stmt = $this->db->prepare($prova);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getProvaMin()
    {
        $prova = "SELECT *, t.dataTorneio FROM tb_prova 
        INNER JOIN tb_torneio AS t ON ID_TORNEIO = t.IDTORNEIO
        WHERE IDPROVA = :idprova";
        $stmt = $this->db->prepare($prova);
        $stmt->bindValue(':idprova', $this->__get('idprova'));
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function saveProva()
    {
        $prova = "INSERT INTO tb_prova (IDPROVA, numeroProva, genero, ID_TORNEIO, ID_DISTANCIAESTILO, ID_CATEGORIA_MIN, ID_CATEGORIA_MAX) VALUES (NULL, :numeroProva, :genero, :id_torneio, :id_distanciaestilo, :id_categoria_min, :id_categoria_max)";
        $stmt = $this->db->prepare($prova);
        $stmt->bindValue(':numeroProva', $this->__get('numeroProva'));
        $stmt->bindValue(':genero', $this->__get('genero'));
        $stmt->bindValue(':id_torneio', $this->__get('id_torneio'));
        $stmt->bindValue(':id_distanciaestilo', $this->__get('id_distanciaestilo'));
        $stmt->bindValue(':id_categoria_min', $this->__get('id_categoria_min'));
        $stmt->bindValue(':id_categoria_max', $this->__get('id_categoria_max'));
        $stmt->execute();
        return $this;
    }
}
