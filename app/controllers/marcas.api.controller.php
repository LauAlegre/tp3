<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/models/marcas.model.php';

class MarcasApiController extends ApiController
{
    private $model;


    function __construct()
    {
        parent::__construct();
        $this->model = new MarcasModel();
    }

    function getMarcas($params = [])
{
    if (empty($params)) {
        // Verificar y configurar los parámetros de clasificación
        $sort = 'id_marca';
        $order = 'ASC';

        if (isset($_GET['order'])) {
            $order = $_GET['order'];
            if ($order !== 'ASC' && $order !== 'DESC') {
                $order = 'ASC';
            }
        }

        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
            $columns = array('id_marca', 'marca', 'descripcion', 'sede');

            if (!in_array($sort, $columns)) {
                $sort = 'id_marca';
            }
        }

        // Verificar y manejar la paginación
        if (isset($_GET['size']) && isset($_GET['page'])) {
            $size = $_GET['size'];
            $page = $_GET['page'];

            $marcas = $this->model->getMarcaPaginated($page, $size, $order, $sort);
            $this->view->response($marcas, 200);
            return;
        }

        // Si no se proporcionan parámetros de paginación, obtener marcas sin paginación
        $marcas = $this->model->getMarcas($order, $sort);
        $this->view->response($marcas, 200);

    } else {
        $id = $params[':ID'];
        $marca = $this->model->getMarca($id);
            if(!empty($marca)) {
                return $this->view->response($marca,200);
            } else {
                $this->view->response(
                    ['El producto con el id=' . $id . 'no existe.']
                , 404);
                }
        }
}
    function deleteMarca($params = [])
    {
        if (!empty($params)) {
            $id = $params[':ID'];
            $marca = $this->model->getMarca($id);

            if (isset($marca)) {
                $this->model->deleteMarca($id);
                $this->view->response('La marca con id=' . $id . ' ha sido borrada.', 200);
            } else {
                $this->view->response('La marca con id=' . $id . ' no existe.', 404);
            }
        } else {
            $this->view->response('Ingrese ID', 404);
        }
    }
    function updateMarca($params = [])
    {
        if (!empty($params)) {
            $id = $params[':ID'];
            $marca_db = $this->model->getMarca($id);

            if (isset($marca_db)) {
                $body = $this->getData();
                $marca = $body->marca;
                $descripcion = $body->descripcion;
                $sede = $body->sede;


                $this->model->updateMarca($marca, $descripcion, $sede, $id);

                $this->view->response('La marca con id=' . $id . ' ha sido modificada.', 200);
            } else {
                $this->view->response('La marca con id=' . $id . ' no existe.', 404);
            }
        } else {
            $this->view->response('Ingrese ID', 404);   
        }
    }

    function createMarca($params = [])
    {
        $body = $this->getData();

        $marca = $body->marca;
        $descripcion = $body->descripcion;
        $sede = $body->sede;

        if (empty($marca) || empty($descripcion) || empty($sede)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insertMarca($marca, $descripcion, $sede);
            $producto = $this->model->getMarca($id);
            $this->view->response($producto, 201);
        }
    }
}
