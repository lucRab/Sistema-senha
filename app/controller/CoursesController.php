<?php 

namespace App\controller;

class CoursesController {

    public function __construct() 
    {
    }


    public static function getAllCourses($conexao) 
    {
        $courses = \App\model\CoursesModel::getAllCoursesModel($conexao);
        return $courses;
    }

}