<?php
namespace App\Controller;

use App\Model\Programmer;
use App\Model\Department;




class ProgrammerController
{

    public function run($action)
    {
        switch ($action) {

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
            case "assign":
                $this->assign();
                break;
            case "unassign":
                $this->unassign();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index()
    {
        $proger = new Programmer();
        $result = Programmer::parseLevel($proger->getAll());


        $this->view("index", array(
            "programmers" => $result,
            "title" => "ALL ARTISTS"
        ));
    }

    public function assign()
    {
        if(isset($_POST['id_depId'])){

            $proger = new Programmer();

            $prog_dep = explode('&', $_POST['id_depId']);

            $prog_id = $prog_dep[0];
            $dep_id = $prog_dep[1];

            $proger->setId($prog_id);
            $proger->setDepartmentId($dep_id);

            $proger->assignDepartment();

            header("Location:index.php?controller=department&action=details&id=" . $dep_id);
        }
        else{
            header("Location:index.php");
        }
    }

    public function unassign()
    {
        $proger = new Programmer();

        $proger->setId($_GET['id']);
        $proger->setDepartmentId($_GET['depId']);

        $proger->unassignDepartment();

        header("Location:index.php?controller=department&action=details&id=" . $_GET['depId']);
    }


    public function details()
    {

        $proger = new Programmer();
        $dept = new Department();

        $progerObj = $proger->getById($_GET["id"]);
        $depts = $dept->getAll();


        $this->view("prgDetails", array(
            "depts" => $depts,
            "proger" => $progerObj,
            "depId" => $_GET["department"],
            "title" => "Programer Details"
        ));
    }

    public function showNew()
    {
        $this->view("newProg", array(
            "depId" => $_GET["department"],
            "title" => "NEW PROGER"
        ));
    }

    public function delete()
    {

        $proger = new Programmer();
        $proger->deleteById($_GET["id"]);

        header("Location:index.php");
    }


    public function create()
    {
        var_dump($_POST);

        if (isset($_POST["first_name"]) && isset($_POST["last_name"])) {

            $proger = $this->postProgData();

            $save = $proger->create();

            echo('SUCCESS');
        }
        else{
            echo('FAILED');
        }

    }


    public function update()
    {

        if (isset($_POST["id"])) {


            $proger = $this->postProgData();

            $save = $proger->update();
        }
        header("Location:index.php");
    }

    public function view($view, $data)
    {
        $receivedData = $data;
        $path =  __DIR__ . "/../../view/" . $view . "View.php";
        require_once $path;

    }

    /**
     * @return Programmer
     */
    public function postProgData(): Programmer
    {
        $proger = new Programmer();
        $proger->setId($_POST["id"]);
        $proger->setFirstName($_POST["first_name"]);
        $proger->setDepartmentId($_POST["department_id"]);
        $proger->setLastName($_POST["last_name"]);
        $proger->setLevel($_POST["level"]);
        $proger->setPhone($_POST["phone"]);
        $proger->setEmail($_POST["email"]);
        return $proger;
    }

}


?>