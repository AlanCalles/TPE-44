<?php
require_once 'libs/response.php';
require_once 'config.php';
require_once 'app/middlewares/session.auth.middleware.php';
require_once 'app/middlewares/verify.auth.middleware.php';
require_once 'app/controllers/product.controller.php';
require_once 'app/controllers/category.controller.php';
require_once 'app/controllers/auth.controller.php';



// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response(); // lugar dodne guardar el usuario para no dejarlo suelto, empieza  a agrupar distintas cosas q necesitemos pasar por middlewares
//pasa por los middlewares y los middlewares lo modifican, asi cuando llega al controller, puede ver q datos puede usar

$action = 'home'; //action por def
if (!empty($_GET['action'])){
    $action = $_GET['action'];
}



$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        $controller = new ProductController($res);
        $controller->showProductsHome();
        break;

    case 'home-admin':
        sessionAuthMiddleware($res);
        $controller = new CategoryController($res);
        $controller->showCategories();

        $controller = new ProductController($res);
        $controller->showProducts();
        break;

    case 'nueva':
        sessionAuthMiddleware($res); // Setea $res->user si existe session
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login

        $controller = new ProductController($res);
        $controller->addProduct();
        break;
    case 'eliminar':
        sessionAuthMiddleware($res); // Setea $res->user si existe session
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login

        $controller = new ProductController($res);
        $controller->deleteProduct($params[1]);
        break;
    case 'editar':
        sessionAuthMiddleware($res); // Setea $res->user si existe session
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login
    
        $controller = new ProductController($res);
        $controller->editProduct($params[1]);
        break;


    case 'nuevaC':
        sessionAuthMiddleware($res); // Setea $res->user si existe session
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login
   
        $controller = new CategoryController($res);
        $controller->addCategory();
        break;
    case 'eliminarC':
        sessionAuthMiddleware($res); // Setea $res->user si existe session
        verifyAuthMiddleware($res); // Verifica que el usuario esté logueado o redirige a login
  
        $controller = new CategoryController($res);
        $controller->deleteCategory($params[1]);
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
    
    default: 
        echo "404 Page Not Found";
        break;
}