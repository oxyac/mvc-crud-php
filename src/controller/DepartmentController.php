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
            case "new" :
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
        $result = $dept->getAll();
        $this->view("index", array(
            "departments" => $result,
            "title" => "ALL ARTISTS"
        ));
    }


    public function details(){


        $dept = new Department($this->connection);
        $result = $dept ->getById($_GET["id"]);

        $proger = new Programmer($this->connection);
        $progers = $proger->getAllByDept($_GET['id']);

        var_dump($progers);

        $this->view("depDetails",array(
            "departmentId" => $result,
            "progers" => $progers,
            "title" => "Department Details"
        ));
    }

    public function showNew(){
        $this->view("newDep",array(
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