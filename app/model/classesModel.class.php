<?php 

  class ClassesModel {

    private static $idadeMinima = 1;
    private static $idadeMaxima = 99;
    public function __construct(){}

    public function filterClasses($conexao) {
     
    }

    public static function filterByAge($conexao, $final, $inicial) {
      $final && self::$idadeMaxima = $final;
      $inicial && self::$idadeMinima = $inicial;
      $idade = 10;

      $select = $conexao->prepare('SELECT * FROM turma WHERE :idade
      BETWEEN :idade_minima 
      AND :idade_maxima');

      if ($select->execute(['idade' => $idade, 'idade_minima' => self::$idadeMinima, 'idade_maxima' => self::$idadeMaxima])) {
        return $select;
      }; 
    }

  }