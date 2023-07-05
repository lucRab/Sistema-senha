<?php

namespace App\controller;

use App\model\CoursesModel;
use App\model\UserModel;
use Core\connection\Conexao;
use Core\validations\ValidConnection;
use PDO;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
/**
 * Classe
 * @author Equipe Maquina
 * @version ${9:9.5.0
 */
class Endpoints
{
    private static $router = null;

    public function __construct($router)
    {
        self::$router = $router;
    }

    public static function getAllShifts() {
        $dataRequest = json_decode(file_get_contents('php://input'), true);
        $course = strtoupper($dataRequest['course']);
        $condition = ', t.turno';
        $days = CoursesModel::getCourseDaysModel($course, $condition);
        echo json_encode($days);
    }

    public static function setUserPassword() {
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
    /**
     * Função para cria o token do usuario para fazer login
     */
    public static function setTokenLogin() {
        //Inicia o dotenv
        $dotenv = \Dotenv\Dotenv::createImmutable(dirname(__FILE__, 3));
        $dotenv->load();
        //Recebe os parametro enviado da tela e coloca em variaveis
        $dataRequest = json_decode(file_get_contents('php://input'), true);
        $cpf = $dataRequest['cpf'];
        $senha = md5($dataRequest['senha']);
        //instancia a conexão
        $conexao = Conexao::conectar();
        //verifica se ocorreu erro na conexao
        if(gettype($conexao) == "object") {
            //Query sql
            $query = "SELECT a.nome_aluno, a.cod_aluno, a.cpf, a.data_nascimento, a.senha_login from aluno a where cpf = :cpf";
            //parametro para o sql
            $params = [
              'cpf' => $cpf
            ];
            //Executa o sql
            $dataUser = ValidConnection::isValidConnection($conexao, $query, $params);
            //Recebe o resultado do sql e cria o array com o resultado
            $userFound = $dataUser->fetchAll(PDO::FETCH_OBJ);
            //verifica se a query foi executada
             if (empty($userFound)) {
                http_response_code(404);
                //retorna a mensagem de erro
                echo json_encode("CPF não consta na base de dados");
                die();
              }
            //verifica se o cpf digitado esta correto
            if ($cpf !== $userFound[0]->cpf) {
              http_response_code(404);
              //retorna a mensagem de erro
              echo json_encode("CPF incorretos");
              die();
            }
            //verifica se a senha digitado estar correta
             if ($senha !== $userFound[0]->senha_login) {
                 http_response_code(404);
                 //retorna a mensagem de erro
                 echo json_encode("Senha incorretos");
                 die();
              }
           
            $birth_date = date_create($userFound[0]->data_nascimento);
            $current_date = date_create(date('Y-m-d'));
            $diff = date_diff($birth_date, $current_date);
            //defini os parametros para a criação do token
            $payload = [
                "exp" => time() + 1000,
                "iat" => time(),
                "id_usuario" => $userFound[0]->cod_aluno,
                "nome" => $userFound[0]->nome_aluno,
                "cpf" => $userFound[0]->cpf,
                "idade" => $diff->format('%y')
            ];

            $_SESSION['nome'] = $userFound[0]->nome_aluno;
            $_SESSION['cpf'] = $userFound[0]->cpf;
            $_SESSION['id_usuario'] = $userFound[0]->cod_aluno;
            $_SESSION['idade'] = $diff->format('%y');
            //cria o token
            $encode = JWT::encode($payload, $_ENV['KEY'], 'HS512');
            //retorna o token
            echo json_encode($encode);
        } else {
            http_response_code(500);
            //retorna a mensagem de erro
            echo json_encode("[ATEÇÃO]
        [ERROR: 2002] Erro de conexão com o banco de dados");
        }
    }
    /**
     * Função para criar o token do usuario para fazer o cadastro
     */
    public static function setTokenCadastro() {
        //Inicia o dotenv
        $dotenv = \Dotenv\Dotenv::createImmutable(dirname(__FILE__, 3));
        $dotenv->load();
        //Recebe os parametro enviado da tela
        $dataRequest = json_decode(file_get_contents('php://input'), true);
        //cria um ojeto std e coloca os parametros recebidos da tela
        $data = new \stdClass();
        $data->nome_aluno = $dataRequest['nome'];
        $data->cpf = $dataRequest['cpf'];
        $data->data_nascimento = $dataRequest['data_nascimento'];
        $data->senha = md5($dataRequest['senha']);
        //Instacia o método para selecionar o cpf do usuario
        $existCpf = UserModel::getUserCpf($data);
        //verifica se já existe o cpf na banco de dados
        if (!empty($existCpf)) {
            http_response_code(403);
            echo json_encode("CPF já cadastrado");
            die();
        }
        //Instancia o método para criar o usuario
        $userId = UserModel::createUser($data);
        //verifica se ocorreu algun erro na execução do método
        if(gettype($userId) == "integer") {
            $birth_date = date_create($data->data_nascimento);
            $current_date = date_create(date('Y-m-d'));
            $diff = date_diff($birth_date, $current_date);
            //defini os parametros para a criação do token
            $payload = [
                "exp" => time() + 1000,
                "iat" => time(),
                "id_usuario" => $userId,
                "nome" => $data->nome_aluno,
                "cpf" => $data->cpf,
                "idade"=>  $diff->format('%y')
            ];
            //cria o token
            $encode = JWT::encode($payload, $_ENV['KEY'], 'HS512');

            $_SESSION['nome'] = $data->nome_aluno;
            $_SESSION['cpf'] = $data->cpf;
            $_SESSION['id_usuario'] = $userId;
            $_SESSION['idade'] = $diff->format('%y');
            //retorna o token
            echo json_encode($encode);
        } else {
            /**
             * caso ocorra algum erro na execução do método verifica qual 
             * tipo de erro correu
             * @todo Seria melhor trocar esse if por um case* */
            if($userId == 2002) {
                http_response_code(404);
                //retorna a mensagem de erro
                echo json_encode("[ATEÇÃO]
        [ERROR: 2002] Erro de conexão com o banco de dados");
            } else {
                http_response_code(404);
                //retorna a mensagem de erro
                echo json_encode("[ATENÇÃO]
        [ERROR: 42S22] Erro ao tentar cadastrar");
            }
        }
    }

    public static function authToken() {
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
                //retorna a mensagem de erro
                echo json_encode('Expired token');
            }
        }
    }

    public static function updateSenha() {

        $dataRequest = json_decode(file_get_contents('php://input'), true);
        $data = new \stdClass;
        $data->senha = md5($dataRequest['senha']);
        $data->id = 20831;

       $update = UserModel::updateAge($data);
       if(gettype($update) == "object") {
            echo json_encode("sucesso");
        }

    }

}