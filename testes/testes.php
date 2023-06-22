<?php 
use App\model\UserModel;
use App\controller;

require_once "../core/conexao.php";
require_once "../core/validations/validData.class.php";
require_once "../app/model/CoursesModel.php";
require_once "../app/model/ClassesModel.php";
require_once "../app/model/UserModel.php";
require_once "../app/controller/ClassesController.php";
require_once "../app/controller/CoursesController.php";
require_once "../app/model/PasswordModel.php";
require_once "../database/sqlClasses.php";

$conexao = Conexao::conectar();

/// SELECT
// try {
//     if (gettype($conexao) !== 'string' and get_class($conexao) == 'PDO') {
//       $data = $conexao->query('SELECT * FROM solicitacao');
//       while($row = $data->fetch(PDO::FETCH_OBJ)) {
//         print_r($row);
//       }
//     } else throw new PDOException($conexao);
//   } catch(PDOException $e) {
//       echo 'ERROR: ' . $e->getMessage();
//   }


//// USER

$user = new stdClass();

$user->nome_aluno = 'cocs';
$user->nome_pai = 'zezao';
$user->sexo = 'm';
$user->telefone_celular = '123';
$user->endereco = 'rua 9';
$user->responsavel_cpf = '125';
$user->data_nascimento = '2789';
$user->nome_mae = 'a';
$user->cpf = '123';
$user->email = 'a';
$user->numero_endereco = '10';
$user->id = 31;

// var_dump(UserModel::updateUser($conexao, $user));
// die();

//// VALIDAÇÕES

$email = 'carlosgmail.com';
$testeEmail = ValidData::isValidEmail($email);

$cpf = '904.554.270-62';
$testeEmail = ValidData::isValidCPF($cpf);

$password = 'Teste999!a';
$testePassword = ValidData::isValidPassword($password);

/// CURSOS

$cursos = \App\controller\CoursesController::getAllCourses($conexao);

//// CLASSES

\App\controller\ClassesController::filterByAge(10);
\App\controller\ClassesController::filterByShift('MATUTINO');
\App\controller\ClassesController::setCourse('BALLET');

$teste = \App\controller\ClassesController::filterClassesController($conexao);
var_dump($teste->fetchAll(\PDO::FETCH_OBJ));