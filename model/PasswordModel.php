<?php
namespace App\model;
use Core\connection\Conexao;
use Core\validations\ValidConnection;
use PDO;
require_once __DIR__."/../../database/sqlClasses.php";

/**
 * Classe para o acesso das senha no banco de dados
 * @author Lucas Rabelo
 * @version ${2:2.0.0
 */

class PasswordModel
{
    /**
     * Função para selecionar senhas disponiveis
     *
     * @param [Object] $conexao
     * @param [Int] $cod_turma
     * @return object
     */
    public static function passwordOpen($cod_turma) {
        //Código da função 
        //recebe o codigo da turma e coloca ele na variavei $params
        $conexao = Conexao::conectar();
        $params = array('cod_turma' => $cod_turma);
        //query sql
        $query = 'SELECT * FROM senha Where cod_turma = :cod_turma and situacao = "DISPONIVEL" LIMIT 1';
        //envia a conexão a query e os parametros para serem validadas

        // Inicia uma transação
        $conexao->beginTransaction();
        $con = validConnection::isValidConnection($conexao, $query, $params);
        // Finaliza a transação
        $conexao->commit();
        $dataPassword = $con->fetchAll(PDO::FETCH_OBJ);
        //retorna o resultado
        return $dataPassword;
    }
    /**
     * Função par aselecionar as senhas do usuario
     *
     * @param [object] $conexao
     * @param [object] $data
     * @return object
     */
    public static function userPassword($data) {
    //Código da função
        //recebe o codigo do aluno e coloca ele na variavei $params
        $conexao = Conexao::conectar();
        $params = array('cod_aluno' => $data->cod_aluno );
        //query sql
        $query = 'SELECT * FROM senha Where cod_aluno = :cod_aluno';
        //envia a conexão a query e os parametros para serem validadas
        $con = validConnection::isValidConnection($conexao, $query, $params);
        //retorna o resultado
        return $con;

    }
    /**
     * Função para alterar a senha no banco de dados
     *
     * @param [object] $conexao
     * @param [object] $data
     * @return object
     */
    public static function alterarPassword($data) {
    //Código da função
        //recebe os dados e coloca eles na variavei $params
        $conexao = Conexao::conectar();
        $params = array(
            'cod_aluno' => $data->cod_aluno, 'situacao' => $data->situacao, 'cod_senha' => $data->cod_senha
        );
        //query sql
        $query ="UPDATE senha SET cod_aluno = :cod_aluno,situacao = :situacao WHERE cod_senha = :cod_senha";
        //envia a conexão a query e os parametros para serem validadas
        $con = validConnection::isValidConnection($conexao, $query, $params);
        //retorna o resultado
        return $con;
    }

}