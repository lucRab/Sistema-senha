<?php 
use App\model\PasswordModel;

require_once "../core/conexao.php";
require_once "../core/validations/validData.class.php";
require_once "../app/model/CoursesModel.class.php";
require_once "../app/model/ClassesModel.class.php";
require_once "../app/model/PasswordModel.class.php";
require_once "../app/controller/ClassesController.class.php";
require_once "../database/sqlClasses.php";
$conexao = Conexao::conectar();

//// PARAM

// $pass = new stdClass();

// $pass->cod_aluno = null;
// $pass->cod_senha = 3;


// $teste = new PasswordModel;
// $teste->alterarPassword($conexao,$pass);
// var_dump($teste);
//-------------------------------------------------------------------\\

//// PARAM

//  $param = new stdClass();

// $param->cod_aluno = 1;

// $teste = new PasswordModel;
//  $result = $teste->userPassword($conexao,$param);

// while($row = $result->fetch(PDO::FETCH_OBJ)) {
//          print_r($row);
// }
//-----------------------------------------------------------------\\

//PARAM

$param = new stdClass();

$param->cod_turma = 2819;

$teste = new PasswordModel;
$result = $teste->passwordOpen($conexao,$param);

while($row = $result->fetch(PDO::FETCH_OBJ)) {
  print_r($row);
}