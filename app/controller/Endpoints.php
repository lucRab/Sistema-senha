<?php 
namespace App\controller;
use App\model\CoursesModel;
use App\model\UserModel;
use Core\connection\Conexao;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Dotenv;

class Endpoints {

  public static function getAllShifts() {
    $dataRequest = json_decode(file_get_contents('php://input'), true);
    $course = strtoupper($dataRequest['course']);
    $condition = ', t.turno';
    $days = CoursesModel::getCourseDaysModel($course, $condition);
    echo json_encode($days);
  }

  public static function setDateBirth() {
    $dataRequest = json_decode(file_get_contents('php://input'), true);
    $age = $dataRequest['data_nascimento'];
    $id = 1;
    $date = "27/09/2005";
    $data = [
      "id" => $id,
      "data_nascimento" => $date
    ];
    $updateUser = UserModel::updateUser($data);
    echo json_encode($updateUser);
  }

  public static function setTokenLogin() {
    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__,3));
    $dotenv->load();
    
    $dataRequest = json_decode(file_get_contents('php://input'), true);
    $cpf = $dataRequest['cpf'];
    $senha = $dataRequest['senha'];

    $conxao = Conexao::conectar();

    $prepare = $conxao->prepare("SELECT * from aluno where cpf = :cpf");
    $prepare->execute([
        'cpf' => $cpf
    ]);
    $userFound = $prepare->fetch();

    $payload = [
        "exp" => time() + 10,
        "iat" => time(),
        "cpf" => $cpf,
        "senha" => $senha
    ];

    $encode = JWT::encode($payload,$_ENV['KEY'],'HS512');
    echo json_encode($encode);
  }

  public static function setTokenCadastro() {
    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__,3));
    $dotenv->load();
    
    $dataRequest = json_decode(file_get_contents('php://input'), true);
    $nome = $dataRequest['nome'];
    $cpf = $dataRequest['cpf'];
    $datanascimento = $dataRequest['data_nascimento'];
    $senha = $dataRequest['senha'];

    $conxao = Conexao::conectar();

    $prepare = $conxao->prepare("SELECT * from aluno where cpf = :cpf");
    $prepare->execute([
        'cpf' => $cpf
    ]);
    $userFound = $prepare->fetch();

    $payload = [
        "exp" => time() + 10,
        "iat" => time(),
        "nome" => $nome,
        "cpf" => $cpf,
        "datanascimento"=> $datanascimento,
        "senha" => $senha
    ];

    $encode = JWT::encode($payload,$_ENV['KEY'],'HS512');
    echo json_encode($encode);
  }

}