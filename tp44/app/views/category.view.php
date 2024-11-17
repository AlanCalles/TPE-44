<?php

class CategoryView{
    private $user = null;

    public function __construct($user){
        $this->user = $user;
    }

    public function showCategories($categories) {
        // la vista define una nueva variable con la cantida de tareas
        $count = count($categories);

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion
        require 'templates/lista_categorias.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }

}