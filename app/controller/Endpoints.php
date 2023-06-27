<?php 
namespace App\controller;
use App\model\CoursesModel;

class Endpoints {

  public static function getAllShifts() {
    $dataRequest = json_decode(file_get_contents('php://input'), true);
    $course = strtoupper($dataRequest['course']);
    $condition = ', t.turno';
    $days = CoursesModel::getCourseDaysModel($course, $condition);
    echo json_encode($days);
  }

}