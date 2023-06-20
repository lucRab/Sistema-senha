<?php
namespace app\model;
/**
 * Classe para conectar usuario com o banco de dados
 * @author Lucas Rabelo <email> 
 * @version ${3.0:3.0.0}
 */
require_once("../../core/conexao.php");
use PDOException;
class UserModel {
    /**
     * Função para criar novo usuario
     * 
     * @param [objct] $data
     * @return true
     */
    public function createUser($data) {
    //Código da função
        //instancia a conexão;
        $conexao = \Conexao::conectar();
        //recebe os dados e coloca em um array para executar a query
        $dados = array(         
            'nome_aluno' => $data->nome_aluno, 'data_nascimento' => $data->data_nascimento,          
            'nome_pai' => $data->nome_pai,   'nome_mae' => $data->nome_mae,
            'sexo' => $data->sexo,           'cpf' => $data->cpf,
            'telefone_celular' => $data->telefone_celular,   'email' => $data->email,
            'endereco' => $data->endereco,             'numero_endereco' => $data->numero_endereco,
            'responsavel_cpf' => $data->responsavel_cpf);
        //Query sql
        $query = "INSERT INTO aluno(
                    nome_aluno, data_nascimento, nome_pai, nome_mae, sexo, cpf, telefone_celular, email,
                    endereco, numero_endereco, responsavel_cpf)               
                    VALUES( :nome_aluno, :data_nascimento, :nome_pai, :nome_mae,
        :sexo, :cpf, :telefone_celular, :email, :endereco, :numero_endereco, :responsavel_cpf)";        

        try {
            //verifica se a conexão é to tipo string e verificar se a classe é PDO;
            if (gettype($conexao)!== 'string' and get_class($conexao) == 'PDO') {          
                $insert = $conexao->prepare($query);                 
                $insert->execute($dados);
                return true;
            }else{ 
                //abre uma execeção caso a verificação de falso;
                throw new PDOException($conexao);
            }
        }catch(PDOException $e) {
            //retorna a exceção;
            return 'ERROR: ' . $e->getMessage();
        }
    }
    /**
     * Função para selecionar os dados do usuario
     * @param [Object] $data
     * @return array
     */
    public function getAllUser($data) {
        $conexao = \Conexao::conectar();
        //recebe os dados e coloca em um array para executar a query
        $dados = array( 'id'=> $data->id);
        try{
            //verifica se a conexão é to tipo string e verificar se a classe é PDO;
            if (gettype($conexao)!== 'string' and get_class($conexao) == 'PDO') { 
                //Query sql
                $consulta = $conexao->prepare("SELECT * FROM aluno Where cod_aluno = :id;");
                $consulta->execute($dados);
                $linha = $consulta->fetch($conexao::FETCH_ASSOC);
                //retorna todas as colunas
                return $linha;
            }else{ 
                //abre uma execeção caso a verificação de falso;
                throw new PDOException($conexao);
            }
        }catch(PDOException $e){
            return 'ERROR: ' . $e->getMessage();
        }
    }
    /**
     * Função para fazer update do usuario
     *
     * @param [object] $data
     * @return true
     */
    public function updateUser($data) {
    //Código da função
        //instancia a conexão;
        $conexao = \Conexao::conectar();
         //recebe os dados e coloca em um array para executar a query
        $dados = array(
            'nome' => $data->nome_aluno,          'data_nascimento' => $data->data_nascimento,
            'nome_pai' => $data->nome_pai,  'nome_mae' => $data->nome_mae,
            'sexo' => $data->sexo,          'cpf' => $data->cpf,
            'telefone' => $data->telefone_celular,  'email' => $data->email,
            'rua' => $data->endereco,            'numero_casa' => $data->numero_endereco,
            'responsavel_cpf' => $data->responsavel_cpf, 'id' => $data->id);
         //Query sql
        $query ="UPDATE aluno SET nome_aluno = :nome, 
                data_nascimento = :data_nascimento, nome_pai = :nome_pai, nome_mae = :nome_mae, sexo = :sexo,
                cpf = :cpf, telefone_celular = :telefone, email = :email, endereco = :rua,
                numero_endereco = :numero_casa, responsavel_cpf = :responsavel_cpf WHERE cod_aluno = :id";

        try {
             //verifica se a conexão é to tipo string e verificar se a classe é PDO;
            if (gettype($conexao)!== 'string' and get_class($conexao) == 'PDO') {
                $update = $conexao->prepare($query);
                $update->execute($dados);
                return true;
            }else{
             //abre uma execeção caso a verificação de falso;
                throw new PDOException($conexao);
            }
        }catch(PDOException $e) {
            //retorna a exceção;
            return 'ERROR: ' . $e->getMessage();
        }
    }
}
 