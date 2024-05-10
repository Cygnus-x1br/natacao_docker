<?php

namespace App;

require_once __DIR__ . '/Env.php';

class Connection
{

    public static function getDB()
    {
        try {

            $conn = new \PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASSWD);
            //echo 'Connected...';
            return $conn;
        } catch (\PDOException $err) {
            echo $err->getMessage();
        }
    }
}
