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
     * @return true
     */
    public static function createUser($data) {
        $conexao = Conexao::conectar();

        $params = [       
            'nome_aluno' => $data->nome_aluno, 
            'data_nascimento' => $data->datanascimento,          
            'cpf' => $data->cpf,
            'senha_login' => $data->senha
        ];
     
        $query = SQL_CREATE_USER();           
        $conexao->beginTransaction();
        $con = ValidConnection::isValidConnection($conexao, $query, $params);
        $id = $conexao->lastInsertId();
        $conexao->commit();
        return $id;
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
        $con = \validConnection::isValidConnection($conexao, $query, $params);
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

    public static function updateAge($data) {
        $conexao = Conexao::conectar();
        //Código da função
        //instancia a conexão;
         //recebe os dados e coloca em um array para executar a query
        $params = $data;
         //Query sql
        $query = SQL_UPDATE_AGE_USER();
        $con = validConnection::isValidConnection($conexao, $query, $params);
        return $con->fetchAll(PDO::FETCH_OBJ);
    }

    public static function updatePasswordUser($params) {
        $conexao = Conexao::conectar();
        $query = SQL_UPDATE_PASSWORD_USER();
        $con = ValidConnection::isValidConnection($conexao, $query, $params);
        return $con->fetchAll(PDO::FETCH_OBJ);
    }
}
 