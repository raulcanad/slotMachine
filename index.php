<?php
include_once 'Controller\Api\UserController.php';
include_once 'Controller\Api\GameController.php';
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
$module = '';
$method = '';
$userController = new UserController();
$userControllerName = 'user';
$gameController= new GameController();
$gameControllerName= 'game'; 


if (!isset($uri[3]) || !isset($uri[4])) {
    header("HTTP/1.1 404 Not Found");
    exit();
} else {
    $module = $uri[3];
    $method = $uri[4];
}


if($module == $userControllerName){

   $userController->{$method}();

}
else if ($module==$gameControllerName){
    $gameController->{$method}();
}

?>