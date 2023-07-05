<?php
namespace App\controller;
use App\model\HistoryModel;

class HistoryController
{
    public static function getPasswords()
    {
        $cod_aluno = $_SESSION['id_usuario'];
        $allPasswords = HistoryModel::getPasswordsModel($cod_aluno);
        var_dump($allPasswords);
        require_once __DIR__."/../view/historyPasswords.php";     
    }


    public static function deletePassword()
    {
        $dataRequest = json_decode(file_get_contents('php://input'), true);
        $cod_aluno = $_SESSION['id_usuario'];
        $cod_senha = 1;
        $deletePassword = HistoryModel::deletePasswordModel($cod_aluno);
        echo json_encode($deletePassword);
    }


    public static function downloadPassword()
    {

    }

}