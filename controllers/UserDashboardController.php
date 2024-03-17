<?php
require_once 'models/SemesterModel.php';
require_once 'models/SubjectModel.php';

class UserDashboardController{
  public function displayUserDashboard(){
    // Instantiate the SemesterModel
    $semesterModel = new SemesterModel();
    // Instantiate the SubjectModel
    $subjectModel = new SubjectModel();
 
    $semesters = $semesterModel->getSemesters();
    $semSub = [];

    foreach ($semesters as $semester) {
      $subjects = $subjectModel->getSubjects($semester);
      $semSub[] = [$semester => $subjects];
    }

    $jsonSemSub = json_encode($semSub);
    include 'views/user/user_dashboard.php';
  }
}
?>
