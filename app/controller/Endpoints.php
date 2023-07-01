<?php 
namespace App\controller;
use App\model\CoursesModel;
use App\model\UserModel;
use Core\connection\Conexao;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Endpoints {
  private static $router = null;

  public function __construct($router) {
    self::$router = $router;
  }

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

  public static function setUserPassword() {
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
    $dataRequest = json_decode(file_get_contents('php://input'), true);
    $id = $dataRequest['id'];
    $cod_senha = $dataRequest['cod_senha'];
    $data = [
      "cod_aluno" => $_SESSION['id_usuario'],
      "cod_senha" => $cod_senha,
      "situacao" => "UTILIZADA",
      "data_atualizado" => date("Y/m/d")
    ];
    $updateUser = UserModel::updatePasswordUser($data);
    echo json_encode($updateUser);
  }

  public static function setTokenLogin() {
    $dotenv = \Dotenv\Dotenv::createImmutable(dirname(__FILE__,3));
    $dotenv->load();
    
    $dataRequest = json_decode(file_get_contents('php://input'), true);
    $cpf = $dataRequest['cpf'];
    $senha = $dataRequest['senha'];

    $conxao = Conexao::conectar();
    if(gettype($conxao) == "object") {

      $prepare = $conxao->prepare("SELECT * from aluno where cpf = :cpf");
      $prepare->execute([
          'cpf' => $cpf,
      ]);
      $userFound = $prepare->fetch();
        if(!$userFound) {
          http_response_code(404);
          echo json_encode("CPF não registrado");
          die();
        }
        if(password_verify($senha, $userFound['senha_login'])){
          $payload = [
              "exp" => time() + 1000,
              "iat" => time(),
              "cpf" => $cpf,
              "senha" => $senha
          ];

          $encode = JWT::encode($payload,$_ENV['KEY'],'HS512');
          echo json_encode($encode);
        }else {
          http_response_code(404);
          echo json_encode("Senha Incorreta");
        }
    }else {
        http_response_code(500);
        echo json_encode("[ATEÇÃO]
        [ERROR: 2002] Erro de conexão com o banco de dados");
    }
  }

  public static function setTokenCadastro() {
    $dotenv = \Dotenv\Dotenv::createImmutable(dirname(__FILE__,3));
    $dotenv->load();
   
    $dataRequest = json_decode(file_get_contents('php://input'), true);

    $data = new \stdClass;
    $data->nome_aluno = $dataRequest['nome'];
    $data->cpf = $dataRequest['cpf'];
    $data->data_nascimento = $dataRequest['data_nascimento'];
    $data->senha = password_hash($dataRequest['senha'], PASSWORD_ARGON2I);

    $teste = UserModel::getUserCpf($data);
    $userFound = $teste->fetch();
    if(!$teste = null) {
      http_response_code(403);
      echo json_encode("Este CPf já estar cadastrado");
      die();
    }
    $userId = UserModel::createUser($data);
    if(gettype($userId) == "integer") {
      $birth_date = date_create($data->data_nascimento);
      $current_date = date_create(date('Y-m-d'));
      $diff = date_diff($birth_date, $current_date);

      $payload = [
          "exp" => time() + 1000,
          "iat" => time(),
          "id_usuario" => $userId,
          "nome" => $data->nome_aluno,
          "cpf" => $data->cpf,
          "idade"=>  $diff->format('%y')
      ];

      $encode = JWT::encode($payload,$_ENV['KEY'],'HS512');
      echo json_encode($encode);
    }else {
      if($userId == 2002) {
        http_response_code(404);
        echo json_encode("[ATEÇÃO]
        [ERROR: 2002] Erro de conexão com o banco de dados");
      }else {
        http_response_code(404);
        echo json_encode("[ATENÇÃO]
        [ERROR: 42S22] Erro ao tentar cadastrar");
      }
    }
  }

  public static function authToken() {
    $dotenv = \Dotenv\Dotenv::createImmutable(dirname(__FILE__,3));
    $dotenv->load();
    
    $dataRequest = getallheaders();
    $authorization = $dataRequest['Authorization'];

    $token = str_replace('Bearer ','',$authorization);
    $h = new \stdClass;
 
    try{
        $decoded = JWT ::decode($token,new Key($_ENV['KEY'],'HS512'));
        $_SESSION['nome'] = $decoded->nome;
        $_SESSION['cpf'] = $decoded->cpf;
        $_SESSION['id_usuario'] = $decoded->id_usuario;
        $_SESSION['idade'] = $decoded->idade;
        echo json_encode($decoded);
    }catch(\Throwable $e){
        if($e->getMessage()=== 'Expired token') {
            //http_response_code(401);
            session_destroy();
            http_response_code(401);
            echo json_encode('Expired token');
        }
    }
  }

}