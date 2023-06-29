<?php
namespace App\controller;
use App\model\UserModel;

class UserController {
 
  public function __construct($router) {
    $this->router = $router;
  }
  
  public function createUser($data) 
  {
    require_once __DIR__."/../view/register.php";
  }

  public static function error($data) 
  {
    $error = $data['errcode'];
    require_once __DIR__."/../view/assets/helper/error.php";
  }

  public static function userLogin($dataUser) 
  {
    require_once __DIR__."/../view/login.php";
  }

  public static function getUser() {

  }

  public static function updateUser($dataUser) 
  {
    
  }

}
 