<?php
namespace App\Controller;

use PDO;
use Exception;
use PDOException;
use Conf\DbConfig;

class Database{

    public static function connectDb(){

        $statement = DbConfig::DB_DRIVER .':host='. DbConfig::DB_HOST .  ';dbname=' . DbConfig::DB_DATABASE;

        try {
            $connection = new PDO($statement, DbConfig::DB_USER, DbConfig::DB_PASS);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            throw new Exception('Could not connect to DB...');
        }
    }


}
