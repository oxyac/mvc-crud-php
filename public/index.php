<?php

use App\Controller\DepartmentController;
use Conf\Globals;

require_once '../vendor/autoload.php';


function throwAction($controllerObj) {
    if(isset($_GET["action"])){
        $controllerObj->run($_GET["action"]);
    }else{
        $controllerObj->run(Globals::ACTION_DEFAULT);
    }
}

function getFullClassName($classStr){
    return 'App\Controller\\' . $classStr . 'Controller';
}


if(isset($_GET["controller"])){

    $controller =  getFullClassName(ucwords( $_GET["controller"]));

    if (!class_exists($controller)) {

        $controller =  getFullClassName(ucwords( Globals::CONTROLLER_DEFAULT));

        $controllerObj = new $controller();
    }

    $controllerObj = new  $controller();


}else{
    $controller =   getFullClassName(ucwords( Globals::CONTROLLER_DEFAULT));
    $controllerObj = new DepartmentController();
}

throwAction($controllerObj);

