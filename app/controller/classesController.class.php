<?php

namespace app\controller;

class ClassesController
{
    private static $shift = null;
    private static $age = null;
    private static $course = null;

    public function __construct()
    {
    }

    public static function setCourse($courseName) {
        self::$course = $courseName;
    }

    public static function filterClassesController($conexao)
    {
        if (!self::$age) {
            return 'Digite sua idade';
        } elseif (!self::$course) {
            return 'Escolha um curso';
        }

        $infosClass = new \stdClass();
        $infosClass->courseName = self::$course;
        $infosClass->age = self::$age;
        $infosClass->shift = self::$shift;
        $dataClass = \app\model\ClassesModel::filterClassesModel($conexao, $infosClass);
        return $dataClass;
    }

    public static function filterByShift($shiftValue): void
    {
        self::$shift = $shiftValue;
    }

    public static function filterByAge($ageValue): void
    {
        self::$age = $ageValue;
    }

}