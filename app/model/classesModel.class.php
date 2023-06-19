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
        $course = $infosClass->course;
        $age = $infosClass->age;
        $shift = $infosClass->shift;

        $conditions = ' AND :idade BETWEEN idade_minima AND idade_maxima';

        $params = ['idade' => $age];

        if (!empty($shift)) {
            $conditions .= ' AND turno = :turno';
            $params['turno'] = $shift;
        }

        $sql = SQL_FILTER_CLASSES($conditions);
        $teste = \validConnection::isValidConnection($conexao, $sql, $params);
        while($row = $teste->fetch(\PDO::FETCH_OBJ)) {
            print_r($row);
        }
    }

}