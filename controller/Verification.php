<?php
namespace App\controller;
use App\model\CoursesModel;
use App\model\UserModel;
use Core\connection\Conexao;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class Verificar{

    public function testar(){

        $dotenv = \Dotenv\Dotenv::createImmutable(dirname(__FILE__,3));
        $dotenv->load();
    
        $dataRequest = json_decode(file_get_contents('php://input'), true);
        $cpf = 'Analise';
        $senha = $dataRequest['senha'];

        $conxao = Conexao::conectar();

        $prepare = $conxao->prepare("SELECT * from aluno where cpf = :cpf");
        $prepare->execute([
        'cpf' => $cpf
        ]);
        $userFound = $prepare->fetch();

        if($cpf == $userFound['cpf']) {

            if($userFound['senha_login'] == null){

                return json_encode("teste");
            }else{
                
                return json_encode("teste");
            }
        }

        //var_dump($userFound['senha_login']);
    }
}

