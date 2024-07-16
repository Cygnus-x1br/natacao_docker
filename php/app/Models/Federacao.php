<?php

namespace App\Models;

use MF\Model\Model;

class Federacao extends Model
{
    private int $idfederacao;
    private string $nomeFederacao;
    private string $nomeFantasiaFederacao;
    private string $logoFederacao;
    private string $siteFederacao;
    private string $emailFederacao;
    private string $telefoneFederacao;
    private string $facebookFederacao;
    private string $instagramFederacao;
    private int $ID_ESTADO;

    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function getAllFederacoes():array
    {
        $federacao = "SELECT *, e.nomeEstado AS nomeEstado, e.siglaEstado AS siglaEstado FROM tb_federacao 
                      INNER JOIN tb_estado AS e ON ID_ESTADO = e.IDESTADO 
                      ORDER BY nomeFederacao ASC";
        $stmt = $this->db->prepare($federacao);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getFederacao():array
    {
        $federacao = "SELECT *, e.nomeEstado AS nomeEstado, e.siglaEstado AS siglaEstado FROM tb_federacao 
                      INNER JOIN tb_estado AS e ON ID_ESTADO = e.IDESTADO 
                      WHERE IDFEDERACAO = :idfederacao 
                      ORDER BY nomeFederacao DESC";
        $stmt = $this->db->prepare($federacao);
        $stmt->bindValue(':idfederacao', $this->__get('idfederacao'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function addFederacao():object
    {
        $federacao = "INSERT INTO tb_federacao(
                         nomeFederacao, 
                         nomeFantasiaFederacao, 
                         logoFederacao, 
                         siteFederacao, 
                         emailFederacao, 
                         telefoneFederacao, 
                         facebookFederacao, 
                         instagramFederacao, 
                         ID_ESTADO) 
                      VALUES(
                         :nomeFederacao, 
                         :nomeFantasiaFederacao, 
                         :logoFederacao, 
                         :siteFederacao, 
                         :emailFederacao, 
                         :telefoneFederacao, 
                         :facebookFederacao, 
                         :instagramFederacao, 
                         :ID_ESTADO)";
        $stmt = $this->db->prepare($federacao);
        $stmt->bindValue(':nomeFederacao', $this->__get('nomeFederacao'));
        $stmt->bindValue(':nomeFantasiaFederacao', $this->__get('nomeFantasiaFederacao'));
        $stmt->bindValue(':logoFederacao', $this->__get('logoFederacao'));
        $stmt->bindValue(':siteFederacao', $this->__get('siteFederacao'));
        $stmt->bindValue(':emailFederacao', $this->__get('emailFederacao'));
        $stmt->bindValue(':telefoneFederacao', $this->__get('telefoneFederacao'));
        $stmt->bindValue(':facebookFederacao', $this->__get('facebookFederacao'));
        $stmt->bindValue(':instagramFederacao', $this->__get('instagramFederacao'));
        $stmt->bindValue(':ID_ESTADO', $this->__get('id_estado'));
        $stmt->execute();

        return $this;
    }
    public function updateFederacao():object
    {
        $federacao = "UPDATE tb_federacao SET 
                        nomeFederacao = :nomeFederacao, 
                        nomeFantasiaFederacao = :nomeFantasiaFederacao, 
                        logoFederacao = :logoFederacao, 
                        siteFederacao = :siteFederacao, 
                        emailFederacao = :emailFederacao, 
                        telefoneFederacao = :telefoneFederacao, 
                        facebookFederacao = :facebookFederacao, 
                        instagramFederacao = :instagramFederacao, 
                        ID_ESTADO = :ID_ESTADO 
                      WHERE IDFEDERACAO = :idfederacao";
        $stmt = $this->db->prepare($federacao);
        $stmt->bindValue(':idfederacao', $this->__get('idfederacao'));
        $stmt->bindValue(':nomeFederacao', $this->__get('nomeFederacao'));
        $stmt->bindValue(':nomeFantasiaFederacao', $this->__get('nomeFantasiaFederacao'));
        $stmt->bindValue(':logoFederacao', $this->__get('logoFederacao'));
        $stmt->bindValue(':siteFederacao', $this->__get('siteFederacao'));
        $stmt->bindValue(':emailFederacao', $this->__get('emailFederacao'));
        $stmt->bindValue(':telefoneFederacao', $this->__get('telefoneFederacao'));
        $stmt->bindValue(':facebookFederacao', $this->__get('facebookFederacao'));
        $stmt->bindValue(':instagramFederacao', $this->__get('instagramFederacao'));
        $stmt->bindValue(':ID_ESTADO', $this->__get('id_estado'));
        $stmt->execute();

        return $this;
    }

    public function deleteFederacao():object
    {
        $federacao = "DELETE FROM tb_federacao WHERE IDFEDERACAO = :idfederacao";
        $stmt = $this->db->prepare($federacao);
        $stmt->bindValue(':idfederacao', $this->__get('idfederacao'));
        $stmt->execute();

        return $this;
    }
}
