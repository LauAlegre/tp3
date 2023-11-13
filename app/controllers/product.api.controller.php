<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/models/product.model.php';

class ProductApiController extends ApiController
{
    private $model;


    function __construct()
    {
        parent::__construct();
        $this->model = new ProductModel();
    }

    function getProducts($params = [])
{
    if (empty($params)) {
        // Verificar y configurar los parámetros de clasificación
        $sort = 'product_id';
        $order = 'ASC';

        if (isset($_GET['order'])) {
            $order = $_GET['order'];
            if ($order !== 'ASC' && $order !== 'DESC') {
                $order = 'ASC';
            }
        }

        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
            $columns = array('product_id', 'nombre_producto', 'tipo_de_product', 'id_marca', 'precio', 'descripcion_product');

            if (!in_array($sort, $columns)) {
                $sort = 'product_id';
            }
        }

        // Verificar y manejar la paginación
        if (isset($_GET['size']) && isset($_GET['page'])) {
            $size = $_GET['size'];
            $page = $_GET['page'];

            $products = $this->model->getProductPaginated($page, $size, $order, $sort);
            $this->view->response($products, 200);
            return;
        }

        // Si no se proporcionan parámetros de paginación, obtener productos sin paginación
        $productos = $this->model->getProducts($order, $sort);
        $this->view->response($productos, 200);

    } else {
        // Aquí puedes manejar la lógica para otros casos, como filtrar por ID
    }
}
    function deleteProduct($params = [])
    {
        if (!empty($params)) {
            $id = $params[':ID'];
            $product = $this->model->getProduct($id);

            if ($product) {
                $this->model->deleteProduct($id);
                $this->view->response('El producto con id=' . $id . ' ha sido borrada.', 200);
            } else {
                $this->view->response('El producto con id=' . $id . ' no existe.', 404);
            }
        }else{
            $this->view->response('Ingrese ID', 404);
        }
    }
    function updateProduct($params = [])
    {
        if (!empty($params)){
        $id = $params[':ID'];
        $tarea = $this->model->getProduct($id);

        if (isset($tarea)) {
            $body = $this->getData();
            $nombre_producto = $body->nombre_producto;
            $tipo_de_product = $body->tipo_de_product;
            $precio = $body->precio;
            $descripcion_product = $body->descripcion_product;
            $id_marca = $body->id_marca;

            $this->model->updateProduct($nombre_producto, $tipo_de_product, $precio, $descripcion_product, $id_marca, $id);

            $this->view->response('El producto con el id=' . $id . ' ha sido modificada.', 200);
        } else {
            $this->view->response('El producto con el id=' . $id . ' no existe.', 404);
        }
         }else{
            $this->view->response('Ingrese ID', 404);
         }
    }

    // function productPaginated(){
    //     if (isset($_GET['size']) && (isset($_GET['page']))) {
    //         $size = $_GET['size'];
    //         $page = $_GET['page'];

    //         var_dump($size);
    //         var_dump($page);
    //         die();

    //         $products = $this->model->getProductPaginated($page, $size);
    //         $this->view->response($products, 200);
    //         return;
    //     }
    // }
}
