<?php

namespace App\Models;

use MF\Model\Model;

class Torneio extends Model
{

    private int $idtorneio;
    private string $nomeTorneio;
    private string $dataTorneio;
    private string $dataFimTorneio;
    private int $id_complexo;
    private int $id_piscina;
    private int $id_federacao;

    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function getAllTorneios():array
    {
        $torneio = "SELECT IDTORNEIO,nomeTorneio, dataTorneio, dataFimTorneio, c.nomeFantasiaComplexo, c.fotoComplexo, p.tamanhoPiscina, f.nomeFantasiaFederacao, f.logoFederacao FROM tb_torneio INNER JOIN tb_complexo as c ON ID_COMPLEXO=c.IDCOMPLEXO INNER JOIN tb_piscina as p ON ID_PISCINA=p.IDPISCINA INNER JOIN tb_federacao as f ON ID_FEDERACAO=f.IDFEDERACAO ORDER BY dataTorneio DESC, nomeTorneio ASC";
        $stmt = $this->db->prepare($torneio);
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getTorneio():array
    {
        $torneio = "SELECT *, c.nomeFantasiaComplexo, p.tamanhoPiscina, f.nomeFantasiaFederacao, e.siglaEstado FROM tb_torneio INNER JOIN tb_complexo as c ON ID_COMPLEXO=c.IDCOMPLEXO INNER JOIN tb_piscina as p ON IDPISCINA=p.IDPISCINA INNER JOIN tb_federacao as f ON ID_FEDERACAO=f.IDFEDERACAO INNER JOIN tb_estado as e ON c.ID_ESTADO = e.IDESTADO WHERE idtorneio = :idtorneio";
        $stmt = $this->db->prepare($torneio);
        $stmt->bindValue(':idtorneio', $this->__get('idtorneio'));
        $stmt->execute();
        
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function saveTorneio():object
    {
        $torneio = "INSERT INTO tb_torneio(nomeTorneio, dataTorneio, dataFimTorneio, id_complexo, id_piscina, id_federacao) VALUES(:nomeTorneio, :dataTorneio, :dataFimTorneio, :id_complexo, :id_piscina, :id_federacao)";
        $stmt = $this->db->prepare($torneio);
        $stmt->bindValue(':nomeTorneio', $this->__get('nomeTorneio'));
        $stmt->bindValue(':dataTorneio', $this->__get('dataTorneio'));
        $stmt->bindValue(':dataFimTorneio', $this->__get('dataFimTorneio'));
        $stmt->bindValue(':id_complexo', $this->__get('id_complexo'));
        $stmt->bindValue(':id_piscina', $this->__get('id_piscina'));
        $stmt->bindValue(':id_federacao', $this->__get('id_federacao'));
        $stmt->execute();
       
        return $this;
    }
    public function updateTorneio():object
    {
        $torneio = "UPDATE tb_torneio SET nomeTorneio = :nomeTorneio, dataTorneio = :dataTorneio, dataFimTorneio = :dataFimTorneio, id_complexo = :id_complexo, id_piscina = :id_piscina, id_federacao = :id_federacao WHERE idtorneio = :idtorneio";
        $stmt = $this->db->prepare($torneio);
        $stmt->bindValue(':idtorneio', $this->__get('idtorneio'));
        $stmt->bindValue(':nomeTorneio', $this->__get('nomeTorneio'));
        $stmt->bindValue(':dataTorneio', $this->__get('dataTorneio'));
        $stmt->bindValue(':dataFimTorneio', $this->__get('dataFimTorneio'));
        $stmt->bindValue(':id_complexo', $this->__get('id_complexo'));
        $stmt->bindValue(':id_piscina', $this->__get('id_piscina'));
        $stmt->bindValue(':id_federacao', $this->__get('id_federacao'));
        $stmt->execute();
        
        return $this;
    }

    public function deleteTorneio():object
    {
        $torneio = "DELETE FROM tb_torneio WHERE IDTORNEIO = :idtorneio";
        $stmt = $this->db->prepare($torneio);
        $stmt->bindValue(':idtorneio', $this->__get('idtorneio'));
        $stmt->execute();
        
        return $this;
    }
}
