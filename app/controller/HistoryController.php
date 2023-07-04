<?php
namespace App\controller;
use App\model\HistoryModel;
use Dompdf\Dompdf;
use Dompdf\Options;
  

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
        $options = new Options();
        $options->setChroot(__DIR__);

        $dompdf = new Dompdf($options);

        ob_start();
        require_once __DIR__."/../view/download.php";     

        $dompdf->loadHtml(ob_get_clean());

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

      // Mostrar conteudo na tela
        header('Content-type: application/pdf');
        echo $dompdf->output();

    }

}