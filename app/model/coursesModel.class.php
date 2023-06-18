<?php

  class CoursesModel {

    public function __construct(){}


    public static function getAllCourses($conexao) {
      $select = $conexao->prepare("SELECT * FROM curso");
      if ($select->execute()) return true;  
    }

  }