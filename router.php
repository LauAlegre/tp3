<?php
require_once 'config.php';
require_once 'libs/router.php';
require_once 'app/controllers/product.api.controller.php';
require_once 'app/controllers/marcas.api.controller.php';



$router = new Router();

#                 endpoint      verbo     controller           método

//tabla productos
$router->addRoute('productos',     'GET',    'ProductApiController', 'getProducts');
$router->addRoute('productos/:ID', 'DELETE', 'ProductApiController', 'deleteProduct');
$router->addRoute('productos/:ID', 'PUT',    'ProductApiController', 'updateProduct');



//tabla marcas
$router->addRoute('marcas',     'GET',    'MarcasApiController', 'getMarcas');
$router->addRoute('marcas/:ID', 'DELETE', 'MarcasApiController', 'deleteMarca');
$router->addRoute('marcas/:ID', 'PUT',    'MarcasApiController', 'updateMarca');
// $router->addRoute('tareas',     'POST',   'TaskApiController', 'create');
// $router->addRoute('tareas/:ID', 'GET',    'TaskApiController', 'get');

// $router->addRoute('user/token', 'GET',    'UserApiController', 'getToken'); # UserApiController->getToken()

#               del htaccess resource=(), verbo con el que llamo GET/POST/PUT/etc
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
