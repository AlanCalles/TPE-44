<?php
require_once 'app/views/Json.view.php';
require_once 'app/model/DbTask.php';
const BASE_URL = 'http://localhost/web2/tp2/';


class TaskApicontroller{
   
    private $view;
    private $model;

   public function __construct() {
      $this->model = new taskModel();
        $this->view = new JSONView();
        
    }
   
    
    function getAll($req,$res){
        $TipoCompra = null;
        if(isSet($req->query->tipo_de_compra)){
            $TipoCompra = $req->query->tipo_de_compra; 
        }
        $orderBy = false;    
        if(isSet($req->query->order_by)){
            $orderBy = $req->query->order_by;
        }
        $orderDirection = "ASC";
        if(isSet($req->query->order_direction)){
            $orderDirection = $req->query->order_direction;
        }
        $task =$this->model-> getAll($orderBy,$orderDirection,$TipoCompra);
      
        return $this->view-> response($task);   
    }
   

    function post($req,$res){
       

        if(empty($req->body->nombre))
        return $this ->view->response("falta completar nombre",400);
        if(empty( $req->body->apellido))
        return $this ->view->response("falta completar apellido",400);
        if(empty($req->body->nombre_producto))
        return $this ->view->response("falta completar nombre del producto",400);
        if(empty($req->body->tipoDeCompra))
        return $this ->view->response("falta completar tipo de compra",400);
   
   
        $apellido =  $req->body->apellido;
        $nombre_producto =  $req->body->nombre_producto;
        $tipoDeCompra =  $req->body->tipoDeCompra;
        $nombre =  $req->body->nombre;
     
       

        $id = $this->model-> insertTask($nombre,$apellido,$nombre_producto, $tipoDeCompra);
        if($id){
            $item = $this->model->getItem( $id);
            return $this ->view->response($item,201);
        }else{
            return $this ->view->response("no se pudo agregar el comprador",500);
        }
        
    }
   

    function update($req,$res){
       $id = $req->params->id;
       $item = $this->model->getItem( $id);
       if(!$item){return $this ->view->response("no existe un comprador con el id=$id",400);}
        if(empty($req->body->nombre))
        return $this ->view->response("falta completar nombre",400);
        if(empty( $req->body->apellido))
        return $this ->view->response("falta completar apellido",400);
        if(empty($req->body->nombre_producto))
        return $this ->view->response("falta completar nombre del producto",400);
        if(empty($req->body->tipoDeCompra))
        return $this ->view->response("falta completar tipo de compra",400);
   
   
        $apellido =  $req->body->apellido;
        $nombre_producto =  $req->body->nombre_producto;
        $tipoDeCompra =  $req->body->tipoDeCompra;
        $nombre =  $req->body->nombre;
     
       
        
      $this->model-> editTask($nombre,$apellido,$nombre_producto, $tipoDeCompra, $id);    
      $this->view->response($item,200);    
    }



   function delete($req,$res){
    
        $id = $req -> params ->id;
        $item = $this->model->getItem($id);
        if(!$item)
            return $this ->view->response("la tarea no existe",404);
        
        $this->model->deleteTask($id);
  
        header("Location: ". BASE_URL ."listar");
        return $this ->view->response("la tarea con el id= $id se elimino");
   }
   
   function get($req,$res){
       $id = $req -> params ->id;
       
       $item = $this->model->getItem($id);
        if(!$item){
            return $this ->view->response("la tarea no existe",404);}
        return $this->view-> response($item);
    }
   
    }

