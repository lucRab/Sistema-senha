<?php
namespace App\controller;
use App\model\ClassesModel;
use App\model\CoursesModel;
use App\model\PasswordModel;

class ClassesController
{
    private static $shift = null;
    private static $age = null;
    private static $course = null;

    public function __construct()
    {
    }

    public static function isCourseExist($course) {
        return sizeof(CoursesModel::getCourseModel($course));
    }

    public static function isValidShift($shift) {
        $shifts = ['MATUTINO', 'VESPERTINO', 'NOTURNO'];
        return in_array($shift, $shifts) ? $shift : false;
    }

    public static function maxQuantPasswords() {
        $dataRequest = json_decode(file_get_contents('php://input'), true);

        $quantPasswords = ClassesModel::maxQuantPasswordsModel(1);
        return sizeof($quantPasswords);
    }

    public static function filterClassesController($data)
    {
        $dataRequest = json_decode(file_get_contents('php://input'), true);

        $course = strtoupper($data['course']);
        $shift = strtoupper($dataRequest['shift']);
        $age = strtoupper($dataRequest['age']);
        $days = strtoupper($dataRequest['days']);
        
        if (!self::isCourseExist($course)) {
            http_response_code(404);
            echo json_encode("Curso inexistente");
            die();
        }

        if (!self::isValidShift($shift)) {
            http_response_code(404);
            echo json_encode("Turno inexistente");
            die();
        }

        if (self::maxQuantPasswords()) {
            http_response_code(404);
            echo json_encode("Já pegou mt senha");
            die();
        }
        
        $infosClass = new \stdClass();
        $infosClass->courseName = $course;
        $infosClass->age = $age;
        $infosClass->shift = $shift;
        $infosClass->days = $days;
        $dataClass = \App\model\ClassesModel::filterClassesModel($infosClass); 

        if (empty($dataClass)) {
            http_response_code(404);
            echo json_encode('Turma inexistente');
            die();
        }

        $dataPassword = \App\model\PasswordModel::passwordOpen($dataClass[0]->cod_turma);

        $cod = new \stdClass;
        $cod->class = $dataClass[0];
        $cod->password = $dataPassword[0];

        echo json_encode($cod);
    }

}