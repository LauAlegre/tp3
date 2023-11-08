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

    function get(){
        if (isset($_GET['sort']) && isset($_GET['order'])) {
            $sort = $_GET['sort'];
            $order = $_GET['order'];
            

            if ($order == 'desc') {
                 $productos = $this->model->sortByParamDesc($sort);
                 $this->view->response($productos,200);

            } elseif ($order == 'asc') {
                $productos = $this->model->sortByParamAsc($sort);
                $this->view->response($productos,200);

            } else {

                $this->view->response('la opciond de ordenar ' . $order . ' no existe.', 404);
            }
        } else {
            $productos = $this->model->getProducts();

            $this->view->response($productos,200);
        }
       
    }
    function delete($params = [])
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
    function update($params = [])
    {
        $id = $params[':ID'];
        $tarea = $this->model->getProduct($id);

        if ($tarea) {
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
