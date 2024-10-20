<?php

class TaskModel{

    function connect(){
        $db = new PDO('mysql:host=localhost;dbname=db_sistemadistribucion;charset=utf8', 'root', '');
        return $db;
    }

    function getTasks(){

        $db = $this->connect();
    
        $query = $db->prepare('SELECT * FROM usuario');
        $query->execute();

        $tasks = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $tasks;
    }

}