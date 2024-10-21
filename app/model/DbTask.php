<?php

 function getconect(){
    return new PDO('mysql:host=localhost;dbname=distrubuidora;charset=utf8', 'root', '');
}    

    class taskModel{    
        
        public function getAllOf($categoria){
            //abro conexion con la base de datos
        $db = getconect();
    
        //enviamos consulta a la base de datos y se obtiene el resultado
        //Select*from "nombre de la tabla"
    
        $query = $db->prepare('select * from comprador where tipoDeCompra = ?');
        $query->execute([$categoria]);
    
        //obtengo todos los datos que me da la query
        $ventas = $query->fetchAll(PDO::FETCH_OBJ);//que formato queremos recibir los datos//en este caso se recibe en formato objeto
    
        //no es necesario cerrar la conexion
    
        return $ventas;
        }
        public function getCategorias(){
      
                //abro conexion con la base de datos
            $db = getconect();
        
            //enviamos consulta a la base de datos y se obtiene el resultado
            //Select*from "nombre de la tabla"
        
            $query = $db->prepare('select * from empresa');
            $query->execute();
        
            //obtengo todos los datos que me da la query
            $ventas = $query->fetchAll(PDO::FETCH_OBJ);//que formato queremos recibir los datos//en este caso se recibe en formato objeto
        
            //no es necesario cerrar la conexion
        
            return $ventas;
            }
        public function getItem($id){
           
        $db = getconect();
    
       
        $query = $db->prepare('select * from comprador WHERE id = ?');
        $query->execute([$id]);
    
        
        $ventas = $query->fetchAll(PDO::FETCH_ASSOC);
    

    
        return $ventas;
        }
        
   public function getAll(){
        //abro conexion con la base de datos
    $db = getconect();

    //enviamos consulta a la base de datos y se obtiene el resultado
    //Select*from "nombre de la tabla"

    $query = $db->prepare('select * from comprador');
    $query->execute();

    //obtengo todos los datos que me da la query
    $ventas = $query->fetchAll(PDO::FETCH_OBJ);//que formato queremos recibir los datos//en este caso se recibe en formato objeto

    //no es necesario cerrar la conexion

    return $ventas;
    }

    function insertTask($nombre,$apellido,$nombre_producto,$tipoDeCompra){
        $db = getconect();
        
        $query = $db->prepare('INSERT INTO comprador (nombre,apellido,nombre_producto,tipoDeCompra) VALUES (?,?,?,?) ');
        $query -> execute([$nombre,$apellido,$nombre_producto,$tipoDeCompra]); 

        $id = $db->lastInsertId();
        header("Location: listar");
        header("Location: ". "listar");

        
        return $id;
        }
        function insertCategoria($categoria){
            $db = getconect();
            
            $query = $db->prepare('INSERT INTO empresa (categoria) VALUES (?) ');
            $query -> execute([$categoria]); 
    
            $id = $db->lastInsertId();
            header("Location: listar");
            header("Location: ". "listar");
    
            return $id;
        
            }


        function editTask($nombre,$apellido,$nombre_producto,$tipoDeCompra, $id){
            $db = getconect();
            
            $query =$db->prepare('UPDATE comprador SET nombre = ?,apellido=?,nombre_producto=?,tipoDeCompra =? WHERE id = ?');            
            $query -> execute([$nombre,$apellido,$nombre_producto,$tipoDeCompra,$id]); 
            }

        function deleteTask($id) {
            $db = getconect();
            $query =$db->prepare('DELETE FROM comprador WHERE id = ?');
            $query->execute([$id]);
           
        }
    }


