<?php
    require_once 'app/models/model.php';

class ProductModel  extends Model {  
    /**
     * Obtiene y devuelve de la base de datos todas las tareas.
     */

    

     function getProduct($id) {
        $query = $this->db->prepare('SELECT * FROM productos WHERE ?');
        $query->execute([$id]);

        
        $product = $query->fetchAll(PDO::FETCH_OBJ);

        return $product;
    }

    function deleteProduct($id) {
        $query = $this->db->prepare('DELETE FROM productos WHERE product_id = ?');
        $query->execute([$id]);
    }

    function updateProduct($nameProduct,$typeProduct,$cost,$productDescription,$id_marca,$id){
        $query = $this->db->prepare('UPDATE productos SET  nombre_producto=?, tipo_de_product=?, precio=?,descripcion_product=?, id_marca = ? WHERE product_id = ?');
        $query->execute([$nameProduct,$typeProduct,$cost,$productDescription,$id_marca,$id]);
    }

    function getProducts($order, $sort)
    {
        $query = $this->db->prepare("SELECT * FROM productos ORDER BY $sort $order");
        $query->execute();

        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }

    function getProductPaginated($page, $size)
    {
        $query = $this->db->prepare("SELECT * FROM productos ORDER BY product_id ASC LIMIT $page, $size;");
        $query->execute();

        $product = $query->fetchAll(PDO::FETCH_OBJ);

        return $product;
    }
}