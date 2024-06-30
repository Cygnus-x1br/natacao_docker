<?php

namespace App\Models;

use MF\Model\Model;

class Federacao extends Model
{
    private $idfederacao;
    private $nomeFederacao;
    private $nomeFantasiaFederacao;
    private $logoFederacao;
    private $siteFederacao;
    private $emailFederacao;
    private $telefoneFederacao;
    private $facebookFederacao;
    private $instagramFederacao;
    private $ID_ESTADO;

    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function getAllFederacoes()
    {
        $federacao = "SELECT *, e.nomeEstado AS nomeEstado, e.siglaEstado AS siglaEstado FROM tb_federacao INNER JOIN tb_estado AS e ON ID_ESTADO = e.IDESTADO ORDER BY nomeFederacao DESC";
        $stmt = $this->db->prepare($federacao);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getFederacao()
    {
        $federacao = "SELECT *, e.nomeEstado AS nomeEstado, e.siglaEstado AS siglaEstado FROM tb_federacao INNER JOIN tb_estado AS e ON ID_ESTADO = e.IDESTADO WHERE IDFEDERACAO = :idfederacao ORDER BY nomeFederacao DESC";

        $stmt = $this->db->prepare($federacao);
        $stmt->bindValue(':idfederacao', $this->__get('idfederacao'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function addFederacao()
    {
        $federacao = "INSERT INTO tb_federacao(nomeFederacao, nomeFantasiaFederacao, logoFederacao, siteFederacao, emailFederacao, telefoneFederacao, facebookFederacao, instagramFederacao, ID_ESTADO) VALUES(:nomeFederacao, :nomeFantasiaFederacao, :logoFederacao, :siteFederacao, :emailFederacao, :telefoneFederacao, :facebookFederacao, :instagramFederacao, :ID_ESTADO)";
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
    public function editFederacao()
    {
        // print_r($_POST);
        $federacao = "UPDATE tb_federacao SET nomeFederacao = :nomeFederacao, nomeFantasiaFederacao = :nomeFantasiaFederacao, logoFederacao = :logoFederacao, siteFederacao = :siteFederacao, emailFederacao = :emailFederacao, telefoneFederacao = :telefoneFederacao, facebookFederacao = :facebookFederacao, instagramFederacao = :instagramFederacao, ID_ESTADO = :ID_ESTADO WHERE IDFEDERACAO = :idfederacao";

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

        print_r($stmt);

        return $this;
    }

    public function deleteFederacao()
    {
        $federacao = "DELETE FROM tb_federacao WHERE IDFEDERACAO = :idfederacao";
        $stmt = $this->db->prepare($federacao);
        $stmt->bindValue(':idfederacao', $this->__get('idfederacao'));
        $stmt->execute();

        return $this;
    }
}
