<?php 
namespace App\controller;
use App\model\CoursesModel;

class CoursesController {

    private static $router = '';
    public function __construct($router) 
    {
        self::$router = $router;
    }


    public static function getAllCourses() 
    {
        $courses = \App\model\CoursesModel::getAllCoursesModel();
        ob_start();
        require_once __DIR__."/../view/fragments/allCourses.php";
        $allCourses = ob_get_clean();
        require_once __DIR__."/../view/courses.php";
    }

    public static function getCourseDays($course) {
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
        if (empty($_SESSION)) self::$router->redirect('/login');
        if (empty($dataCourse)) self::$router->redirect('/error');
        //Adicionar tela de idade errada
        if (!sizeof($days)) self::$router->redirect('/historico');
        
        $src = self::xpathImage($course);
        $firstDay = $days[0]->nome_dia;
        $shifts = self::getCourseShifts($course, $firstDay);

        ob_start();
        require_once __DIR__."/../view/fragments/infosCourse.php";
        $infosCourse = ob_get_clean();

        ob_start();
        require_once __DIR__."/../view/fragments/getPassword.php";
        $fragment = ob_get_clean();

        require_once __DIR__."/../view/course/course.php";
    }

    public static function xpathImage($course) 
    {
        $getImage = 0;
        if (str_contains($course, "_")) {
            $course = strtolower(str_replace("_", "%20", $course));
            $getImage = 1;
        }
        $httpClient = new \simplehtmldom\HtmlWeb();
        $response = $httpClient->load("https://www.istockphoto.com/br/search/2/image?ageofpeople=teenager%2Cyoungadult%2Cchild%2Cadult&numberofpeople=two%2Cgroup&orientations=horizontal&phrase=$course&sort=best");
        $img = $response->find('html body .DW8dMUa97kDDTC1CKQwe picture img')[0]->src;
        return $img ?: 'https://destaque1.com/wp-content/uploads/2021/08/Cidade-do-Saber-espelhado_Foto-HyagoCerqueira.jpeg';
    }

}