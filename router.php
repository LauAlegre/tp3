<?php
require_once 'config.php';
require_once 'libs/router.php';
require_once 'app/controllers/product.api.controller.php';



$router = new Router();

#                 endpoint      verbo     controller           método


$router->addRoute('productos',     'GET',    'ProductApiController', 'get');
$router->addRoute('productos/:ID', 'DELETE', 'ProductApiController', 'delete');
$router->addRoute('productos/:ID', 'PUT',    'ProductApiController', 'update');
// $router->addRoute('tareas',     'POST',   'TaskApiController', 'create');
// $router->addRoute('tareas/:ID', 'GET',    'TaskApiController', 'get');

// $router->addRoute('user/token', 'GET',    'UserApiController', 'getToken'); # UserApiController->getToken()

#               del htaccess resource=(), verbo con el que llamo GET/POST/PUT/etc
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
