<?php
class DepartmentController{

    private $database;
    private $connection;

    public function __construct() {
        require_once __DIR__ . "/Database.php";
        require_once __DIR__ . "/../model/Department.php";
        require_once __DIR__ . "/../model/Programmer.php";

        $this->database=new Database();
        $this->connection=$this->database->connectDb();

    }


    public function run($action){
        switch($action)
        {

            case "showNew" :
                $this->showNew();
                break;
            case "create" :
                $this->create();
                break;
            case "details" :
                $this->details();
                break;
            case "update" :
                $this->update();
                break;
            case "delete" :
                $this->delete();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index(){

        $dept = new Department($this->connection);
        $allDepts = $dept->getAll();

        $proger = new Programmer($this->connection);
        $progers = $proger->getAll();

        foreach ($allDepts as $id => $dept){
            $allDepts[$id]['progs_count'] = 1;
            foreach($progers as $proger){
                if($dept['head_id'] == $proger['id']){
                    $allDepts[$id]['head_name'] = ucwords($proger['first_name'] . " " . $proger['last_name']);
                }



            }
        }
        var_dump($allDepts);
        /*
  [4]=>
  array(7) {
    ["id"]=>
    int(15)
    ["first_name"]=>
    string(8) "sadgsadg"
    ["last_name"]=>
    string(5) "wegwe"
    ["level"]=>
    int(2)
    ["department_id"]=>
    int(2)
    ["phone"]=>
    int(3425432)
    ["email"]=>
    string(7) "2345432"
  }*/

        /*
  [0]=>
  array(4) {
    ["id"]=>
    int(1)
    ["head_id"]=>
    int(12)
    ["language"]=>
    string(4) "PHP2"
    ["project_name"]=>
    string(5) "USSD2"
  }*/


        $this->view("index", array(
            "departments" => $allDepts,
            "title" => "ALL ARTISTS"
        ));
    }


    public function details(){


        $dept = new Department($this->connection);
        $departObj = $dept ->getById($_GET["id"]);
        $dept->setHeadId($departObj->head_id);

        $proger = new Programmer($this->connection);
        $progers = Programmer::parseLevel($proger->assignKeys($proger->getAllByDept($_GET['id'])));

        $headId = $dept->getHeadId();


        var_dump( "->" . $progers . "<-");
        var_dump($departObj);

        $this->view("depDetails",array(
            "department" => $departObj,
            "progers" => $progers,
            "head_id" => $headId,
            "title" => "Department Details"
        ));
    }

    public function showNew(){

        $proger = new Programmer($this->connection);
        $progers = $proger->getAll();


        $this->view("newDep",array(
            "progers"=> $progers,
            "title" => "NEW DEPARTMENT"
        ));
    }

    public function delete(){

        $dept = new Department($this->connection);
        $dept->deleteById($_GET["id"]);

        $this->run('index');
    }


    public function create(){
        if(isset($_POST["project_name"])){

            $dept=new Department($this->connection);
            $dept->setId($_POST["id"]);
            $dept->setHeadId($_POST["head_id"]);
            $dept->setLanguage($_POST["language"]);
            $dept->setProjectName($_POST["project_name"]);
            $save = $dept->insert();
        }
        $this->run('index.php');
    }


    public function update(){
        if(isset($_POST["id"])){

            $dept=new Department($this->connection);
            $dept->setId($_POST["id"]);
            $dept->setHeadId($_POST["head_id"]);
            $dept->setLanguage($_POST["language"]);
            $dept->setProjectName($_POST["project_name"]);
            $save = $dept->update();
        }
        header("Location:index.php?controller=department&action=details&id=".$_POST["id"]);
    }


    public function view($view,$data){
        $receivedData = $data;
        require_once  __DIR__ . "/../view/" . $view . "View.php";

    }

}




?>