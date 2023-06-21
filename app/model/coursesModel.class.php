<?php

namespace app\model;

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
        $classes = new \app\controller\ClassesController($course);
    }

}