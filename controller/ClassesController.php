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

    public static function filterClassesController($data)
    {
        $dataRequest = json_decode(file_get_contents('php://input'), true);

        $course = strtoupper($data['course']);
        $shift = strtoupper($data['shift']) ?: null;
        
        if (!self::isCourseExist($course)) {
            return 'Curso inexistente';
        }
        if ($shift && !self::isValidShift($shift)) {
            return 'Turno inexistente';
        }
        
        $infosClass = new \stdClass();
        $infosClass->courseName = $course;
        $infosClass->age = '10';
        $infosClass->shift = $shift;
        $dataClass = \App\model\ClassesModel::filterClassesModel($infosClass); 
        if (empty($dataClass)) {
            http_response_code(404);
            echo json_encode("Não há mais turmas");
            die();
        }

        $dataPassword = \App\model\PasswordModel::passwordOpen($dataClass[0]->cod_turma);

        $cod = new \stdClass;
        $cod->class = $dataClass[0];
        $cod->password = $dataPassword[0];

        echo json_encode($cod);
    }

}