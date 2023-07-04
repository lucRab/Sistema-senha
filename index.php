<?php 
require_once __DIR__ . "/vendor/autoload.php";
use App\controller\UserController;
use App\controller\CoursesController;
use App\controller\ClassesController;
use CoffeeCode\Router\Router;

session_start();

$router = new Router("http://localhost/Sistema-Senha");

/* 
  Controllers
*/
$router->namespace("App\controller");

/* 
  Home
*/
$router->group('/');
$router->get("/", "CoursesController:getAllCourses");

/* 
  Histórico
*/
$router->group('/historico');
$router->get("/", "HistoryController:getPasswords");
$router->get("/download", "HistoryController:downloadPassword");
$router->put("/update", "HistoryController:deletePassword");

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
$router->get("/", "UserController:userLogin");
$router->get("/cadastro", "UserController:createUser");
$router->post("/", "UserController:createUser");
$router->get("/atualizar", "UserController:updateSenha");
$router->post("/atualizar", "UserController:updateSenha");

/* 
  Endpoints
*/
$router->group('json');
$router->post("/turnos", "Endpoints:getAllShifts");
$router->post("/idade", "Endpoints:setDateBirth");
$router->post("/senha", "Endpoints:setUserPassword");
$router->post("/token/login", "Endpoints:setTokenLogin");
$router->post("/token/cadastro", "Endpoints:setTokenCadastro");
$router->post("/token/verificar", "Endpoints:authToken");
$router->post("/atualizar", "Endpoints:updateSenha");

/* 
  Error
*/
$router->group('ooops');
$router->get("/{errcode}", "UserController:error");

$router->dispatch();
if ($router->error()) {
  $router->redirect("/ooops/{$router->error()}");
}