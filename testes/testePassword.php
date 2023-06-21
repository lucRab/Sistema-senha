<?php 
use app\model\PasswordModel;

require_once "../core/conexao.php";
require_once "../core/validations/validData.class.php";
require_once "../app/model/coursesModel.class.php";
require_once "../app/model/classesModel.class.php";
require_once "../app/model/passwordModel.class.php";
require_once "../app/controller/classesController.class.php";
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

$pass = new stdClass();

$pass->cod_aluno = null;
$pass->cod_senha = 3;

// var_dump(UserModel::updateUser($conexao, $user));
// die();

//// VALIDAÇÕES

// $email = 'carlosgmail.com';
// $testeEmail = ValidData::isValidEmail($email);

// $cpf = '904.554.270-62';
// $testeEmail = ValidData::isValidCPF($cpf);

// $password = 'Teste999!a';
// $testePassword = ValidData::isValidPassword($password);

//// CLASSES

//$courses = \app\model\CoursesModel::getAllCourses($conexao);
//$coe = \app\controller\ClassesController::filterByAge(10);

$teste = new PasswordModel;
$teste->alterarPassword($conexao,$pass);

var_dump($teste);