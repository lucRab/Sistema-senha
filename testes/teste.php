<?php 

require_once "core/conexao.php";

$teste = new Conexao;
$conexao = $teste::conectar();

try {
    if ($conexao instanceof PDO) {
      $data = $conexao->query('SELECT * FROM solicitacao');
      while($row = $data->fetch(PDO::FETCH_OBJ)) {
        print_r($row);
      }
    } else throw new PDOException($conexao);
  } catch(PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
  }