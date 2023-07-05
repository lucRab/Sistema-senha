<?php 
namespace App\model;
use Core\connection\Conexao;
use Core\validations\ValidConnection;
use PDO;
require_once __DIR__."/../../database/sqlClasses.php";

class HistoryModel {

  public static function getPasswordsModel($cod_aluno)
  {
    $conexao = Conexao::conectar();
    $query = SQL_SELECT_PASSWORDS();
    $params = [
      "cod_aluno" => $cod_aluno
    ];
    $con = ValidConnection::isValidConnection($conexao, $query, $params);
    return $con->fetchAll(PDO::FETCH_OBJ);
  }


  public static function deletePasswordModel($cod_aluno)
  {
    $conexao = Conexao::conectar();
    $query = SQL_DELETE_PASSWORD();
    $params = [
      "cod_aluno" => $cod_aluno
    ];
    $con = ValidConnection::isValidConnection($conexao, $query, $params);
    return $con->fetchAll(PDO::FETCH_OBJ);
  }


  public static function downloadPasswordModel($cod_autentication)
  {
    $conexao = Conexao::conectar();
    $query = SQL_SELECT_PASSWORD();
    $cod_aluno = $_SESSION['id_usuario'];

    $params = [
      "autenticacao" => $cod_autentication,
      "cod_aluno" => $cod_aluno
    ];
    $con = ValidConnection::isValidConnection($conexao, $query, $params);
    return $con->fetchAll(PDO::FETCH_OBJ);
  }

}