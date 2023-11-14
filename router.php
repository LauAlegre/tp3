<?php
require_once 'config.php';
require_once 'libs/router.php';
require_once 'app/controllers/product.api.controller.php';
require_once 'app/controllers/marcas.api.controller.php';



$router = new Router();

#                 endpoint      verbo     controller           método

//tabla productos
$router->addRoute('productos',     'GET',    'ProductApiController', 'getProducts');
$router->addRoute('productos/:ID', 'GET',    'ProductApiController', 'getProducts');
$router->addRoute('productos/:ID', 'DELETE', 'ProductApiController', 'deleteProduct');
$router->addRoute('productos',     'DELETE', 'ProductApiController', 'deleteProduct');
$router->addRoute('productos/:ID', 'PUT',    'ProductApiController', 'updateProduct');
$router->addRoute('productos',     'PUT',    'ProductApiController', 'updateProduct');
$router->addRoute('productos'    , 'POST',   'ProductApiController', 'createProduct');




//tabla marcas
$router->addRoute('marcas',     'GET',    'MarcasApiController', 'getMarcas');
$router->addRoute('marcas/:ID', 'GET',    'MarcasApiController', 'getMarcas');
$router->addRoute('marcas/:ID', 'DELETE', 'MarcasApiController', 'deleteMarca');
$router->addRoute('marcas',     'DELETE', 'MarcasApiController', 'deleteMarca');
$router->addRoute('marcas/:ID', 'PUT',    'MarcasApiController', 'updateMarca');
$router->addRoute('marcas'    , 'PUT',    'MarcasApiController', 'updateMarca');
$router->addRoute('marcas'    , 'POST',   'MarcasApiController', 'createMarca');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
