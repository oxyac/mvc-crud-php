<?php
namespace App\Controller;

use PDO;
use PDOException;
use Exception;

class Database{
    private $driver;
    private $host, $user, $pass, $database;

    public function __construct() {

        $this->driver="mysql";
        $this->host="localhost";
        $this->user="root";
        $this->pass="jsd67FGa";
        $this->database="og_db";
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
?>