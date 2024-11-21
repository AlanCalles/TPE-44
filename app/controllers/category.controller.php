<?php
require_once 'app/models/category.model.php';
require_once 'app/views/category.view.php';

class CategoryController{
    private $model;
    private $view;


    public function __construct($res){
        $this->model = new CategoryModel();
        $this->view = new CategoryView($res->user);
    }

    public function showCategories(){
        //obtengo los productos de la db
        $categories = $this->model->getCategories();

        //mando los productos a la vista
        $this->view->showCategories($categories);

    }

   
    public function addCategory(){
        if (!isset($_POST['categoria']) || empty($_POST['categoria'])) {
            return $this->view->showError("Falta completar la categoria");       
        }
    
        $categoria = $_POST['categoria'];

        $id = $this->model->insertCategory($categoria);

        if (!$id) {
            return $this->view->showError("La categoría '$categoria' ya existe.");
        }

        // redirijo al home con sesion iniciada
        header('Location: ' . BASE_URL . 'home-admin');

    }
    
    public function deleteCategory($id){
        $category = $this->model->getCategory($id); 

        if (!$category) {
            return $this->view->showError("No existe la categoria con el id=$id");
        }

        $this->model->eraseCategory($id);
        
        header('Location: ' . BASE_URL . 'home-admin');
    }
}