<?php

namespace App\controller;

use App\model\UserModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class UserController
{
    public function __construct($router)
    {
        $this->router = $router;
    }

    public function createUser($data)
    {
        session_destroy();
        require_once __DIR__."/../view/register.php";
    }

    public static function error($data)
    {
        $error = $data['errcode'];
        require_once __DIR__."/../view/assets/helper/error.php";
    }

    public static function userLogin($dataUser)
    {
        session_destroy();
        require_once __DIR__."/../view/login.php";
    }

    public static function getUser()
    {

    }

    public static function getEmail($cpfUser)
    {
        $cpfUser = preg_replace('/[^0-9]/', '', $cpfUser);
        $email = UserModel::getUserEmail($cpfUser);
        if (empty($email)) {
            http_response_code(404);
            echo json_encode($cpfUser);
            die();
        };
        return $email[0]->email;
    }

    public static function updateEmail()
    {
        $dataRequest = json_decode(file_get_contents('php://input'), true);
        $newEmail = $dataRequest['email'];
        $cod_aluno = $dataRequest['cod_aluno'];
        $update = UserModel::updateEmailModel($cod_aluno, $newEmail);
        try {
            $_SESSION['email'] = $newEmail;
        } catch (\Throwable $th) {
            echo json_encode('Deu erro');
        }
        echo json_encode('Enviado com sucesso');
        die();
    }

    public static function updatePassword()
    {
        $dataRequest = json_decode(file_get_contents('php://input'), true);
        $cpfUser = $dataRequest['cpf'];
        $code = $dataRequest['code'];
        $mailUser = self::getEmail($cpfUser);
        if ($mailUser) {
            $message = self::sendEmail($mailUser, $code);
            echo json_encode($message);
            die();
        }
    }

    public static function updateUserPassword()
    {
        $dataRequest = json_decode(file_get_contents('php://input'), true);
        $cpfUser = preg_replace('/[^0-9]/', '', $dataRequest['cpf']);
        
        $newPassword = $dataRequest['newPassword'];
        $mailUser = self::getEmail($cpfUser);

        $dataUser = new \stdClass();
        $dataUser->cpf = $cpfUser;
        $dataUser->newPassword = $newPassword;
        $dataUser->email = $mailUser;
        $update = UserModel::updateUserPasswordModel($dataUser);
        echo json_encode($update);
    }

    public static function sendEmail($mailUser, $code)
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'teste123keslley@gmail.com';                     //SMTP username
            $mail->Password   = 'mvfukoknxsrjqgul';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('teste123keslley@gmail.com', 'Mailer');
            $mail->addAddress($mailUser);     //Add a recipient    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Sistema-Senha - Atualizacao de Senha';
            $mail->Body    = 'Código para alterar senha: '.$code;
            $mail->AltBody = 'Código para alterar senha: '.$code;

            $mail->send();
            $user = new \stdClass();
            $user->message = 'Message has been sent';
            $user->email = $mailUser;
            return $user;
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

}
