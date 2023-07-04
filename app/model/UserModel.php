<?php
namespace App\model;
use Core\connection\Conexao;
use Core\validations\ValidConnection;
use PDO;
require_once __DIR__."/../../database/sqlClasses.php";

/**
 * Classe para conectar usuario com o banco de dados
 * @author Lucas Rabelo <email> 
 * @version ${3.0:3.0.0}
 */
class UserModel {
    /**
     * Função para criar novo usuario
     * 
     * @param [objct] $data
     * @return int
     * @uses Endpoints::setTokenCadastro
     */
    public static function createUser($data) {
    //Código da função
        //instancia a conexão;
        $conexao = Conexao::conectar();
        //Verifica se ocorreu a conexao;
        if(gettype($conexao) == "object"){
            //parametros para o sql 
            $params = [
                'nome_aluno' => $data->nome_aluno, 
                'data_nascimento' => $data->data_nascimento,          
                'cpf' => $data->cpf,
                'senha_login' => $data->senha
            ];
            //Query sql
            $query = SQL_CREATE_USER();

            $conexao->beginTransaction();
            //executa a query
            $con = ValidConnection::isValidConnection($conexao, $query, $params);
            //recebe o id do usuario inserido no banco de dados
            $id = $conexao->lastInsertId();
            $conexao->commit();
            //verifica se o sql funcionou
            if(gettype($con) == "object"){
                //retorna o id gerado;               
                return (int)$id;
            }else {
                //caso aconteça um erro no sql, retorna o erro; 
                return $con;
            }
        }else {
        //caso aconteça um erro na conexao, retorna o erro;
            return $conexao;  
        }
    }
    /**
     * Função para selecionar os dados do usuario
     * @param [Object] $data
     * @return array
     */
    public static function getUser($conexao, $data) {
        //recebe os dados e coloca em um array para executar a query
        $params = array('id' => $data->id);
        $query = SQL_GET_USER();
        $con = ValidConnection::isValidConnection($conexao, $query, $params);
        return $con;
    }
    /**
     * Função para fazer update do usuario
     *
     * @param [object] $data
     * @return true
     */
    
    public static function updateUser($data) {
        $conexao = Conexao::conectar();
    //Código da função
        //instancia a conexão;
         //recebe os dados e coloca em um array para executar a query
        $params = array(
            'nome' => $data->nome_aluno,          'data_nascimento' => $data->data_nascimento,
            'nome_pai' => $data->nome_pai,  'nome_mae' => $data->nome_mae,
            'sexo' => $data->sexo,          'cpf' => $data->cpf,
            'telefone' => $data->telefone_celular,  'email' => $data->email,
            'rua' => $data->endereco,            'numero_casa' => $data->numero_endereco,
            'responsavel_cpf' => $data->responsavel_cpf, 'id' => $data->id);
         //Query sql
        $query = SQL_UPDATE_USER();
        $con = validConnection::isValidConnection($conexao, $query, $params);
        return $con;
    }
    /**
     * Função*****
     * @param object $data
     * @return array
     */  
    public static function updateAge($data) {
        //Código da função
        //instancia a conexão;
        $conexao = Conexao::conectar();
         //recebe os dados e coloca em um array para executar a query
        $params = $data;
         //Query sql
        $query = SQL_UPDATE_AGE_USER();
        $con = validConnection::isValidConnection($conexao, $query, $params);
        return $con->fetchAll(PDO::FETCH_OBJ);
    }
    /**
     * Função***
     * @param mixed $name
     * @return array
     */
    public static function updatePasswordUser($params) {
        $conexao = Conexao::conectar();
        $query = SQL_UPDATE_PASSWORD_USER();
        $con = ValidConnection::isValidConnection($conexao, $query, $params);
        return $con->fetchAll(PDO::FETCH_OBJ);
    }
    /**
     * Função para senelicionar o usuario pelo cpf
     * @param object $data
     * @return array
     */
    public static function getUserCpf($data) {
        //instancia a conexão;
        $conexao = Conexao::conectar();
        //Verifica se ocorreu a conexao;
        if(gettype($conexao) == "object") {
            //recebe os dados e coloca em um aray para executar a query
            $params = array('cpf' => $data->cpf);
            //query sql
            $query = SQL_GET_USER_CPF();
            //executa o sql
            $con = ValidConnection::isValidConnection($conexao, $query, $params);
            return $con->fetchAll(PDO::FETCH_OBJ);
        }else {
            //caso aconteça um erro na conexao, retorna o erro;
            return $conexao;
        }
    }
}
 