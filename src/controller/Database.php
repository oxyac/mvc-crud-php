<?php


class Database{
    private $driver;
    private $host, $user, $pass, $database;

    public function __construct() {

        $this->driver="mysql";
        $this->host="localhost";
        $this->user="og";
        $this->pass="ghimpolism";
        $this->database="og_db";
    }

    public function connectDb(){

        $statement = $this->driver .':host='. $this->host .  ';dbname=' . $this->database;

        try {
            $connection = new PDO($statement, $this->user, $this->pass);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            throw new Exception('Could not connect to DB...');
        }
    }

//    public function closeDb(){
//        $this->database = null;
//    }


}
?>