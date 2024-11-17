<?php

require_once 'app/libs/Router.php';
require_once 'app/controller/TaskApiController.php';


$Router = new Router();
 
$Router->addRoute('compradores'       ,'GET'      ,'TaskApiController'    ,'getAll');
$Router->addRoute('compradores/:id'   ,'GET'      ,'TaskApiController'    ,'get');
$Router->addRoute('compradores/:id'   ,'DELETE'   ,'TaskApiController'    ,'delete');
$Router->addRoute('compradores'       ,'POST'   ,'TaskApiController'      ,'post');
$Router->addRoute('compradores/:id'   ,'PUT'   ,'TaskApiController'      ,'update');

$Router-> route($_GET['resource'], $_SERVER['REQUEST_METHOD']);