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
        $team = Programmer::toArray($team);

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

        if(isset($_GET["id"])){
            $dept = new Department();

            $prog_id = $_GET["id"];
            $dep_id = $_GET['depId'];


            $dept->setId($dep_id);
            $dept->setHeadId($prog_id);

            $dept->updateHeadId();

            echo http_response_code(200);
        }



    }

    public function delete()
    {


        $dept = new Department();
        echo $_GET["id"];
        $dept->deleteById($_GET["id"]);


    }


    public function create()
    {
        header('Content-Type: application/json; charset=utf-8');

        $json = file_get_contents('php://input');
        $data = json_decode($json);

        if ($data->project_name && $data->language) {

            $dept = new Department();
            $dept->setProjectName($data->project_name);
            $dept->setLanguage($data->language);

            $dept->create();

            echo  http_response_code(200);
        }
        else{
            echo 'Failed';
        }
    }


    public function update()
    {

        $json = file_get_contents('php://input');
        $data = json_decode($json);

        if (isset($_GET["id"])) {

            $dept = new Department();
            $dept->setId($data->id);
            $dept->setLanguage($data->language);
            $dept->setProjectName($data->project_name);
            $save = $dept->update();

        }
    }


    public function view($view, $data)
    {
        $receivedData = $data;

        $path =  __DIR__ . "/../../view/" . $view . "View.php";

        require_once $path;
    }
}
