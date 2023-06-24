<?php
namespace App\controller;

class UserController {

  public static function createUser($conexao,$data) 
  {
    $a = \App\model\UserModel::createUser($conexao,$data);
    var_dump($data);
    $userExist = self::getUser($data);
    require_once __DIR__."/../view/login.php";
  }

  public static function error($data) 
  {
    $error = $data['errcode'];
    require_once __DIR__."/../view/assets/helper/error.php";
  }

  public static function getUser($conexao,$dataUser) 
  {
    $getUser = \App\model\UserModel::getUser($conexao,$dataUser);
    return $getUser;
  }

  public static function updateUser($dataUser) 
  {
    
  }

}
 