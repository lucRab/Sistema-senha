<?php 
require_once __DIR__ . "/vendor/autoload.php";
use App\controller\UserController;
use App\controller\CoursesController;
use App\controller\ClassesController;
use App\model\UserModel;
use CoffeeCode\Router\Router;

('a');

$data = new \stdClass;
$data->nome_aluno = 'ze'; 
$data->data_nascimento = '2005/09/27';          
$data->cpf = '123';
$data->senha = '4343';

$teste = UserModel::createUser($data);
($teste);