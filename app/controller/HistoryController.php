<?php

namespace App\controller;

use App\model\HistoryModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class HistoryController
{
    private static $router;

    public function __construct($router)
    {
        self::$router = $router;
    }

    public static function getPasswords()
    {
        $cod_aluno = $_SESSION['id_usuario'];
        $allPasswords = HistoryModel::getPasswordsModel($cod_aluno);
        require_once __DIR__."/../view/historyPasswords.php";
    }


    public static function deletePassword()
    {
        $dataRequest = json_decode(file_get_contents('php://input'), true);
        $cod_aluno = $_SESSION['id_usuario'];
        $cod_senha = $dataRequest['cod_senha'];
        $deletePassword = HistoryModel::deletePasswordModel($cod_aluno, $cod_senha);
        echo json_encode([$cod_aluno, $cod_senha]);
    }


    public static function downloadPassword($data)
    {
        $password = $data['autenticacao'];

        $infosPassword = HistoryModel::downloadPasswordModel($password);
        if (empty($infosPassword)) {
            self::$router->redirect('/error');
        }

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
