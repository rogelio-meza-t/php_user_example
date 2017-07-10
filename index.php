<?php

session_start();

require "vendor/autoload.php";

require "app/controllers/PagesController.php";
require "app/controllers/SessionsController.php";
require "app/controllers/UsersController.php";
require "app/models/User.php";

require "core/Flash.php";
require "core/SessionHelper.php";
require "core/RenderHelper.php";
require "core/Database.php";


// set default users
$db_users = file('db/users.txt', FILE_IGNORE_NEW_LINES);
$users = [];
foreach($db_users as $user){
    $udata = explode(',', $user);
    $users[] = new User(
        $udata[0],
        $udata[1],
        $udata[2],
        explode('|', trim($udata[3]))
    );
}

// check user last activity
if( isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300) ){
    unset($_SESSION['username']);
    unset($_SESSION['user_id']);
}
$_SESSION['LAST_ACTIVITY'] = time();


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r){
    $r->addRoute('GET', '/page/{id:[1-3]}', 'PagesController/show');
    $r->addRoute('GET', '/sign_in', 'SessionsController/new_session');
    $r->addRoute('POST', '/sign_in', 'SessionsController/create_session');
    $r->addRoute('GET', '/sign_out', 'SessionsController/destroy_session');

    // api routes
    $r->addRoute('GET', '/api/users/{id:\d+}/show', 'UsersController/show');
    $r->addRoute('POST', '/api/users/{id:\d+}/update', 'UsersController/update');
    $r->addRoute('POST', '/api/users/create', 'UsersController/create');
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
        header('HTTP/1.0 404 Not Found');
        render('errors', '404');
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
