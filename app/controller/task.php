<?php
require_once 'app/Visual/Task.view.php';
require_once 'router.php';
require_once 'app/model/DbTask.php';
require_once 'app/middlewares/session.auth.middleware.php';
require_once 'app/middlewares/verify.auth.middleware.php';
class controller{
   
    private $view;
    private $model;

   public function __construct($res) {
      $this->model = new taskModel();
      $this->view = new TaskView($res->user);
        
    }
    public function showForm($task){
        return $this->view-> showForm($task);
     }
     public function showFormAddCategorias(){
        $task = $this->model->getCategorias();
        return $this->view-> ShowFormAddCategoria($task);
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
        $this->showCategorias();
        $this->showFormAddCategorias();
        $taskCategorias =$this->model->getCategorias();
        $this->showForm($taskCategorias);
        if (!isset($_POST['buscar']) || empty($_POST['buscar'])) {
            return $this->view->showError('Falta completar la categoria deseada');
        }
        $categoria = $_POST['buscar'];
        $task =$this->model-> getAllOf($categoria);
        //var_dump($task);
       return $this->view-> ShowTaskOf($task);   
    }

    function addtask(){
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el nombre');
        }
        if (!isset($_POST['apellido']) || empty($_POST['apellido'])) {
            return $this->view->showError('Falta completar el apellido');
        }
        if (!isset($_POST['nombre_producto']) || empty($_POST['nombre_producto'])) {
            return $this->view->showError('Falta completar el nombre del producto');
        }
        if (!isset($_POST['tipoDeCompra']) || empty($_POST['tipoDeCompra'])) {
            return $this->view->showError('Falta completar el tipo de compra');
        }
        

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $nombre_producto = $_POST['nombre_producto'];
        $tipoDeCompra = $_POST['tipoDeCompra'];
     
        
        $this->model-> insertTask($nombre,$apellido,$nombre_producto, $tipoDeCompra);
        header('Location: ' . BASE_URL . 'listar');
    }
    function addCategoria(){
        if (!isset($_POST['categoria']) || empty($_POST['categoria'])) {
            return $this->view->showError('Falta completar el título de la categoria');
        }
        $categoria = $_POST['categoria'];
        $this->model-> insertCategoria( $categoria );
        
    }
    function editarCategoria(){
        if (!isset($_POST['nombreCate']) || empty($_POST['nombreCate'])) {
            return $this->view->showError('Falta completar el nombre de la categoria que se quiere editar');
        }
        if (!isset($_POST['nombrenuevo']) || empty($_POST['nombrenuevo'])) {
            return $this->view->showError('Falta completar el título de la categoria');
        }
        $categoriaEditar = $_POST['nombreCate'];
        $categoria = $_POST['nombrenuevo'];
        $this->model-> editCategoria( $categoria,$categoriaEditar );
        header("Location: ". BASE_URL ."home");
    
    }
    function eliminarCategoria(){
        if (!isset($_POST['eliminarCategoria']) || empty($_POST['eliminarCategoria'])) {
            return $this->view->showError('Falta completar el nombre de la categoria que se quiere eliminar');
        }
        
        $categoriaEliminar = $_POST['eliminarCategoria'];
        
        $this->model-> deleteCategoria($categoriaEliminar );
        header("Location: ". BASE_URL ."home");
    
    }

    function edittask($id){
        $item = $this->model->getItem( $id);
        if (!$item) {
            return $this->view->showError('no existe esa factura');
        }
        if ( empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el nombre');
        }
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el nombre');
        }
        if (!isset($_POST['apellido']) || empty($_POST['apellido'])) {
            return $this->view->showError('Falta completar el apellido');
        }
        if (!isset($_POST['nombre_producto']) || empty($_POST['nombre_producto'])) {
            return $this->view->showError('Falta completar el nombre del producto');
        }
        if (!isset($_POST['tipoDeCompra']) || empty($_POST['tipoDeCompra'])) {
            return $this->view->showError('Falta completar el tipo de compra');
        }
            	
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $nombre_producto = $_POST['nombre_producto'];
        $tipoDeCompra = $_POST['tipoDeCompra'];
        $this->showItem($id);
        
        $this->model-> editTask($nombre,$apellido,$nombre_producto, $tipoDeCompra, $id);
        header("Location: ". BASE_URL ."mostrarMas/$id");
    }



   function deleteTask($id){
    $item = $this->model->getItem( $id);
    if (!$item) {
        return $this->view->showError('no existe esa factura');
    }
    $this->model->deleteTask($id);
  
   header("Location: ". BASE_URL ."listar");

   }
    function showItem($id){
       $taskCategorias =$this->model->getCategorias();
       if (!isset($id) || empty($id)) {
        return $this->view->showError('Falta completar el id');
    }
       $item = $this->model->getItem($id);
       if (!$item) {
        return $this->view->showError('no existe esa factura');
    }
  
        return $this->view-> ShowItem($item,$taskCategorias);
        
    }
   


}