<?php
require_once 'app/models/task.model.php';
require_once 'app/views/task.view.php';

class TaskController {

    private $model;
    private $view;
    
    function __construct($res){
        $this->model = new TaskModel();
        $this->view = new TaskView($res->user);
    }
    
        
    function showTasks(){

        $tasks = $this->model->getTasks();

        $this->view->showTasks($tasks);
    }
}