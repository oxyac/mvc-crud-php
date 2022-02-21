<?php
namespace App\Controller;

use PDO;
use Exception;
use PDOException;
use Conf\DbConfig;

class Database{

    

    private $driver;
    private $host, $user, $pass, $database;

    public function __construct() {

        // DbConfig::DB_DATABASE;

        $this->driver=DbConfig::DB_DRIVER;
        $this->host=DbConfig::DB_HOST;
        $this->user=DbConfig::DB_USER;
        $this->pass=DbConfig::DB_PASS;
        $this->database=DbConfig::DB_DATABASE;
    }

    public function connectDb(){

        $statement = $this->driver .':host='. $this->host .  ';dbname=' . $this->database;

        try {
            $connection = new PDO($statement, $this->user, $this->pass);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            throw new Exception('Could not connect to DB...' . $connection);
        }
    }

//    public function closeDb(){
//        $this->database = null;
//    }


}
