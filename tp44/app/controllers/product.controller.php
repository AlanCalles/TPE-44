<?php
require_once 'app/models/product.model.php';
require_once 'app/views/product.view.php';

class ProductController{
    private $model;
    private $view;


    public function __construct($res){
        $this->model = new ProductModel();
        $this->view = new ProductView($res->user);
    }

    public function showProductsHome(){
        //obtengo los productos de la db
        $products = $this->model->getProducts();

        //mando los productos a la vista
        $this->view->showProductsHome($products);

    }

    public function showProducts(){
        //obtengo los productos de la db
        $products = $this->model->getProducts();

        //mando los productos a la vista
        $this->view->showProducts($products);

    }

   
    public function addProduct(){
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->showError("Falta completar el nombre");       
        }

        if (!isset($_POST['apellido']) || empty($_POST['apellido'])) {
            return $this->view->showError("falta completar el apellido");
        }
        if (!isset($_POST['nombre_producto']) || empty($_POST['nombre_producto'])) {
            return $this->view->showError("falta completar el nombre del producto");
        }
        if (!isset($_POST['tipoDeCompra']) || empty($_POST['tipoDeCompra'])) {
            return $this->view->showError("Falta seleccionar una categoría");
        }
       
        
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $nombre_producto = $_POST['nombre_producto'];
        $tipoDeCompra = $_POST['tipoDeCompra'];

        $id = $this->model->insertProduct($nombre,$apellido,$nombre_producto,$tipoDeCompra);

        // redirijo al home con sesion iniciada
        header('Location: ' . BASE_URL . 'home-admin');

    }
    
    public function deleteProduct($id){
        $product = $this->model->getProduct($id); 

        if (!$product) {
            return $this->view->showError("No existe el producto con el id=$id");
        }

        $this->model->eraseProduct($id);
        
        header('Location: ' . BASE_URL . 'home-admin');
    }

    public function editProduct($id){
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->showError("Falta completar el nombre");       
        }

        if (!isset($_POST['apellido']) || empty($_POST['apellido'])) {
            return $this->view->showError("falta completar el apellido");
        }
        if (!isset($_POST['nombre_producto']) || empty($_POST['nombre_producto'])) {
            return $this->view->showError("falta completar el nombre del producto");
        }
        if (!isset($_POST['tipoDeCompra']) || empty($_POST['tipoDeCompra'])) {
            return $this->view->showError("Falta seleccionar una categoría");
        }
       
        
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $nombre_producto = $_POST['nombre_producto'];
        $tipoDeCompra = $_POST['tipoDeCompra'];

        $this->model->updateProduct($id,$nombre,$apellido,$nombre_producto,$tipoDeCompra);

        // redirijo al home con sesion iniciada
        header('Location: ' . BASE_URL . 'home-admin');
    }

    public function showEditProducts($id){
        //obtengo los productos de la db
        $product = $this->model->getProduct($id);

        //mando los productos a la vista
        $this->view->showEditProducts($product);

    }

}