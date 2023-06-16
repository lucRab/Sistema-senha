<?php 
  require_once "../database/sqlClasses.php";

  class ClassesModel {

    private static $shift = null;
    private static $age = null;
    private static $course = null;

    public function __construct($courseValue) {
      self::$course = $courseValue;
    }

    public static function filterClasses($conexao) {
      if (!self::$age) {
        return 'Digite sua idade';
      } else if (self::$course) {
        return 'Escolha um curso';
      }
      
      $conditions = ' AND :idade BETWEEN idade_minima AND idade_maxima'; 
      
      if (!empty($shift)) {
        $conditions .= ' AND turno = :turno';
        $params['turno'] = self::$shift;
      }
      
      $params = ['idade' => self::$age];
      
      $sql = SQL_FILTER_CLASSES($conditions);
      $select = $conexao->prepare($sql);
      $select->execute($params);
      while($row = $select->fetch(PDO::FETCH_OBJ)) {
        print_r($row);
      }
    }

    public static function filterByShift($shiftValue) {
      self::$shift = $shiftValue;
    }

    public static function filterByAge($ageValue) {
      self::$age = $ageValue;
    }

  }