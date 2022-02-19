<?php
class Database{
    private $driver;
    private $host, $user, $pass, $database;

    public function __construct() {
        require_once '../config/db.php';

        $this->driver=DB_DRIVER;
        $this->host=DB_HOST;
        $this->user=DB_USER;
        $this->pass=DB_PASS;
        $this->database=DB_DATABASE;
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