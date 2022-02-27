<?php


namespace App\Controller;

use App\Model\Programmer;
use App\Model\Department;


class DepartmentController
{

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
            case "setHead":
                $this->setHead();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index()
    {
        $dept = new Department();
        $proger = new Programmer();


        $progers = Programmer::parseLevel($proger->assignKeys($proger->getAll()));

        $allDepts = $dept->parseHeadName($dept->assignKeys($dept->getAll()), $progers);

        $progerCountPerDept = $dept->countProgs($allDepts, $progers);

        $progers = $proger->parseDepartmentName($progers, $allDepts);





        echo json_encode(array(
            "depId_count" => $progerCountPerDept,
            "progers" => $progers,
            "departments" => $allDepts,
            "title" => "ALL ARTISTS"
        ));
    }


    public function details()
    {


        $dept = new Department();
        $deptDetails = $dept->getById($_GET["id"]);
        $dept->setHeadId($deptDetails->head_id);

        $proger = new Programmer();
        $allProgs = $proger->getAll();

        $progersByDept = $proger->getByColumn($allProgs, $_GET['id']);
        $team = Programmer::parseLevel($proger->assignKeys($progersByDept));

        $unassignedProgs = $proger->fetchUnassignedProgers($allProgs);

        $headId = $dept->getHeadId();


        echo json_encode(array(
            "progers" => $unassignedProgs,
            "department" => $deptDetails,
            "team" => $team,
            "head_id" => $headId,
            "title" => "Department Details"
        ));
    }

    public function showNew()
    {

        $proger = new Programmer();
        $progers = $proger->getAll();


        $this->view("newDep", array(
            "progers" => $progers,
            "title" => "NEW DEPARTMENT"
        ));
    }

    public function setHead(){


        $dept = new Department();


        $prog_id = $_GET["id"];
        $dep_id = $_GET['depId'];
        var_dump($dep_id, " ",  $prog_id);


        $dept->setId($dep_id);
        $dept->setHeadId($prog_id);

        $dept->updateHeadId();

        header("Location:index.php?controller=department&action=details&id=" . $dep_id);
    }

    public function delete()
    {

        $dept = new Department();
        $dept->deleteById($_GET["id"]);

        header("Location: index.php");
    }


    public function create()
    {
        if (isset($_POST["project_name"])) {

            $dept = new Department();
            $dept->setId($_POST["id"]);
            $dept->setLanguage($_POST["language"]);
            $dept->setProjectName($_POST["project_name"]);
            $save = $dept->insert();
        }
        $this->run('index.php');
    }


    public function update()
    {
        if (isset($_POST["id"])) {

            $dept = new Department();
            $dept->setId($_POST["id"]);
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
