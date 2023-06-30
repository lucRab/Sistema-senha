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

    public static function maxQuantPasswordsModel($cod_aluno) {
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $conexao = Conexao::conectar();

        $query = SQL_GET_USER_PASSWORDS();
        $params = [
            "data_hoje" => date("Y/m/d"),
            "cod_aluno" => $_SESSION['id_usuario']
        ];

        $con = ValidConnection::isValidConnection($conexao, $query, $params);
        return $con->fetchAll(PDO::FETCH_OBJ);
    }

    public static function filterClassesModel($infosClass)
    {
        $conexao = Conexao::conectar();
        
        $course = $infosClass->courseName;
        $age = $infosClass->age;
        $shift = $infosClass->shift;
        $daysCourse = $infosClass->days;

        $conditionDay = ' AND t.dias_de_aula = (SELECT d.id_dia FROM dia d WHERE d.nome_dia = :daysCourse)'; 
        
        $conditionShift = ' AND turno = :turno';

        $conditions = 'AND :idade BETWEEN idade_minima AND idade_maxima' . $conditionShift . $conditionDay;

        $params = [
            'idade' => $age,
            'turno' => $shift,
            'daysCourse' => $daysCourse,
        ];

        $query = SQL_FILTER_CLASSES($course, $conditions);
        // Inicia uma transação
        $conexao->beginTransaction();
        $class = ValidConnection::isValidConnection($conexao, $query, $params);
        // Finaliza a transação
        $conexao->commit();
        $dataClass = $class->fetchAll(PDO::FETCH_OBJ);
        return $dataClass;
    }

}