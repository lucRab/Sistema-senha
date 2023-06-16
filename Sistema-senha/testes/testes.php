<?php 

require_once "../core/conexao.php";
require_once "../core/validations/validData.class.php";
require_once "../app/model/coursesModel.class.php";
require_once "../app/model/classesModel.class.php";

$conexao = Conexao::conectar();

/// SELECT
try {
    if (gettype($conexao) !== 'string' and get_class($conexao) == 'PDO') {
      $data = $conexao->query('SELECT * FROM solicitacao');
      while($row = $data->fetch(PDO::FETCH_OBJ)) {
        print_r($row);
      }
    } else throw new PDOException($conexao);
  } catch(PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
  }

//// VALIDAÇÕES

$email = 'carlosgmail.com';
$testeEmail = ValidData::isValidEmail($email);

$cpf = '904.554.270-62';
$testeEmail = ValidData::isValidCPF($cpf);

$password = 'Teste999!a';
$testePassword = ValidData::isValidPassword($password);

//// CLASSES

$courses = CoursesModel::getAllCourses($conexao);
$classes = ClassesModel::filterByAge($conexao, 1, 99);


 while($row = $classes->fetch(PDO::FETCH_OBJ)) {
   print_r($row);
 }