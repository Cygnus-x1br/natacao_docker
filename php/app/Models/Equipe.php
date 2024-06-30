<?php

namespace App\Models;

use MF\Model\Model;

class Equipe extends Model
{
    private $idequipe;
    private $nomeEquipe;
    private $nomeFantasiaEquipe;
    private $logoEquipe;
    private $siteEquipe;
    private $emailEquipe;
    private $telefoneEquipe;
    private $facebookEquipe;
    private $instagramEquipe;
    private $id_federacao;
    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function getAllEquipes()
    {
        $equipe = "SELECT *, f.nomeFantasiaFederacao FROM tb_equipe INNER JOIN tb_federacao AS f ON ID_FEDERACAO = f.IDFEDERACAO ORDER BY IDEQUIPE DESC";
        $stmt = $this->db->prepare($equipe);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getEquipe()
    {
        $note = "SELECT * FROM tb_equipe WHERE IDEQUIPE=:idequipe";
        $stmt = $this->db->prepare($note);
        $stmt->bindValue(':idequipe', $this->__get('idequipe'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function verificaCadastro($verifyData)
    {
        $equipe = "SELECT $verifyData FROM tb_equipe WHERE $verifyData=:$verifyData";
        $stmt = $this->db->prepare($equipe);
        $stmt->bindValue(":" . $verifyData, $this->__get($verifyData));
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function addEquipe()
    {
        $equipe = "INSERT INTO tb_equipe(nomeEquipe, nomeFantasiaEquipe, logoEquipe, siteEquipe, emailEquipe, telefoneEquipe, facebookEquipe, instagramEquipe, ID_FEDERACAO)
         VALUES(:nomeEquipe, :nomeFantasiaEquipe, :logoEquipe, :siteEquipe, :emailEquipe, :telefoneEquipe, :facebookEquipe, :instagramEquipe, :id_federacao)";
        $stmt = $this->db->prepare($equipe);
        $stmt->bindValue(':nomeEquipe', $this->__get('nomeEquipe'));
        $stmt->bindValue(':nomeFantasiaEquipe', $this->__get('nomeFantasiaEquipe'));
        $stmt->bindValue(':logoEquipe', $this->__get('logoEquipe'));
        $stmt->bindValue(':siteEquipe', $this->__get('siteEquipe'));
        $stmt->bindValue(':emailEquipe', $this->__get('emailEquipe'));
        $stmt->bindValue(':telefoneEquipe', $this->__get('telefoneEquipe'));
        $stmt->bindValue(':facebookEquipe', $this->__get('facebookEquipe'));
        $stmt->bindValue(':instagramEquipe', $this->__get('instagramEquipe'));
        $stmt->bindValue(':id_federacao', $this->__get('id_federacao'));
        $stmt->execute();

        return $this;
    }

    public function editEquipe()
    {
        $equipe = "UPDATE tb_equipe
    SET nomeEquipe = :nomeEquipe,
    nomeFantasiaEquipe = :nomeFantasiaEquipe,
    logoEquipe = :logoEquipe,
    siteEquipe = :siteEquipe,
    emailEquipe = :emailEquipe,
    telefoneEquipe = :telefoneEquipe,
    facebookEquipe = :facebookEquipe,
    instagramEquipe = :instagramEquipe,
    ID_FEDERACAO = :id_federacao
    WHERE IDEQUIPE = :idequipe";
        $stmt = $this->db->prepare($equipe);
        $stmt->bindValue(':idequipe', $this->__get('idequipe'));
        $stmt->bindValue(':nomeEquipe', $this->__get('nomeEquipe'));
        $stmt->bindValue(':nomeFantasiaEquipe', $this->__get('nomeFantasiaEquipe'));
        $stmt->bindValue(':logoEquipe', $this->__get('logoEquipe'));
        $stmt->bindValue(':siteEquipe', $this->__get('siteEquipe'));
        $stmt->bindValue(':emailEquipe', $this->__get('emailEquipe'));
        $stmt->bindValue(':telefoneEquipe', $this->__get('telefoneEquipe'));
        $stmt->bindValue(':facebookEquipe', $this->__get('facebookEquipe'));
        $stmt->bindValue(':instagramEquipe', $this->__get('instagramEquipe'));
        $stmt->bindValue(':id_federacao', $this->__get('id_federacao'));
        $stmt->execute();

        return $this;
    }

    public function deleteEquipe()
    {
        $equipe = "DELETE FROM tb_equipe WHERE IDEQUIPE = :idequipe";
        $stmt = $this->db->prepare($equipe);
        $stmt->bindValue(':idequipe', $this->__get('idequipe'));
        $stmt->execute();

        return $this;
    }
}
