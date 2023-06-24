<?php
require("../../vendor/autoload.php");

use Firebase\JWT\JWT;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Authorization, Content-Type, x-xsrf-token, x_csrftoken, Cache-Control, X-Requested-With');

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__,3));
$dotenv->load();

$authorization = $_SERVER["HTTP_AUTHORIZATION"];
 var_dump($_SERVER);

echo json_encode($authorization);