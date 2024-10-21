<?php
require_once 'C:/xampp/htdocs/web2/tp2/router.php';
require_once 'C:/xampp/htdocs/web2/tp2/app/model/DbTask.php';
require_once 'app/middlewares/session.auth.middleware.php';
require_once 'app/middlewares/verify.auth.middleware.php';
const BASE_URL = 'http://localhost/web2/tp2/';
class controller{
   
    private $view;
    private $model;

   public function __construct() {
      $this->model = new taskModel();
        $this->view = new TaskView();
        
    }
    public function showForm($task){
        return $this->view-> showForm($task);
     }
     public function showFormAddCategorias(){
        return $this->view-> ShowFormAddCategoria();
     }
    public function showCategorias(){
        $task = $this->model->getCategorias();
        return $this->view-> showCategorias($task);
     }
    
    function showTask(){
        
        $this->showCategorias();
        $this->showFormAddCategorias();
        $taskCategorias =$this->model->getCategorias();
        $task =$this->model-> getAll();
        $this->showForm($taskCategorias);
        return $this->view-> ShowTask($task);   
    }
    function showTaskOf(){  
        $categoria = $_POST['buscar'];
        $task =$this->model-> getAllOf($categoria);
        return $this->view-> ShowTaskOf($task);   
    }

    function addtask(){
     
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $nombre_producto = $_POST['nombre_producto'];
        $tipoDeCompra = $_POST['tipoDeCompra'];
     
        
        $this->model-> insertTask($nombre,$apellido,$nombre_producto, $tipoDeCompra);
        
    }
    function addCategoria(){
     
        $categoria = $_POST['categoria'];
        $this->model-> insertCategoria( $categoria );
        
    }

    function edittask($id){
            	
        $nombre = $_POST['nombreE'];
        $apellido = $_POST['apellidoE'];
        $nombre_producto = $_POST['nombre_productoE'];
        $tipoDeCompra = $_POST['tipoDeCompraE'];
        $this->showItem($id);
        
        $this->model-> editTask($nombre,$apellido,$nombre_producto, $tipoDeCompra, $id);
        header("Location: ". BASE_URL ."mostrarMas/$id");
    }



   function deleteTask($id){
    
    $this->model->deleteTask($id);
  
   header("Location: ". BASE_URL ."listar");

   }
    function showItem($id){
 
       $item = $this->model->getItem( $id);
  
        return $this->view-> ShowItem($item);
    }
   


}