<?php

namespace App\Model;

use App\Controller\Database;
use Exception;
use PDO;

class GenericModel
{
    protected $table = "";
    protected $connection;
    protected $id;

    public function __construct()
    {
        $this->connection = Database::connectDb();

    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getAll()
    {

        $statement = $this->connection->prepare("SELECT * FROM " . $this->table);
        $statement->execute();
        $this->connection = null;

        return $statement->fetchAll(PDO::FETCH_ASSOC);


    }

    //assignKeys($allProgs: Programmer[]) индексирует внешний массив по полю id внутреннего массива
    public function assignKeys($allProgs)
    {

        foreach ($allProgs as $arrId => $prog) {
            $allProgs[$prog['id']] = $prog;
            unset($allProgs[$arrId]);
        }
        return $allProgs;
    }

    public function parseHeadName($deptArr, $progers)
    {

        foreach ($deptArr as $id => $dept) {
            $deptArr[$id]['progs_count'] = 0;
            foreach ($progers as $proger) {
                if ($dept['head_id'] == $proger['id']) {
                    $deptArr[$id]['head_name'] = ucwords($proger['first_name'] . " " . $proger['last_name']);
                    
                }
                $deptArr[$id]['progs_count'] ++;

            }
        }

        return $deptArr;
    }


    public function getById($id)
    {

        $statement = $this->connection->prepare("SELECT * FROM " . $this->table . "  WHERE id = ?");
        $statement->execute([$id]);
        $this->connection = null;
        return $statement->fetch(PDO::FETCH_OBJ);

    }


    public function getByColumn($column, $value)
    {
        $statement = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE " . $column . " = " . $value);

        $statement->execute();
        $this->connection = null;
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }



    public function deleteById($id)
    {
        try {
            $statement = $this->connection->prepare("DELETE FROM " . $this->table . " WHERE id = ?");
            $statement->execute([$id]);
            $this->connection = null;
        } catch (Exception $e) {
            echo ' ---COULD NOT DELETE--- ' . $e->getMessage();
            return -1;
        }
    }

    public function deleteByColumn($column, $value)
    {
        try {
            $statement = $this->connection->prepare("DELETE FROM " . $this->table . " WHERE ? = ?");
            $statement->execute([$column, $value]);
            $this->connection = null;
        } catch (Exception $e) {
            echo ' ---COULD NOT DELETE COLUMN--- ' . $e->getMessage();
            return -1;
        }
    }
}