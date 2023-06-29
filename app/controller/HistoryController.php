<?php
namespace App\controller;
use App\model\HistoryModel;

class HistoryController
{
    public static function getPasswords()
    {
        $cod_aluno = 1;
        $allPasswords = HistoryModel::getPasswordsModel();
        require_once __DIR__."/../view/historyPasswords.php";     
    }


    public static function deletePassword()
    {
        $dataRequest = json_decode(file_get_contents('php://input'), true);
        $cod_senha = 1;
        $deletePassword = HistoryModel::deletePasswordModel();
        echo json_encode($deletePassword);
    }


    public static function downloadPassword()
    {

    }

}