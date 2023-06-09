<?php

namespace App\model;

use Core\connection\Conexao;
use Core\validations\ValidConnection;
use PDO;

require_once __DIR__."/../../database/sqlClasses.php";

class CoursesModel
{
    public function __construct()
    {
    }

    public static function getAllCoursesModel()
    {
        $conexao = Conexao::conectar();
        $condition = null;
        if (!empty($_SESSION['idade'])) {
            $age = $_SESSION['idade'];
            $condition = "AND '{$age}' BETWEEN idade_minima AND idade_maxima";
        }
        $query = SQL_SELECT_COURSES($condition);
        $con = validConnection::isValidConnection($conexao, $query);
        $allCourses = $con->fetchAll(PDO::FETCH_OBJ);
        return $allCourses;
    }

    public static function getCourseDaysModel($course, $condition = null)
    {
        $conexao = Conexao::conectar();
        $query = SQL_AVAILABLE_COURSE_DAYS($condition);
        $params = [
            "course" => $course,
            'idade' => $_SESSION['idade']
        ];
        $con = validConnection::isValidConnection($conexao, $query, $params);
        $dataDays = $con->fetchAll(PDO::FETCH_OBJ);
        return $dataDays;
    }

    public static function getCourseShiftsModel($course, $day)
    {
        $conexao = Conexao::conectar();
        $query = SQL_AVAILABLE_SHIFT_DAYS();
        $params = [
            "course" => $course,
            "dayName" => $day,
            'idade' => $_SESSION['idade']
        ];
        $con = validConnection::isValidConnection($conexao, $query, $params);
        $dataShifts = $con->fetchAll(PDO::FETCH_OBJ);
        return $dataShifts;
    }

    public static function getCourseModel($course)
    {
        $conexao = Conexao::conectar();
        $query = SQL_SELECT_COURSE();
        $params = [
            "nome_curso" => $course,
            "idade" => $_SESSION['idade']
        ];
        $con = validConnection::isValidConnection($conexao, $query, $params);
        $dataCourse = $con->fetchAll(PDO::FETCH_OBJ);
        return $dataCourse;
    }

}
