<?php


namespace App\Controller;

use App\Model\Programmer;
use App\Model\Department;

//require_once 'Database.php';

class DepartmentController
{

    private $database;
    private $connection;

    public function __construct()
    {


        $this->database = new Database();
        $this->connection = $this->database->connectDb();
    }


    public function run($action)
    {
        switch ($action) {

            case "showNew":
                $this->showNew();
                break;
            case "create":
                $this->create();
                break;
            case "details":
                $this->details();
                break;
            case "update":
                $this->update();
                break;
            case "delete":
                $this->delete();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index()
    {

        $dept = new Department($this->connection);
        $proger = new Programmer($this->connection);




        $progers = Programmer::parseLevel($proger->assignKeys($proger->getAll()));

        $allDepts = $dept->parseHeadName($dept->assignKeys($dept->getAll()), $progers);
        //$allDepts = $dept->parseHeadName($allDepts, $progers);


        // var_dump($allDepts);
        //$progerCountPerDept = $dept->countProgs($allDepts, $progers);

        $progers = $proger->parseDepartmentName($progers, $allDepts);





        $this->view("index", array(
            "progers" => $progers,
            "departments" => $allDepts,
            "title" => "ALL ARTISTS"
        ));
    }


    public function details()
    {


        $dept = new Department($this->connection);
        $deptDetails = $dept->getById($_GET["id"]);
        $dept->setHeadId($deptDetails->head_id);

        $proger = new Programmer($this->connection);
        $allProgs = $proger->getAll();

        $progersByDept = $proger->getByColumn($allProgs, $_GET['id']);
        $progersToBeAdded = $proger->progersNotInDept($progersByDept, $allProgs);
        $team = Programmer::parseLevel($proger->assignKeys($progersByDept));

        $headId = $dept->getHeadId();


        //        var_dump( "->" . $team . "<-");
        //        var_dump($deptDetails);

        $this->view("depDetails", array(
            "progers" => $progersToBeAdded,
            "department" => $deptDetails,
            "team" => $team,
            "head_id" => $headId,
            "title" => "Department Details"
        ));
    }

    public function showNew()
    {

        $proger = new Programmer($this->connection);
        $progers = $proger->getAll();


        $this->view("newDep", array(
            "progers" => $progers,
            "title" => "NEW DEPARTMENT"
        ));
    }

    public function delete()
    {

        $dept = new Department($this->connection);
        $dept->deleteById($_GET["id"]);

        $this->run('index');
    }


    public function create()
    {
        if (isset($_POST["project_name"])) {

            $dept = new Department($this->connection);
            $dept->setId($_POST["id"]);
            $dept->setHeadId($_POST["head_id"]);
            $dept->setLanguage($_POST["language"]);
            $dept->setProjectName($_POST["project_name"]);
            $save = $dept->insert();
        }
        $this->run('index.php');
    }


    public function update()
    {
        if (isset($_POST["id"])) {

            $dept = new Department($this->connection);
            $dept->setId($_POST["id"]);
            $dept->setHeadId($_POST["head_id"]);
            $dept->setLanguage($_POST["language"]);
            $dept->setProjectName($_POST["project_name"]);
            $save = $dept->update();
        }
        header("Location:index.php?Controller=department&action=details&id=" . $_POST["id"]);
    }


    public function view($view, $data)
    {
        $receivedData = $data;

        $path =  __DIR__ . "/../../view/" . $view . "View.php";

        require_once $path;
    }
}
