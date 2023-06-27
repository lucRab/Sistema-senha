<?php 

require_once __DIR__ . "/vendor/autoload.php";
use App\controller\UserController;
use App\controller\CoursesController;
use App\controller\ClassesController;
use CoffeeCode\Router\Router;

$router = new Router("http://localhost/Sistema-Senha");

/* 
  Controllers
*/
$router->namespace("App\controller");

/* 
  Home
*/
$router->group('');
$router->get("/", "CoursesController:getAllCourses");

/* 
  Cursos
*/
$router->group('curso');
$router->get("/{course}", "CoursesController:getCourse");

$router->post("/{course}", "ClassesController:filterClassesController");

/* 
  Registro / Login
*/
$router->group('login');
$router->get("/", "UserController:createUser");
$router->post("/", "UserController:createUser");

/* 
  Endpoints
*/
$router->group('json');
$router->post("/turnos", "Endpoints:getAllShifts");

/* 
  Error
*/

$router->group('ooops');
$router->get("/{errcode}", "UserController:error");

$router->dispatch();
if ($router->error()) {
  $router->redirect("/ooops/{$router->error()}");
}