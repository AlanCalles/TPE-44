<?php

class ProductModel{

    private $db;

    public function __construct(){
        $this->db = new PDO(
            "mysql:host=".MYSQL_HOST .
            ";dbname=".MYSQL_DB.";charset=utf8", 
            MYSQL_USER, MYSQL_PASS);
            
    }


    public function getProducts(){

        // ejecuto la consulta
        $query = $this->db->prepare('SELECT * FROM comprador');
        $query->execute();

        // obtengo los datos en un arreglo de objetos
        $products = $query->fetchAll(PDO::FETCH_OBJ); 

        return $products;
    }

    public function getProduct($id){

        $query = $this->db->prepare('SELECT * FROM comprador WHERE id = ?');
        $query->execute([$id]);

        $product = $query->fetchAll(PDO::FETCH_OBJ); 

        return $product;
    }

   
     public function insertProduct($nombre,$apellido,$nombre_producto,$tipoDeCompra){
        $query = $this->db->prepare('INSERT INTO comprador(nombre,apellido,nombre_producto,tipoDeCompra) VALUES (?, ?, ?, ?)');
        $query->execute([$nombre,$apellido,$nombre_producto,$tipoDeCompra]);

        $id_producto = $this->db->lastInsertId();

        return $id_producto;
    }
    
    public function eraseProduct($id){
        $query = $this->db->prepare('DELETE FROM comprador WHERE id = ?');
        $query->execute([$id]);
    }

}