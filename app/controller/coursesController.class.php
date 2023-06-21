<?php 

namespace app\controller;

class CoursesController {

    public function __construct() 
    {
    }


    public static function getAllCourses($conexao) 
    {
        $courses = \app\model\CoursesModel::getAllCoursesModel($conexao);
        return $courses;
    }

}