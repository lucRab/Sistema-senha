<?php 
namespace App\controller;
use App\model\CoursesModel;

class CoursesController {

    public function __construct() 
    {
    }


    public static function getAllCourses() 
    {
        $courses = \App\model\CoursesModel::getAllCoursesModel();
        require_once __DIR__."/../view/courses.php";
    }

    public static function getCourse($data) {
        $course = strtoupper($data['course']);
        $dataCourse = \App\model\CoursesModel::getCourseModel($course);
        require_once __DIR__."/../view/course/course.php";
    }

}