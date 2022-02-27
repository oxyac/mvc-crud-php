<?php

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: *');

header("Access-Control-Allow-Headers: *");

use App\Controller\DepartmentController;
use Conf\Globals;

require_once '../vendor/autoload.php';
//
//
//$allowedOrigins = [
//    'http://localhost:4200'
//];
//
//if(in_array($_SERVER['HTTP_ORIGIN'], $allowedOrigins))
//{
//    $http_origin = $_SERVER['HTTP_ORIGIN'];
//} else {
//    $http_origin = "https://example.com";
//}
//header("Access-Control-Allow-Origin: $http_origin");




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

