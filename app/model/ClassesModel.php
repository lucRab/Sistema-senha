<?php
namespace App\model;
use Core\connection\Conexao;
use Core\validations\ValidConnection;
use PDO;
require_once __DIR__."/../../database/sqlClasses.php";

class ClassesModel
{
    public function __construct()
    {
    }

    public static function filterClassesModel($infosClass)
    {
        $conexao = Conexao::conectar();
        
        $course = $infosClass->courseName;
        $age = $infosClass->age;
        $shift = $infosClass->shift;

        $conditions = ' AND :idade BETWEEN idade_minima AND idade_maxima';

        $params = ['idade' => $age];

        if ($shift) {
            $conditions .= ' AND turno = :turno';
            $params['turno'] = $shift;
        }

        $query = SQL_FILTER_CLASSES($course, $conditions);
        // Inicia uma transação
        $conexao->beginTransaction();
        $class = validConnection::isValidConnection($conexao, $query, $params);
        // Finaliza a transação
        $conexao->commit();
        $dataClass = $class->fetchAll(PDO::FETCH_OBJ);
        return $dataClass;
    }

}