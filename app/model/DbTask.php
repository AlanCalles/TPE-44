<?php

  class taskModel{    
        private $db;

        public function __construct() {
            $this->db = new PDO('mysql:host=localhost;dbname=distrubuidora;charset=utf8', 'root', '');
         }
        
  public function getItem($id){
            $sql = 'SELECT * FROM comprador WHERE id = ?';
           
            $query = $this->db->prepare($sql);
            $query->execute([$id]);
            $ventas = $query->fetchAll(PDO::FETCH_ASSOC);
            return $ventas;
    }
        
   
        public function getAll($orderBy = false, $orderDirection = 'ASC', $tipoDeCompra = null) {
            
            $sql = 'SELECT * FROM comprador';
            $params = []; 
        
            
            if ($tipoDeCompra != null) {
                $sql .= ' WHERE tipo_de_compra = ?';
                $params[] = $tipoDeCompra; 
            }
           
           
           
            if (strtoupper($orderDirection) === 'DESC') 
            {
                $orderDirection = 'DESC';
            } else {
                $orderDirection = 'ASC'; 
            }        
        
          
          
            if ($orderBy) {
                    $sql .= " ORDER BY $orderBy " . $orderDirection; 
                }
            
        
        
            $query = $this->db->prepare($sql);
            $query->execute($params); 
            return $query->fetchAll(PDO::FETCH_OBJ); 
        }
        
        

    function insertTask($nombre,$apellido,$nombre_producto,$tipoDeCompra){
        $db = getconect();
        
        $query = $db->prepare('INSERT INTO comprador (nombre,apellido,nombre_producto,tipo_de_compra) VALUES (?,?,?,?) ');
        $query -> execute([$nombre,$apellido,$nombre_producto,$tipoDeCompra]); 

        $id = $db->lastInsertId();
      

        
        return $id;
        }
        

        function editTask($nombre,$apellido,$nombre_producto,$tipoDeCompra, $id){
            $db = getconect();
            
            $query =$db->prepare('UPDATE comprador SET nombre = ?,apellido=?,nombre_producto=?,tipo_de_compra =? WHERE id = ?');            
            $query -> execute([$nombre,$apellido,$nombre_producto,$tipoDeCompra,$id]); 
            }

        function deleteTask($id) {
            $db = getconect();
            $query =$db->prepare('DELETE FROM comprador WHERE id = ?');
            $query->execute([$id]);
           
        }
    }


