<?php
require_once 'app/models/model.php';

class MarcasModel  extends Model
{
    /**
     * Obtiene y devuelve de la base de datos todas las tareas.
     */



    function getMarca($id)
    {
        $query = $this->db->prepare('SELECT * FROM marcas WHERE ?');
        $query->execute([$id]);


        $product = $query->fetchAll(PDO::FETCH_OBJ);

        return $product;
    }

    function deleteTask($id)
    {
        $query = $this->db->prepare('DELETE FROM marcas WHERE id_marca = ?');
        $query->execute([$id]);
    }

    function updateMarca($marca, $descripcion, $sede,$id)
    {
        $query = $this->db->prepare('UPDATE marcas SET marca=?, descripcion=?, sede=? WHERE id_marca = ?');
        $query->execute([$marca, $descripcion, $sede, $id]);
    }

    function getMarcas($order, $sort)
    {
        $query = $this->db->prepare("SELECT * FROM marcas ORDER BY $sort $order");
        $query->execute();

        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }
}
