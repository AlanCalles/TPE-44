<?php

class CategoryModel{

    private $db;

    public function __construct(){
        $this->db = new PDO(
            "mysql:host=".MYSQL_HOST .
            ";dbname=".MYSQL_DB.";charset=utf8", 
            MYSQL_USER, MYSQL_PASS);
            
    }


    public function getCategories(){

        // ejecuto la consulta
        $query = $this->db->prepare('SELECT * FROM empresa');
        $query->execute();

        // obtengo los datos en un arreglo de objetos
        $categories = $query->fetchAll(PDO::FETCH_OBJ); 

        return $categories;
    }

    public function getCategory($id_venta){

        $query = $this->db->prepare('SELECT * FROM empresa WHERE id_venta= ?');
        $query->execute([$id_venta]);

        $category = $query->fetchAll(PDO::FETCH_OBJ); 

        return $category;
    }

   
     public function insertCategory($categoria){
        $query = $this->db->prepare('SELECT COUNT(*) FROM empresa WHERE categoria = ?');
        $query->execute([$categoria]);
        $count = $query->fetchColumn();
    
        // Si la categoría ya existe, devolvemos false
        if ($count > 0) {
            return false; // Puede devolver un mensaje de error o false para indicar que no se insertó
        }



        $query = $this->db->prepare('INSERT INTO empresa(categoria) VALUES (?)');
        $query->execute([$categoria]);

        $id = $this->db->lastInsertId();

        return $id;
    }
    
    public function eraseCategory($id_venta){
        $query = $this->db->prepare('DELETE FROM empresa WHERE id_venta = ?');
        $query->execute([$id_venta]);
    }

}