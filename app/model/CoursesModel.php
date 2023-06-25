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
        $query = SQL_SELECT_COURSES();
        $con = validConnection::isValidConnection($conexao, $query);
        $allCourses = $con->fetchAll(PDO::FETCH_OBJ);
        return $allCourses;
    }

    public static function getCourseModel($course) {
        $conexao = Conexao::conectar();
        $query = SQL_SELECT_COURSE();
        $params = [
            "nome_curso" => $course
        ];
        $con = validConnection::isValidConnection($conexao, $query, $params);
        $dataCourse = $con->fetchAll(PDO::FETCH_OBJ);
        return $dataCourse;
    }

}