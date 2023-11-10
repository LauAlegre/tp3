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
            $productos = $this->model->getProducts($order, $sort);
            $this->view->response($productos, 200);
        } else {
            //PARTE DE FILTRO POR ID (JOACO)
        }
        
    }
    function deleteProduct($params = [])
    {
        $id = $params[':ID'];
        $product = $this->model->getProduct($id);

        if ($product) {
            $this->model->deleteTask($id);
            $this->view->response('La tarea con id=' . $id . ' ha sido borrada.', 200);
        } else {
            $this->view->response('La tarea con id=' . $id . ' no existe.', 404);
        }
    }
    function updateProduct($params = [])
    {
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

            $this->view->response('La tarea con id=' . $id . ' ha sido modificada.', 200);
        } else {
            $this->view->response('La tarea con id=' . $id . ' no existe.', 404);
        }
    }
}
