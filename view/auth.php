<?php
    require("../../vendor/autoload.php");

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__,3));
    $dotenv->load();

    $authorization = $_POST['verificar'];

    $token = str_replace('Bearer ','',$authorization);
    $h = new stdClass;

    try{
        $decoded = JWT ::decode($token,new Key($_ENV['KEY'],'HS512'));
        echo json_encode($decoded);
    }catch(Throwable $e){
        if($e->getMessage()=== 'Expired token') {
            //http_response_code(401);
            echo json_encode('Expired token');
        }
    }

//echo json_encode('aqui');