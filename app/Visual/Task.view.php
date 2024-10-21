<?php

class TaskView { 
    public function showForm($task){
       $count = count($task);
        require_once 'C:/xampp/htdocs/web2/tp2/templates/form.phtml';
    }
    public function ShowTaskOf($task){
        $count = count($task);
        require_once'C:/xampp/htdocs/web2/tp2/templates/ListaCompradores.phtml';
    }
    public function ShowTask($task){
        require_once 'C:/xampp/htdocs/web2/tp2/templates/header.phtml';
        $count = count($task);
        require_once'C:/xampp/htdocs/web2/tp2/templates/ListaCompradores.phtml';
        require_once'C:/xampp/htdocs/web2/tp2/templates/BotonLogOt.phtml';
  
    }
    public function ShowItem($item){
      
        require_once'C:/xampp/htdocs/web2/tp2/templates/SingularItem.phtml';
        $count = count($item);
         $view = new SingularItem();
         $view-> showItem( $item );
         $this->ShowFormEdit($item);
      
    }
    public function ShowCategorias($task){
        require_once'C:/xampp/htdocs/web2/tp2/templates/Categories.phtml';
         $count = count($task);
         $view = new Categories();
         $view-> showCategorias( $task );
     
    }
    public function ShowFormEdit($item){
        require_once'C:/xampp/htdocs/web2/tp2/templates/formEdit.phtml'; 
        $view = new FormEdit();
         $view-> showFormEdit($item);
    }
    public function ShowFormAddCategoria(){
        require_once'C:/xampp/htdocs/web2/tp2/templates/formAddCategorias.phtml';    
    }
}
