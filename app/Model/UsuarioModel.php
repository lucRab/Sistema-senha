<?php
namespace App\model;

use Core\conexao\Conexao;
use PDO;
require_once "./core/Database.php";
/**
 *  Classse model responsavel pelos dados do usuario
 * @author Lucas Rabelo <lucasrabelo186@gmail.com>
 * @version ${4:4.0.0
 */
/** Requerimento do código para fazer conexão com o banco de dados */

class UsuarioModel {
    /**
     * Função para inserir dados o usuario no banco de dados
     *@param string $nome - nome do usuario
     *@param string $senha - senha do usuario
     *@param string $email - email do usuario
     *@param string $username - nickname do usuario
     * @return int ou @return Exception
     */
   public static function createUser($data) {
   //Código do método
      //Executa um metodo da classe Conexao
      $conexao = Conexao::conectar();
      //Verifica se a conexão retorna um obejo mysqli
      if(gettype($conexao) == "object") {
         //parametros para execução da query
         $param = [ 'nome' => $data->nome, 'senha' => $data->senha,
         'email' => $data->email, 'username' => $data->username];
         //SQl para inserir no banco de dados
            $createUser = $conexao->prepare("INSERT INTO usuario (name, senha, email, username) VALUES (:nome, :senha, :email, :username)");
            try {
               //Tenta executar o sql;
               $createUser->execute($param);
               //Captura o id gerado no insert      
               $id = $conexao->lastInsertId();
               //retorna o id gerado
               return $id;
               
            }catch(\PDOException $e) {
               //retorna o erro
               return $e->getMessage();
            }
      }else {     
         //retorna a conexao como erro de conexao 
         return $conexao;
      }   
   }
    /**
     * Função para deletar dados o usuario no banco de dados
     *@param int $id - id do usuario
     * @return true ou @return Exception
     */
   public static function deleteUsuario($data) {
      //Código do método
      //Executa um metodo da classe Conexao
      $conexao = Conexao::conectar();
      //Verifica se a conexão retorna um obejo mysqli
      if (gettype($conexao) == "object") {
         //parametros para execução da query
         $param = [ 'id' => $data->id];
         //SQl para delete no banco de dados
         $deleteUser = $conexao->prepare("DELETE FROM usuario WHERE idusuario = :id");
         try {
            //Tenta executar o sql;
            $deleteUser->execute($param);
            return $deleteUser;
         }catch(\PDOException $e) {
           //retorna o erro
            return $e->getMessage();
         }
      }else {
         //retorna a conexao como erro de conexao 
         return $conexao;
      }

   }
    /**
     * Função para fazer o update dados o usuario no banco de dados
     *@param string $nome - nome do usuario
     *@param string $senha - senha do usuario
     *@param string $email - email do usuario
     *@param string $username - nickname do usuario
     *@param int $id - id do usuario
     * @return true ou @return Exception
     */
   public static function updateUsuario($data) {
      //Código do método
      //Executa um metodo da classe Conexao
      $conexao = Conexao::conectar();
      //Verifica se a conexão retorna um obejo mysqli
      if(gettype($conexao) == "object"){
         //parametros para execução da query
         $param = ['nome' => $data->nome, 'senha' => $data->senha,
         'email' => $data->email, 'username' => $data->username, 'id' => $data->id];
         //SQl para update no banco de dados
         $updateUser = $conexao->prepare("UPDATE usuario SET name=:nome, senha=:senha, email=:email,
          username=:username  WHERE idusuario=:id");
         try {
            //Tenta executar o sql;
            $updateUser->execute($param);
            return $updateUser;
         }catch(\PDOException $e) {
            //retorna o erro
            return $e->getMessage();
         }
      }else {
         //retorna a conexao como erro de conexao 
         return $conexao;
      }
   }
   /**
   * Função para trazer os dados o usuario do banco de dados
   *@param [stdclass] $data
   * @return object ou @return Exception
   */
    public static function getAll($data) {
      //Código do método
      //Executa um metodo da classe Conexao
      $conexao = Conexao::conectar();
      //Verifica se a conexão retorna um obejo mysqli
      if(gettype($conexao) == "object"){
         //parametros para execução da query
         $param = ['id' => $data->id];
         //SQl para select no banco de dados
         $selectAll = $conexao->prepare("SELECT * FROM usuario WHERE idusuario = :id");
         try {
            //Tenta executar o sql;
            $selectAll->execute($param);
            return $selectAll;
         }catch(\PDOException $e) {
            //retorna o erro
            return $e->getMessage();
         }
      
      }else {
         //retorna a conexao como erro de conexao 
         return $conexao;
      }
   }
   /**
    * Função para fazer o selct pelo username
    *
    * @param [stdclass] $data
    * @return object ou @return Exception
    */
   public static function getUsername($data) {
    //Código do método
      //Executa um metodo da classe Conexao
      $conexao = Conexao::conectar();
      //Verifica se a conexão retorna um obejo mysqli
      if(gettype($conexao) == "object"){
         //parametros para execução da query
         $param = ['username' => $data->username];
         //SQl para select no banco de dados
         $selectAll = $conexao->prepare("SELECT * FROM usuario WHERE username = :username");
         try {
            //Tenta executar o sql;
            $selectAll->execute($param);
            return $selectAll;
         }catch(\PDOException $e) {
            //retorna o erro
            return $e->getMessage();
         }
      }else {
         //retorna a conexao como erro de conexao 
         return $conexao;
      }
   }
}