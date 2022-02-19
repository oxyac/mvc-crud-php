<?php
require_once __DIR__ . "/GenericModel.php";

class Programmer extends GenericModel
{


    private $first_name;
    private $last_name;
    private $level;
    private $department_id;
    private $phone;
    private $email;

    public function __construct($connection)
    {
        parent::__construct($connection);
        $this->table = TABLE_PROGRAMMERS;
    }

    public function getAllByDept($id)
    {
        //var_dump("GETALLBYDEPT ". $id);
        return $this->getByColumn("department_id", $id);
    }

    public function create()
    {
        $statement = $this->connection->prepare("INSERT INTO " . $this->table . " 
        (first_name, last_name, level, department_id, phone, email) VALUES (?, ?, ?, ?, ?, ?)");

        $result = $statement->execute([
            $this->first_name, $this->last_name,
            $this->level, $this->department_id,
            $this->phone, $this->email]);

        $this->connection = null;

        return $result;
    }

    public function update(){
        $statement = $this->connection->prepare("UPDATE ? SET
        first_name = ?, last_name = ?, level = ?, department_id=?, phone=?, email=? WHERE id= ?");

        $result = $statement->execute([
            $this->table, $this->first_name, $this->last_name,
            $this->level, $this->department_id,
            $this->phone, $this->email, $this->id]);

        $this->connection = null;

        return $result;
    }

    public static function parseLevel($progs){
        //var_dump($progs);
        foreach ($progs as $pData) {
            $i = $pData['id'];
            switch ($pData['level']) {

                case 1:

                    $progs[$i]['level']  =  'Junior';
                    break;
                case 2:
                    $progs[$i]['level'] =  'Middle';
                    break;
                case 3:
                    $progs[$i]['level'] =  'Senior';
                    break;
                default:
                    $progs[$i]['level'] =  'Junior';
            }
        }

        return $progs;


    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getDepartmentId()
    {
        return $this->department_id;
    }

    /**
     * @param mixed $department_id
     */
    public function setDepartmentId($department_id)
    {
        $this->department_id = $department_id;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }


}