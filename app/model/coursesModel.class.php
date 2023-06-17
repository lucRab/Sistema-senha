<?php
  require_once "classesModel.class.php";
  class CoursesModel {

    private static $sql = null;

    public function __construct() {
      
    }


    public static function getAllCourses($conexao) {
      $select = $conexao->prepare("SELECT * FROM curso");
      if ($select->execute()) return true;  
    }

    public static function getDataCourse($course) {
      $classes = new ClassesModel($course);
    }

  }