<?php
namespace App\Model;

require_once("../../core/conexao.php");
use PDOException;
class UserModel {
    


    public function createUser($data) {
        $conexao = \Conexao::conectar();
        
        $dados = array( 
            
            'nome_aluno' => $data->nome_aluno, 'data_nascimento' => $data->data_nascimento,          
            'nome_pai' => $data->nome_pai,   'nome_mae' => $data->nome_mae,
            'sexo' => $data->sexo,           'cpf' => $data->cpf,
            'telefone_celular' => $data->telefone_celular,   'email' => $data->email,
            'endereco' => $data->endereco,             'numero_endereco' => $data->numero_endereco,
            'responsavel_cpf' => $data->responsavel_cpf);
        
        $query = "INSERT INTO aluno(
                    nome_aluno, data_nascimento, nome_pai, nome_mae, sexo, cpf, telefone_celular, email,
                    endereco, numero_endereco, responsavel_cpf)               
                    VALUES( :nome_aluno, :data_nascimento, :nome_pai, :nome_mae,
        :sexo, :cpf, :telefone_celular, :email, :endereco, :numero_endereco, :responsavel_cpf)";
        
        /**
         * :cod_bairro, :cod_escolaridade, :nome_aluno, :data_nascimento, :nome_pai, :nome_mae
        :sexo, :cpf, :telefone_celular, :email, :endereco, :numero_endereco, :responsavel_cpf
         * $data->cod_bairro, $data->cod_escolaridade, $data->nome_aluno, 
                    $data->nome_pai, $data->nome_mae, $data->sexo, $data->cpf, $data->telefone_celular, $data->email,
                    $data->endereco, $data->numero_endereco, $data->responsavel_cpf
         */
        //exit(var_dump($query));

        try {
            if (gettype($conexao)!== 'string' and get_class($conexao) == 'PDO') {          
                $insert = $conexao->prepare($query);
                 //exit(var_dump($insert));                 
                $insert->execute($dados);
                    
                exit($insert->debugDumpParams());
            }else{ 
                
                throw new PDOException($conexao);
            }
        }catch(PDOException $e) {
            //exit(print("Linha 29"));
            echo 'ERROR: ' . $e->getMessage();
        }
    }
    public function getUser() {

    }

    public function updateUser($data) {

        $conexao = \Conexao::conectar();
        try {
            if (gettype($conexao)!== 'string' and get_class($conexao) == 'PDO') {
                $update = $conexao->prepare("UPDATE aluno SET nome_aluno = :nome, 
                data_nascimento = :data_nascimento, nome_pai = :nome_pai, nome_mae = :nome_mae, sexo = :sexo,
                cpf = :cpf, telefone_celular = :telefone, email = :email, endereco = :rua,
                numero_endereco = numero_casa, responsavel_cpf = responsavel_cpf WHERE cod_aluno = :id");
                $update->execute(array(
                    'nome' => $data->nome,          'data_nascimento' => $data->data_nascimento,
                    'nome_pai' => $data->nome_pai,  'nome_mae' => $data->nome_mae,
                    'sexo' => $data->sexo,          'cpf' => $data->cpf,
                    'telefone' => $data->telefone,  'email' => $data->email,
                    'rua' => $data->rua,            'numero_casa' => $data->numero_casa,
                    'responsavel_cpf' => $data->responsavel_cpf, 'id' => $data->id));
            }else throw new PDOException($conexao);
        }catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}
ini_set("display_errros", 1);
$o = new \stdClass;
$o->cod_bairro = 2;
$o->cod_escolaridade= 1;
$o->nome_aluno = "teste nome";
$o->data_nascimento = '21/05/2000';
$o->nome_pai = "nome pai";
$o->nome_mae = 'nome mãe';
$o->sexo = "m";
$o->cpf = 123456;
$o->telefone_celular = 719999999;
$o->email = 'meuemail@gmail.com';
$o->endereco = 'Rua colinas das Arvores';
$o->numero_endereco = 15;
$o->responsavel_cpf = 00000000000;
$teste = new UserModel;
$teste->createUser($o);

 