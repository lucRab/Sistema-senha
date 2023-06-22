<?php

namespace App\model;

class CoursesModel
{
    public function __construct()
    {
    }


    public static function getAllCoursesModel($conexao)
    {
        $query = SQL_SELECT_COURSES();
        $con = \validConnection::isValidConnection($conexao, $query);
        return $con;
    }

    public static function getDataCourseModel($course)
    {
        $classes = new \App\controller\ClassesController($course);
    }

}