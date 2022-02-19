<?php
require_once 'src/config/global.php';

if(isset($_GET["controller"])){

    $controllerObj=loadController($_GET["controller"]);

}else{

    var_dump(loadController(CONTROLLER_DEFAULT));
    $controllerObj=loadController(CONTROLLER_DEFAULT);
}

throwAction($controllerObj);

function loadController($controller){

    $controller=ucwords($controller).'Controller';

    $uriController='controller/' . $controller . '.php';

    if(!is_file($uriController)) {
        $uriController='src/controller/'.ucwords(CONTROLLER_DEFAULT).'Controller.php';
    }

    var_dump($uriController);
    require_once $uriController;
    return new $controller();
}

function throwAction($controllerObj) {
    if(isset($_GET["action"])){
        $controllerObj->run($_GET["action"]);
    }else{
        $controllerObj->run(ACTION_DEFAULT);
    }
}