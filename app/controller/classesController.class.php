<?php

namespace app\controller;

class ClassesController
{
    private static $shift = null;
    private static $age = null;
    private static $course = null;

    public function __construct($courseValue)
    {
        self::$course = $courseValue;
    }

    public static function filterClassesController($conexao)
    {
        if (!self::$age) {
            return 'Digite sua idade';
        } elseif (self::$course) {
            return 'Escolha um curso';
        }

        $infosClass = new \stdClass();
        $infosClass->courseName = self::$course;
        $infosClass->age = self::$age;
        $infosClass->shift = self::$shift;

        $dataClass = \app\model\ClassesModel::filterClassesModel($conexao, $infosClass);
    }

    public static function filterByShift($shiftValue)
    {
        self::$shift = $shiftValue;
    }

    public static function filterByAge($ageValue)
    {
        self::$age = $ageValue;
    }

}