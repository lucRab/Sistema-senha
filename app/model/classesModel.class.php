<?php

namespace app\model;

require_once "../core/validations/validConnection.class.php";

class ClassesModel
{
    public function __construct()
    {
    }

    public static function filterClassesModel($conexao, $infosClass)
    {
        $course = $infosClass->courseName;
        $age = $infosClass->age;
        $shift = $infosClass->shift;

        $conditions = ' AND :idade BETWEEN idade_minima AND idade_maxima';

        $params = ['idade' => $age];

        if (!empty($shift)) {
            $conditions .= ' AND turno = :turno';
            $params['turno'] = $shift;
        }

        $sql = SQL_FILTER_CLASSES($course, $conditions);
        $teste = \validConnection::isValidConnection($conexao, $sql, $params);
    }

}