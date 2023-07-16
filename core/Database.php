<?php
namespace Core\conexao;

/**
 * Classe para fazer conexão com o banco de dados
 * @author Lucas Rabelo <lucasrabelo186@gmail.com>
 * @version ${1:1.0.0
 */
use Exception;
class Conexao {
  static $conexao;
/**
 * Função para que abre conexão com o banco de dados
 * @return object mysqli ou @return exception
 */
  public static function conectar() {
    //tenta abrir conexão
    try {  
      self:: $conexao = new \PDO('mysql:host=localhost;dbname=check_list;charset=utf8','root','');
      //retorna conexão
      return self:: $conexao;   
    }catch (\PDOException $e) {
      //retorna o motivo do erro
      self::$conexao = $e->getMessage();
     
    }
    return self :: $conexao;

  }
}
