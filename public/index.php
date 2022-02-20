<?php

use App\Controller\DepartmentController;
use App\Controller\ProgrammerController;

require_once '../vendor/autoload.php';
include '../app/config/globals.php';


function throwAction($controllerObj) {
    if(isset($_GET["action"])){
        $controllerObj->run($_GET["action"]);
    }else{
        $controllerObj->run(ACTION_DEFAULT);
    }
}

function getFullClassName($classStr){
    return 'App\Controller\\' . $classStr . 'Controller';
}
//switch($_GET["controller"]){
//    case null || 'department':
//        $controller = new DepartmentController();
//        break;
//    case 'programmer':
//        $controller = new ProgrammerController();
//
//}
if(isset($_GET["controller"])){

    $controller =  getFullClassName(ucwords( $_GET["controller"]));
    if (!class_exists($controller)) {

        $controller =  getFullClassName(ucwords( CONTROLLER_DEFAULT));

        $controllerObj = new $controller();
    }

//    var_dump($controller);
    $controllerObj = new  $controller();


}else{
    $controller =   getFullClassName(ucwords( CONTROLLER_DEFAULT));
    $controllerObj = new DepartmentController();
//    App\Model\DepartmentController
}

throwAction($controllerObj);

