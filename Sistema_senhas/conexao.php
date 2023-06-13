<?php
try {
  $conexao = new PDO('mysql:host=localhost;dbname=atende',"root","");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "conexão feita";
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

?>