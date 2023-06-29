<?php 
namespace App\controller;
use App\model\CoursesModel;

class CoursesController {

    private static $teste = '';
    public function __construct($router) 
    {
        self::$teste = $router;
    }


    public static function getAllCourses() 
    {
        $courses = \App\model\CoursesModel::getAllCoursesModel();
        require_once __DIR__."/../view/courses.php";
    }

    public static function getCourseDays($course) 
    {
        $days = \App\model\CoursesModel::getCourseDaysModel($course);
        return $days;
    }

    public static function getCourseShifts($course, $day) 
    {
        $shifts = \App\model\CoursesModel::getCourseShiftsModel($course, $day);
        return $shifts;
    }

    public static function getCourse($data) {
        $course = strtoupper($data['course']);
        $dataCourse = \App\model\CoursesModel::getCourseModel($course);
        $days = self::getCourseDays($course);
        // if (!sizeof($days)) self::$teste->redirect('/error');
        var_dump($dataCourse);
        $firstDay = $days[0]->nome_dia;
        $shifts = self::getCourseShifts($course, $firstDay);
        require_once __DIR__."/../view/course/course.php";
    }

}