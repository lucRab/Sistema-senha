<?php 

require_once __DIR__ . "/vendor/autoload.php";
use App\controller\ClassesController;
use App\controller\UserController;
use CoffeeCode\Router\Router;


$router = new Router("http://localhost/Sistema-Senha");

/* 
  Controllers
*/
$router->namespace("App\controller");

/* 
  Registro / Login
*/
$router->group('login');
$router->get("/", "UserController:createUser");
$router->post("/", "UserController:createUser");

/* 
  Error
*/

$router->group('ooops');
$router->get("/{errcode}", "UserController:error");

$router->dispatch();
if ($router->error()) {
  $router->redirect("/ooops/{$router->error()}");
}