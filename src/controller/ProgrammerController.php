<?php
class ProgrammerController{

    private $database;
    private $connection;

    public function __construct() {
        require_once __DIR__ . "/Database.php";
        require_once __DIR__ . "/../model/Programmer.php";

        $this->database=new Database();
        $this->connection=$this->database->connectDb();

    }


    public function run($action){
        switch($action)
        {
            case "newProgrammer" :
                $this->newProgrammer();
                break;
            case "alta" :
                $this->crear();
                break;
            case "detalle" :
                $this->detalle();
                break;
            case "actualizar" :
                $this->actualizar();
                break;
            case "borrar" :
                $this->borrar();
                break;
            default:
                $this->index();
                break;
        }
    }

    public function index(){
        $proger = new Programmer($this->connection);
        $result = $proger->getAll();

        $this->view("index", array(
            "programmers" => $_GET[$result],
            "title" => "ALL ARTISTS"
        ));
    }

    /**
     * Carga la página principal de bodegas con la lista de
     * bodegas que consigue del modelo.
     *
     */
    public function detalle(){


        $proger = new Programmer($this->connection);
        $result = $proger ->getById($_GET["id"]);

        $this->view("detalleVino",array(
            "vino" => $result,
            "bodega" => $_GET["bodega"],
            "titulo" => "Detalle Vino"
        ));
    }

    public function newProgrammer(){
        $this->view("newProgrammer",array(
            "programmer" => $_GET["programmer"],
            "titulo" => "NEW PROGER"
        ));
    }

    public function borrar(){

        //Creamos el objeto bodega
        $vino = new Vino($this->conexion);
        //Recuperamos de BBDD la bodega
        $vino = $vino->deleteById($_GET["id"]);

        header("Location: index.php?controller=bodega&action=detalle&id=" . $_GET["bodega"]);
    }

    /**
     * Crea una new bodega a partir de los parámetros POST
     * y vuelve a cargar el index.php.
     *
     */
    public function crear(){
        if(isset($_POST["nombre"])){

            //Creamos una bodega
            $vino=new Vino($this->connection);
            $vino->setNombre($_POST["nombre"]);
            $vino->setDescripcion($_POST["descripcion"]);
            $vino->setBodega($_POST["bodega"]);
            $vino->setTipo($_POST["tipo"]);
            $vino->setAno($_POST["ano"]);
            $vino->setAlcohol($_POST["alcohol"]);

            $save = $vino->save();
        }
        header("Location:index.php?controller=bodega&action=detalle&id=".$_POST["bodega"]);
    }

    /**
     * Actualiza bodega a partir de los parámetros POST
     * y vuelve a cargar el index.php.
     *
     */
    public function actualizar(){
        if(isset($_POST["id"])){

            //Creamos un vino
            $vino=new Vino($this->conexion);
            $vino->setId($_POST["id"]);
            $vino->setNombre($_POST["nombre"]);
            $vino->setDescripcion($_POST["descripcion"]);
            $vino->setBodega($_POST["bodega"]);
            $vino->setTipo($_POST["tipo"]);
            $vino->setAno($_POST["ano"]);
            $vino->setAlcohol($_POST["alcohol"]);
            $save=$vino->actualizar();
        }
        header("Location:index.php?controller=bodega&action=detalle&id=".$_POST["bodega"]);
    }


    /**
     * Crea la vista que le pasemos con los datos indicados.
     *
     */
    public function view($view,$data){
        $receivedData = $data;
        require_once  __DIR__ . "/../view/" . $view . "View.php";

    }

}




?>