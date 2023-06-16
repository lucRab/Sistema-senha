<?php 
class Conexao {
  static $conn;

  static function conectar() {
    if (!isset(self::$conn)) {
      try {
        self::$conn = new PDO('mysql:host=localhost;dbname=atende;charset=utf8', 'root', '');
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
         self::$conn = $e->getMessage();
      } finally {
        return self::$conn;
      }
    }   

  }
}