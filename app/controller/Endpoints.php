<?php 
namespace App\controller;
use App\model\CoursesModel;
use App\model\UserModel;
use Core\connection\Conexao;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Throwable;

class Endpoints {
  private static $route = null;

  public function __construct($router) {
    self::$route = $router;
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
      "cod_aluno" => 1,
      "cod_senha" => 1,
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
    try{
      if(gettype($conxao) == "object") {
      
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
    }catch(Throwable $e) {
      echo json_encode('Expired token');
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
    $data->senha = $dataRequest['senha'];


    $insert = UserModel::createUser($data);

    if(gettype($insert) == "integer") {
      $payload = [
          "exp" => time() + 9999999,
          "iat" => time(),
          "nome" => $data->nome_aluno,
          "cpf" => $data->cpf,
          "datanascimento"=> $data->data_nascimento,
          "id" => $insert
      ];

      $encode = JWT::encode($payload,$_ENV['KEY'],'HS512');
      echo json_encode($encode);
    }else {
      if($insert == "ERROR: SQLSTATE[HY093]: Invalid parameter number: parameter was not defined") {
        echo json_encode("[ATEÇÃO] Erro ao tentar cadastrar");
      }else{
        //var_dump(gettype($insert));
        echo json_encode("[ATENÇÃO] Erro ao conectar com banco de dados");
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
        $_SESSION['cpf'] = $decoded->cpf;
        echo json_encode($decoded);
    }catch(\Throwable $e){
        if($e->getMessage()=== 'Expired token') {
            //http_response_code(401);
            session_destroy();
            echo json_encode('Expired token');
        }
    }
  }

}