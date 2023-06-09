<?php

namespace App\controller;

use App\model\CoursesModel;
use App\model\UserModel;
use Core\connection\Conexao;
use Core\validations\ValidConnection;
use PDO;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Endpoints
{
    private static $router = null;

    public function __construct($router)
    {
        self::$router = $router;
    }

    public static function getAllShifts()
    {
        $dataRequest = json_decode(file_get_contents('php://input'), true);
        $course = strtoupper($dataRequest['course']);
        $condition = ', t.turno';
        $days = CoursesModel::getCourseDaysModel($course, $condition);
        echo json_encode($days);
    }

    public static function setUserPassword()
    {
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $dataRequest = json_decode(file_get_contents('php://input'), true);
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

    public static function setTokenLogin()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(dirname(__FILE__, 3));
        $dotenv->load();

        $dataRequest = json_decode(file_get_contents('php://input'), true);

        $cpfReplace = preg_replace('/[^0-9]/', '', $dataRequest['cpf']);

        $cpf = $cpfReplace;
        $senha = md5($dataRequest['senha']);

        $conxao = Conexao::conectar();

        if(gettype($conxao) == "object") {
            $query = "SELECT a.nome_aluno, a.email, a.cod_aluno, a.cpf, a.data_nascimento from aluno a where cpf = :cpf and senha_login = :senha";
            $params = [
              'cpf' => $cpf,
              'senha' =>$senha
            ];

            $dataUser = ValidConnection::isValidConnection($conxao, $query, $params);

            $userFound = $dataUser->fetchAll(PDO::FETCH_OBJ);

            if (empty($userFound)) {
                http_response_code(404);
                echo json_encode("CPF ou senha incorretos");
                die();
            }


            $birth_date = date_create($userFound[0]->data_nascimento);
            $current_date = date_create(date('Y-m-d'));
            $diff = date_diff($birth_date, $current_date);

            $payload = [
                "exp" => time() + 20 * 60,
                "iat" => time(),
                "id_usuario" => $userFound[0]->cod_aluno,
                "nome" => $userFound[0]->nome_aluno,
                "cpf" => $userFound[0]->cpf,
                "email" => $userFound[0]->email,
                "idade" => $diff->format('%y')
            ];

            $_SESSION['nome'] = $userFound[0]->nome_aluno;
            $_SESSION['cpf'] = $userFound[0]->cpf;
            $_SESSION['id_usuario'] = $userFound[0]->cod_aluno;
            $_SESSION['idade'] = $diff->format('%y');

            $encode = JWT::encode($payload, $_ENV['KEY'], 'HS512');
            echo json_encode($encode);
        } else {
            http_response_code(500);
            echo json_encode("[ATEÇÃO]
        [ERROR: 2002] Erro de conexão com o banco de dados");
        }
    }

    public static function setTokenCadastro()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(dirname(__FILE__, 3));
        $dotenv->load();

        $dataRequest = json_decode(file_get_contents('php://input'), true);

        $cpfReplace = preg_replace('/[^0-9]/', '', $dataRequest['cpf']);

        $data = new \stdClass();
        $data->nome_aluno = $dataRequest['nome'];
        $data->cpf = $cpfReplace;
        $data->data_nascimento = $dataRequest['data_nascimento'];
        $data->senha = md5($dataRequest['senha']);

        $existCpf = UserModel::getUserCpf($data);

        if (!empty($existCpf)) {
            http_response_code(403);
            echo json_encode("CPF já cadastrado");
            die();
        }

        $userId = UserModel::createUser($data);

        if(gettype($userId) == "integer") {
            $birth_date = date_create($data->data_nascimento);
            $current_date = date_create(date('Y-m-d'));
            $diff = date_diff($birth_date, $current_date);

            $payload = [
                "exp" => time() + 20 * 60,
                "iat" => time(),
                "id_usuario" => $userId,
                "nome" => $data->nome_aluno,
                "cpf" => $data->cpf,
                "idade"=>  $diff->format('%y')
            ];

            $encode = JWT::encode($payload, $_ENV['KEY'], 'HS512');

            $_SESSION['nome'] = $data->nome_aluno;
            $_SESSION['cpf'] = $data->cpf;
            $_SESSION['id_usuario'] = $userId;
            $_SESSION['idade'] = $diff->format('%y');

            echo json_encode($encode);
        } else {
            if($userId == 2002) {
                http_response_code(404);
                echo json_encode("[ATEÇÃO]
        [ERROR: 2002] Erro de conexão com o banco de dados");
            } else {
                http_response_code(404);
                echo json_encode("[ATENÇÃO]
        [ERROR: 42S22] Erro ao tentar cadastrar");
            }
        }
    }

    public static function authToken()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(dirname(__FILE__, 3));
        $dotenv->load();

        $dataRequest = getallheaders();
        $authorization = $dataRequest['Authorization'];

        $token = str_replace('Bearer ', '', $authorization);
        $h = new \stdClass();

        try {
            $decoded = JWT::decode($token, new Key($_ENV['KEY'], 'HS512'));
            if (empty($_SESSION)) {
                $_SESSION['nome'] = $decoded->nome;
                $_SESSION['cpf'] = $decoded->cpf;
                $_SESSION['id_usuario'] = $decoded->id_usuario;
                $_SESSION['idade'] = $decoded->idade;
            }
            echo json_encode($decoded);
        } catch(\Throwable $e) {
            if($e->getMessage()=== 'Expired token') {
                //http_response_code(401);
                session_destroy();
                http_response_code(401);
                echo json_encode('Expired token');
            }
        }
    }

}
