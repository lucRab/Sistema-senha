<?php
require("../../vendor/autoload.php");
require("../../core/connection/Conexao.php");
header('Content-Type: applications/json');
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
//use Core\connection;
class Token {
    static function createTokenLogin(){
        $dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__,3));
        $dotenv->load();


        $cpf = $_POST["cpf"];
        $senha = $_POST["senha"];

        $conxao = Core\connection\Conexao::conectar();

        $prepare = $conxao->prepare("SELECT * from aluno where cpf = :cpf");
        $prepare->execute([
            'cpf' => $cpf
        ]);
        $userFound = $prepare->fetch();

        $payload = [
            "exp" => time() + 10,
            "iat" => time(),
            "cpf" => $cpf
        ];

        $encode = JWT::encode($payload,$_ENV['KEY'],'HS512');

        echo json_encode($encode);
    }
}
// header("location: ../view/login.php?encode=$encode");
// die();


