<?php

use App\Controller\DepartmentController;
use Conf\Globals;

require_once '../vendor/autoload.php';



function getNamespace($classStr){
    return 'App\Controller\\' . $classStr . 'Controller';
}


if(isset($_GET["controller"])){

    $controller =  getNamespace(ucwords( $_GET["controller"]));

    if (!class_exists($controller)) {

        $controller =  getNamespace(ucwords( Globals::CONTROLLER_DEFAULT));

        $controllerObj = new $controller();
    }

    $controllerObj = new  $controller();


}else{

    $controller =   getNamespace(ucwords( Globals::CONTROLLER_DEFAULT));
    $controllerObj = new DepartmentController();
}

isset($_GET["action"]) ?
    $controllerObj->run($_GET["action"]) :
    $controllerObj->run(Globals::ACTION_DEFAULT);

