<?php

namespace App\Model;

use Conf\Globals;
use Exception;

class Department extends GenericModel
{


    private $head_id;
    private $language;
    private $project_name;

    public function __construct()
    {
        parent::__construct();
        $this->table = Globals::TABLE_DEPARTMENTS;

    }


    public function insert()
    {
        var_dump($this->table);
        $statement = $this->connection->prepare("INSERT INTO " . $this->table . " 
        (head_id, language, project_name) VALUES (?, ?, ?)");

        $result = $statement->execute([
            null, $this->language, $this->project_name]);

        $this->connection = null;

        return $result;
    }

    public function update()
    {


        $statement = $this->connection->prepare("UPDATE " . $this->table . " SET
        language = ?, project_name = ? WHERE id= ?");

        $result = $statement->execute([$this->language,
            $this->project_name, $this->id]);

        $this->connection = null;

        return $result;
    }


    public function countProgs(array $allDepts, array $progers) : array
    {

        $progPerDeptId = [];
        foreach ($progers as $proger) {
            foreach ($allDepts as $dept) {
                if($proger['department_id'] == $dept['id']){
                    $progPerDeptId[$dept['id']]++;
                }
            }
        }
        return $progPerDeptId;
    }

    public function deleteById($id)
    {
        try {
            $statement = $this->connection->prepare("DELETE FROM " . $this->table . " WHERE id = ?");
            $statement->execute([$id]);

            $statement = $this->connection->prepare("UPDATE programator
                                                     SET department_id = null
                                                     WHERE department_id = ?");
            $statement->execute([$id]);

            $this->connection = null;
        } catch (Exception $e) {
            echo ' ---COULD NOT DELETE--- ' . $e->getMessage();
            return -1;
        }
    }

    public function updateHeadId()
    {


        $statement = $this->connection->prepare("UPDATE " . $this->table . " SET
        head_id = ? WHERE id= ?");

        $result = $statement->execute([$this->head_id, $this->id]);

        $this->connection = null;

        return $result;
    }

    /**
     * @return mixed
     */
    public function getHeadId()
    {
        return $this->head_id;
    }

    /**
     * @param mixed $head_id
     */
    public function setHeadId($head_id)
    {
        $this->head_id = $head_id;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getProjectName()
    {
        return $this->project_name;
    }

    /**
     * @param mixed $project_name
     */
    public function setProjectName($project_name)
    {
        $this->project_name = $project_name;
    }




}