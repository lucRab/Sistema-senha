<?php
namespace app\model;
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
    public static function createUser($conexao, $data) {
    //Código da função
        //instancia a conexão;
        //recebe os dados e coloca em um array para executar a query
        $params = array(         
            'nome_aluno' => $data->nome_aluno, 'data_nascimento' => $data->data_nascimento,          
            'nome_pai' => $data->nome_pai,   'nome_mae' => $data->nome_mae,
            'sexo' => $data->sexo,           'cpf' => $data->cpf,
            'telefone_celular' => $data->telefone_celular,   'email' => $data->email,
            'endereco' => $data->endereco,             'numero_endereco' => $data->numero_endereco,
            'responsavel_cpf' => $data->responsavel_cpf);
        //Query sql
        $query = SQL_CREATE_USER();        
        $con = \validConnection::isValidConnection($conexao, $query, $params);
        return $con;
    }
    /**
     * Função para selecionar os dados do usuario
     * @param [Object] $data
     * @return array
     */
    public static function getAllUser($conexao, $data) {
        //recebe os dados e coloca em um array para executar a query
        $params = array( 'id'=> $data->id);
        $query = SQL_GET_ALL_USER();
        $con = \validConnection::isValidConnection($conexao, $query, $params);
        return $con;
    }
    /**
     * Função para fazer update do usuario
     *
     * @param [object] $data
     * @return true
     */
    public static function updateUser($conexao, $data) {
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
        $con = \validConnection::isValidConnection($conexao, $query, $params);
        return $con;
    }
}
 