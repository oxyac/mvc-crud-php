<?php
require_once 'src/config/global.php';

//Назначаем расположение скрипта
function loadController($controller){

    $controller=ucwords($controller).'Controller';

    $uriController='controller/' . $controller . '.php';

    if(!is_file($uriController)) {
        $uriController='src/controller/'.ucwords(CONTROLLER_DEFAULT).'Controller.php';
    }
    var_dump("CONTROLLER: " . $uriController);

    //добавляем скрипт запрошенного контроллера
    require_once $uriController;
    return new $controller();
}

//выстреливаем новый Экшн
function throwAction($controllerObj) {
    if(isset($_GET["action"])){
        $controllerObj->run($_GET["action"]);
    }else{
        $controllerObj->run(ACTION_DEFAULT);
    }
}


if(isset($_GET["controller"])){
    var_dump($_GET["controller"]);
    $controllerObj=loadController($_GET["controller"]);

}else{
    echo $_GET["controller"];
    $controllerObj=loadController(CONTROLLER_DEFAULT);
}

//говорим контроллеру чекнуть заголовок "action"
throwAction($controllerObj);

