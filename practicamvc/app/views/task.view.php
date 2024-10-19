<?php

class TaskView{
    private $user = null;

    public function __construct($user){
        $this->user = $user;
    }

    function showTasks($tasks){
        require 'templates/header.phtml';
        
        var_dump($tasks); die();
    
        require 'templates/footer.phtml';
    }
}