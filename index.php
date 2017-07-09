<?php

session_start();

require "vendor/autoload.php";

require "app/controllers/PagesController.php";
require "app/controllers/SessionsController.php";
require "app/models/User.php";

require "core/Flash.php";
require "core/RenderHelper.php";

var_dump($_SESSION);

// set default users
$users = [
    new User("user_one", "1234", ["PAGE_1"]),
    new User("user_two", "5678", ["PAGE_2"]),
    new User("user_three", "9876", ["PAGE_3"])
];

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r){
    $r->addRoute('GET', '/page/{id:[1-3]}', 'PagesController/show');
    $r->addRoute('GET', '/sign_in', 'SessionsController/new_session');
    $r->addRoute('POST', '/sign_in', 'SessionsController/create_session');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        list($class, $method) = explode("/", $handler, 2);
        call_user_func_array(array(new $class, $method), $vars);
        break;
}
