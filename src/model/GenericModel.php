<?php

class GenericModel {
    protected $table = "";
    protected $connection;
    protected $id;

    public function __construct($connection) {
        $this->connection = $connection;

    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getAll(){

        $statement = $this->connection->prepare("SELECT * FROM " . $this->table);
        $statement->execute();
        $this->connection = null;

        return $statement->fetchAll(PDO::FETCH_ASSOC);


    }

    //assignKeys($allProgs: Programmer[]) индексирует внешний массив по полю id внутреннего массива
    public function assignKeys($allProgs){
        //var_dump($allProgs);
        foreach($allProgs as $arrId => $prog){
            $allProgs[$prog['id']]= $prog;
            unset($allProgs[$arrId]);
        }
        return $allProgs;
    }


    public function getById($id){

        $statement = $this->connection->prepare("SELECT * FROM " . $this->table . "  WHERE id = ?");

        $statement->execute([$id]);
        $this->connection = null;
        return $statement->fetch(PDO::FETCH_OBJ);

    }

    public function getByColumn($column, $value){
        var_dump("COLUMN: " . $column . " VALUE: " . $value);
        $statement = $this->connection->prepare("SELECT * FROM ? WHERE ? = ?");
        $statement->execute([$this->table, $column, $value]);
        var_dump($statement->fetchAll(PDO::FETCH_ASSOC));
        //$this->connection = null;
        return $statement->fetchAll();
    }

    public function deleteById($id){
        try {
            $statement = $this->connection->prepare("DELETE FROM " . $this->table . " WHERE id = ?");
            $statement->execute([$id]);
            $this->connection = null;
        } catch (Exception $e) {
            echo ' ---COULD NOT DELETE--- ' . $e->getMessage();
            return -1;
        }
    }

    public function deleteByColumn($column,$value){
        try {
            $statement = $this->connection->prepare("DELETE FROM " . $this->table . " WHERE ? = ?");
            $statement->execute([$column,$value]);
            $this->connection = null;
        } catch (Exception $e) {
            echo ' ---COULD NOT DELETE COLUMN--- ' . $e->getMessage();
            return -1;
        }
    }
}