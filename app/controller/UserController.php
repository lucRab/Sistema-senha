<?php
namespace App\controller;
use App\model\UserModel;
/**
 * Classe para receber as rotas do usuario
 * @author Equipe Maquina
 * @version ${6:6.0.0
 */
class UserController {
  /**
   * Função construct
   */
  public function __construct($router) {
    $this->router = $router;
  }
/**
 * Função para exubir a tela de registro do usuario
 * 
 */
  public function createUser($data) 
  {
    session_destroy();
    require_once __DIR__."/../view/register.php";
  }
  /**
   * Função para erro
   */
  public static function error($data) 
  {
    $error = $data['errcode'];
    require_once __DIR__."/../view/assets/helper/error.php";
  }
/**
 * Função para exibir a tela de login do usuario
 */
  public static function userLogin($dataUser) 
  {
    session_destroy();
    require_once __DIR__."/../view/login.php";
  }
/**
 * 
 */
  public static function getUser() {

  }
/**
 * Função para exibir a tela de atualizar a senha do usuario
 */
  public static function updateSenha($dataUser) 
  {
    session_destroy();
    require_once __DIR__."/../view/atualizarSenha.php";
  }

}
 