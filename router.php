<?php
require_once 'app/controller/task.php';
require_once 'C:/xampp/htdocs/web2/tp2/app/Visual/Task.view.php';


require_once 'C:/xampp/htdocs/web2/tp2/app/middlewares/session.auth.middleware.php';
require_once 'C:/xampp/htdocs/web2/tp2/app/middlewares/verify.auth.middleware.php';
require_once 'C:/xampp/htdocs/web2/tp2/app/controller/AuthController.php';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'login';
}


$params = explode('/', $action);


switch ($params[0]) {

    case 'addCategoria': 
        
        $controller = new controller(); 
        $controller->addCategoria();
        break;
    case 'listarOf': 
        $controller = new controller(); 
        $controller->showTaskOf();
        break;
    
    case 'listar': 
        $controller = new controller(); 
        $controller->showtask();
        break;
    
    case 'edit': 
        $controller = new controller(); 
        $controller->  edittask($params[1]);
        break;
        
    case 'insert': 
            $controller = new controller(); 
            $controller->  addtask();
            break;
    
    case 'delete': 
        $controller = new controller(); 
        $controller->  deleteTask($params[1]);
        break;  
            
    
       
    case 'mostrarMas': 
            $controller = new controller(); 
            $controller-> showItem($params[1]);
            break;  
    case 'showLogin':
                $controller = new AuthController();
                $controller->showLogin();
                break;
    case 'login':
                $controller = new AuthController();
                $controller->login();
                break;
    case 'logout':
                $controller = new AuthController();
                $controller->logout();
                break;
                
     
                    
                
                    
   
    default: 
        echo('404 Page not found'); //llamar a la funcior erro de la clase view
        break;
}





?>
