<?php

require_once "app/model/UsuarioModel.php";
require_once "app/model/ChecklistModel.php";
use App\model\UsuarioModel;
use App\model\ChecklistModel;

$data = new stdClass;
$data->nome = "unameTeste";
$data->senha = "senhateste";
$data->email = "teste@gmail.com";
$data->username = "teste";
$data->descricao = "updescrição teste";
$data->id = 6;
$data->status = false;

//$teste = ChecklistModel::createChecklist($data);
//$teste = UsuarioModel::createUser($data);
//$teste = ChecklistModel::setItem($data);
//$teste = ChecklistModel::deleteChecklist($data);
//$t = UsuarioModel::getUsername($data);
//$t = UsuarioModel::getAll($data);
//$t = ChecklistModel::getAll($data);
//$teste = $t->fetchALL(PDO::FETCH_OBJ);
//$teste = ChecklistModel::updateItem($data);
$teste = ChecklistModel::deleteItem($data);
var_dump($teste);