<?php

namespace App\Models;

use MF\Model\Model;

class Atleta extends Model
{
    private $idatleta;
    private $nomeAtleta;
    private $sobreNomeAtleta;
    private $apelidoAtleta;
    private $emailAtleta;
    private $dataNascAtleta;
    private $cpfAtleta;
    private $numRegistroAtleta;
    private $sexoAtleta;
    private $rgAtleta;
    private $fotoAtleta;
    private $instagramAtleta;
    private $facebookAtleta;
    private $telefoneAtleta;
    private $whatsappAtleta;
    private $celularAtleta;
    private $id_equipe;


    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }
    public function getAtleta()
    {
        $atleta = "SELECT * FROM tb_atleta WHERE IDATLETA=:idatleta";
        $stmt = $this->db->prepare($atleta);
        $stmt->bindValue(':idatleta', $this->__get('idatleta'));
        $stmt->execute();

        //return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function getAtletaNome()
    {
        $atleta = "SELECT * FROM tb_atleta WHERE sobreNomeAtleta=:sobreNomeAtleta AND nomeAtleta=:nomeAtleta";
        $stmt = $this->db->prepare($atleta);
        $stmt->bindValue(':sobreNomeAtleta', $this->__get('sobreNomeAtleta'));
        $stmt->bindValue(':nomeAtleta', $this->__get('nomeAtleta'));
        $stmt->execute();

        //return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function addAtleta()
    {

        $atleta = "INSERT INTO tb_atleta(nomeAtleta,
            sobreNomeAtleta,
             apelidoAtleta,
              emailAtleta,
               dataNascAtleta,
                cpfAtleta,
                 numRegistroAtleta,
                  sexoAtleta,
                   rgAtleta,
                    fotoAtleta,
                     instagramAtleta,
                      facebookAtleta,
                       telefoneAtleta,
                        whatsappAtleta,
                          id_equipe)
         VALUES(:nomeAtleta,
         :sobreNomeAtleta,
          :apelidoAtleta,
           :emailAtleta,
            :dataNascAtleta,
             :cpfAtleta,
              :numRegistroAtleta,
               :sexoAtleta,
                :rgAtleta,
                 :fotoAtleta,
                  :instagramAtleta,
                   :facebookAtleta,
                    :telefoneAtleta,
                     :whatsappAtleta,
                       :id_equipe)";
        $stmt = $this->db->prepare($atleta);
        $stmt->bindValue(':nomeAtleta', $this->__get('nomeAtleta'));
        $stmt->bindValue(':sobreNomeAtleta', $this->__get('sobreNomeAtleta'));
        $stmt->bindValue(':apelidoAtleta', $this->__get('apelidoAtleta'));
        $stmt->bindValue(':emailAtleta', $this->__get('emailAtleta'));
        $stmt->bindValue(':dataNascAtleta', $this->__get('dataNascAtleta'));
        $stmt->bindValue(':cpfAtleta', $this->__get('cpfAtleta'));
        $stmt->bindValue(':numRegistroAtleta', $this->__get('numRegistroAtleta'));
        $stmt->bindValue(':sexoAtleta', $this->__get('sexoAtleta'));
        $stmt->bindValue(':rgAtleta', $this->__get('rgAtleta'));
        $stmt->bindValue(':fotoAtleta', $this->__get('fotoAtleta'));
        $stmt->bindValue(':instagramAtleta', $this->__get('instagramAtleta'));
        $stmt->bindValue(':facebookAtleta', $this->__get('facebookAtleta'));
        $stmt->bindValue(':telefoneAtleta', $this->__get('telefoneAtleta'));
        $stmt->bindValue(':whatsappAtleta', $this->__get('whatsappAtleta'));
        $stmt->bindValue(':id_equipe', $this->__get('id_equipe'));
        $stmt->execute();

        return $this;
    }
}
