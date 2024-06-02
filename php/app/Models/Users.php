<?php

namespace App\Models;

use MF\Model\Model;

class Users extends Model
{

    private $iduser;
    private $username;
    private $passwd;
    private $user_name;
    private $user_id;
    private $permission;

    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function getAllUsers()
    {
        $users = "SELECT * FROM tb_users";
        $stmt = $this->db->prepare($users);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getUser()
    {
        $user = "SELECT * FROM tb_users WHERE IDUSER=:iduser";
        $stmt = $this->db->prepare($user);
        $stmt->bindValue(':iduser', $this->__get('iduser'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function saveUser()
    {
        $user = "INSERT INTO tb_users(username, passwd, user_name, user_id, permission)
         VALUES(:username, :passwd, :user_name, :user_id, :permission)";
        $stmt = $this->db->prepare($user);
        $stmt->bindValue(':username', $this->__get('username'));
        $stmt->bindValue(':passwd', sha1($this->__get('passwd')));
        $stmt->bindValue(':user_name', $this->__get('user_name'));
        $stmt->bindValue(':user_id', intval($this->__get('user_id')));
        $stmt->bindValue(':permission', $this->__get('permission'));
        $stmt->execute();

        return $this;
    }

    public function changeUser()
    {
        $user = "UPDATE tb_users SET username=:username, passwd=:passwd, user_name=:user_name, permission=:permission";
        $stmt = $this->db->prepare($user);
        $stmt->bindValue(':username', $this->__get('username'));
        $stmt->bindValue(':passwd', sha1($this->__get('passwd')));
        $stmt->bindValue(':user_name', $this->__get('user_name'));
        $stmt->bindValue(':permission', $this->__get('permission'));
        $stmt->execute();

        return $this;
    }

    public function deleteUser()
    {
        $user = "DELETE FROM tb_users WHERE IDUSER=:iduser";
        $stmt = $this->db->prepare($user);
        $stmt->bindValue(':iduser', $this->__get('iduser'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function login()
    {
        $user = "SELECT * FROM tb_users WHERE username=:username AND passwd=:passwd";
        $stmt = $this->db->prepare($user);
        $stmt->bindValue(':username', $this->__get('username'));
        $stmt->bindValue(':passwd', sha1($this->__get('passwd')));
        $stmt->execute();
        $user_authenticated = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($user_authenticated['username'] && $user_authenticated['IDUSER']) {
            $this->__set('iduser', $user_authenticated['IDUSER']);
            $this->__set('username', $user_authenticated['username']);
            $this->__set('user_name', $user_authenticated['user_name']);
            $this->__set('user_id', $user_authenticated['user_id']);
            $this->__set('permission', $user_authenticated['permission']);
        }

        return $this;
    }
}
