<?php

namespace App\Model;


class Department extends GenericModel
{


    private $head_id;
    private $language;
    private $project_name;

    public function __construct($connection)
    {
        parent::__construct($connection);
        $this->table = TABLE_DEPARTMENTS;

    }


    public function insert()
    {
        $statement = $this->connection->prepare("INSERT INTO " . $this->table . " 
        (head_id, language, project_name) VALUES (?, ?, ?)");

        $result = $statement->execute([
            $this->head_id, $this->language, $this->project_name]);

        $this->connection = null;

        return $result;
    }

    public function update()
    {


        $statement = $this->connection->prepare("UPDATE " . $this->table . " SET
        head_id = ?, language = ?, project_name = ? WHERE id= ?");

        $result = $statement->execute([$this->head_id, $this->language,
            $this->project_name, $this->id]);

        $this->connection = null;

        return $result;
    }

    //TODO
//    public function countProgs(array $allDepts, array $progers)
//    {
//        $progPerDept = [];
//        foreach ($allDepts as $dept) {
//            foreach ($progers as $proger){
//
//            }
//        }
//    }

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