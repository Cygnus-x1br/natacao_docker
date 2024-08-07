<?php

namespace App\Models;

use MF\Model\Model;

class Complexo extends Model
{
    private int $idcomplexo;
    private string $nomeComplexo;
    private string $nomeFantasiaComplexo;
    private string $fotoComplexo;
    private string $enderecoComplexo;
    private string $bairroComplexo;
    private string $cepComplexo;
    private string $cidadeComplexo;
    private float $latitudeComplexo;
    private float $longitudeComplexo;
    private string $observacaoComplexo;
    private int $id_estado;
    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function getAllComplexos():array
    {
        $complexo = "SELECT *, e.nomeEstado, e.siglaEstado FROM tb_complexo 
                     INNER JOIN tb_estado AS e ON ID_ESTADO = e.IDESTADO 
                     ORDER BY IDCOMPLEXO DESC";
        $stmt = $this->db->prepare($complexo);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getComplexo():array
    {
        $complexo = "SELECT *, e.nomeEstado, e.siglaEstado FROM tb_complexo 
                     INNER JOIN tb_estado AS e ON ID_ESTADO = e.IDESTADO 
                     WHERE IDCOMPLEXO = :idcomplexo 
                     ORDER BY IDCOMPLEXO DESC";
        $stmt = $this->db->prepare($complexo);
        $stmt->bindValue(':idcomplexo', $this->__get('idcomplexo'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function saveComplexo():object
    {
        $complexo = "INSERT INTO tb_complexo(
                        nomeComplexo,
                        nomeFantasiaComplexo,
                        fotoComplexo,
                        enderecoComplexo,
                        bairroComplexo,
                        cidadeComplexo,
                        observacaoComplexo,
                        ID_ESTADO)
                     VALUES(
                        :nomeComplexo,
                        :nomeFantasiaComplexo,
                        :fotoComplexo,
                        :enderecoComplexo,
                        :bairroComplexo,
                        :cidadeComplexo,
                        :observacaoComplexo,
                        :id_estado)";
        
        $stmt = $this->db->prepare($complexo);
        $stmt->bindValue(':nomeComplexo', $this->__get('nomeComplexo'));
        $stmt->bindValue(':nomeFantasiaComplexo', $this->__get('nomeFantasiaComplexo'));
        $stmt->bindValue(':fotoComplexo', $this->__get('fotoComplexo'));
        $stmt->bindValue(':enderecoComplexo', $this->__get('enderecoComplexo'));
        $stmt->bindValue(':bairroComplexo', $this->__get('bairroComplexo'));
        $stmt->bindValue(':cidadeComplexo', $this->__get('cidadeComplexo'));
        $stmt->bindValue(':observacaoComplexo', $this->__get('observacaoComplexo'));
        $stmt->bindValue(':id_estado', $this->__get('id_estado'));
        $stmt->execute();

        return $this;
    }

    public function updateComplexo():object
    {
        $complexo = "UPDATE tb_complexo 
                     SET nomeComplexo = :nomeComplexo,
                         nomeFantasiaComplexo = :nomeFantasiaComplexo,
                         fotoComplexo = :fotoComplexo,
                         enderecoComplexo = :enderecoComplexo,
                         bairroComplexo = :bairroComplexo,
                         cidadeComplexo = :cidadeComplexo,
                         observacaoComplexo = :observacaoComplexo,
                         ID_ESTADO = :id_estado
                     WHERE IDCOMPLEXO = :idcomplexo";

        $stmt = $this->db->prepare($complexo);
        $stmt->bindValue(':nomeComplexo', $this->__get('nomeComplexo'));
        $stmt->bindValue(':nomeFantasiaComplexo', $this->__get('nomeFantasiaComplexo'));
        $stmt->bindValue(':fotoComplexo', $this->__get('fotoComplexo'));
        $stmt->bindValue(':enderecoComplexo', $this->__get('enderecoComplexo'));
        $stmt->bindValue(':bairroComplexo', $this->__get('bairroComplexo'));
        $stmt->bindValue(':cidadeComplexo', $this->__get('cidadeComplexo'));
        $stmt->bindValue(':observacaoComplexo', $this->__get('observacaoComplexo'));
        $stmt->bindValue(':id_estado', $this->__get('id_estado'));
        $stmt->bindValue(':idcomplexo', $this->__get('idcomplexo'));

        $stmt->execute();

        return $this;
    }

    public function deleteComplexo():object
    {
        $complexo = "DELETE FROM tb_complexo WHERE IDCOMPLEXO = :idcomplexo";
        $stmt = $this->db->prepare($complexo);
        $stmt->bindValue(':idcomplexo', $this->__get('idcomplexo'));
        $stmt->execute();

        return $this;
    }
}
