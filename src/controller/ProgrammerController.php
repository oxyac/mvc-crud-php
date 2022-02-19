<?php

class ProgrammerController
{

    private $database;
    private $connection;

    public function __construct()
    {
        require_once __DIR__ . "/Database.php";
        require_once __DIR__ . "/../model/Programmer.php";

        $this->database = new Database();
        $this->connection = $this->database->connectDb();

    }


    public function run($action)
    {
        switch ($action) {

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

    public function index()
    {
        $proger = new Programmer($this->connection);
        $result = Programmer::parseLevel($proger->getAll());
        //var_dump($result);


        $this->view("index", array(
            "programmers" => $result,
            "title" => "ALL ARTISTS"
        ));
    }


    public function details()
    {

        $proger = new Programmer($this->connection);
        $progerObj = $proger->getById($_GET["id"]);
        var_dump($progerObj);


        $this->view("prgDetails", array(
            "proger" => $progerObj,
            "department" => $_GET["department"],
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

        $proger = new Programmer($this->connection);
        $proger->deleteById($_GET["id"]);

        header("Location:index.php?controller=department&action=details&id=" . $_GET["department_id"]);
    }

    /**
     * Crea una new bodega a partir de los parámetros POST
     * y vuelve a cargar el index.php.
     *
     */
    public function create()
    {
        if (isset($_POST["first_name"]) && isset($_POST["last_name"])) {

            $proger = new Programmer($this->connection);
            $proger->setId($_POST["id"]);
            $proger->setFirstName($_POST["first_name"]);
            $proger->setDepartmentId($_POST["department_id"]);
            $proger->setLastName($_POST["last_name"]);
            $proger->setLevel($_POST["level"]);
            $proger->setPhone($_POST["phone"]);
            $proger->setEmail($_POST["email"]);
            $save = $proger->create();
        }
        header("Location:index.php?controller=department&action=details&id=" . $_POST["department_id"]);
    }


    public function update()
    {
        if (isset($_POST["id"])) {


            $proger = new Programmer($this->connection);
            $proger->setId($_POST["id"]);
            $proger->setFirstName($_POST["first_name"]);
            $proger->setDepartmentId($_POST["department_id"]);
            $proger->setLastName($_POST["last_name"]);
            $proger->setLevel($_POST["level"]);
            $proger->setPhone($_POST["phone"]);
            $proger->setEmail($_POST["email"]);
            $save = $proger->update();
        }
        header("Location:index.php?controller=department&action=details&id=" . $_POST["department_id"]);
    }


    /**
     * Crea la vista que le pasemos con los datos indicados.
     *
     */
    public function view($view, $data)
    {
        $receivedData = $data;
        //var_dump($data . __DIR__ . "/view/" . $view . "View.php" );
        require_once __DIR__ . "/../view/" . $view . "View.php";

    }

}


?>