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
                $columns = array('id_marca', 'marca', 'descripcion','sede');

                if (!in_array($sort, $columns)) {
                    $sort = 'id_marcas';
                }
            }
            $productos = $this->model->getMarcas($order, $sort);
            $this->view->response($productos, 200);
        } else {
            //PARTE DE FILTRO POR ID (JOACO)
        }
        
    }
    function deleteMarca($params = [])
    {
        $id = $params[':ID'];
        $marca = $this->model->getMarca($id);

        if (isset($marca)) {
            $this->model->deleteTask($id);
            $this->view->response('La marca con id=' . $id . ' ha sido borrada.', 200);
        } else {
            $this->view->response('La marca con id=' . $id . ' no existe.', 404);
        }
    }
    function updateMarca($params = [])
    {
        $id = $params[':ID'];
        $marca_db = $this->model->getMarca($id);

        if (isset($marca_db)) {
            $body = $this->getData();
            $marca = $body->marca;
            $descripcion = $body->descripcion;
            $sede = $body->sede;
            

            $this->model->updateMarca($marca, $descripcion, $sede,$id);

            $this->view->response('La marca con id=' . $id . ' ha sido modificada.', 200);
        } else {
            $this->view->response('La marca con id=' . $id . ' no existe.', 404);
        }
    }
}
