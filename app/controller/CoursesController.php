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
        $dataCourse = CoursesModel::getCourseModel($course);
        $days = self::getCourseDays($course);
        if (!$_SESSION) self::$teste->redirect('/login');
        if (!sizeof($days)) self::$teste->redirect('/error');
        $src = self::xpathImage($course);
        $firstDay = $days[0]->nome_dia;
        $shifts = self::getCourseShifts($course, $firstDay);

        ob_start();
        require_once __DIR__."/../view/fragments/infosCourse.php";
        $infosCourse = ob_get_clean();

        ob_start();
        require_once __DIR__."/../view/fragments/getPassword.php";
        $fragment = ob_get_clean();

        var_dump($dataCourse);
        require_once __DIR__."/../view/course/course.php";
    }

    public static function xpathImage($course) 
    {
        $getImage = 0;
        if (str_contains($course, "_")) {
            $course = strtolower(explode("_", $course)[0]);
            $getImage = 1;
        }
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load('https://www.istockphoto.com/br/search/2/image?ageofpeople=teenager%2Cchild%2Cadult%2Cyoungadult&phrase='.$course);
        $img = $response->find('html body .DW8dMUa97kDDTC1CKQwe picture img')[$getImage]->src;
        return $img;
    }

}