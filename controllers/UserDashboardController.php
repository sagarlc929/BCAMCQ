<?php 

//require_once 'models/QuestionManageModel.php';
require_once 'models/SemesterModel.php';
require_once 'models/SubjectModel.php';
require_once 'models/UserDashboardModel.php';

$userDashboardController = new UserDashboardController;
if (isset($_POST['action'])) {
  $userDashboardController->processUserDashboard();
} else {
  $userDashboardController->displayUserDashboard();
}


class UserDashboardController
{
 private $userDashboardModel; 

 public function __construct() {
    $this->userDashboardModel = new UserDashboardModel();
  }
  
  public function displayUserDashboard(){
    $semesterModel = new SemesterModel();
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

  public function processUserDashboard()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Check if the action parameter is provided in the POST data
      if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Handle the action based on the value of the 'action' parameter
        switch ($action) {
        case 'getReport':

          $userId = $_SESSION['user_id'];
          $response = $this->getReports($userId);
          header('Content-Type: application/json');
          echo json_encode($response);
          exit;
          break;
      //xhttp.send(`action=delete_report&report_id=${reportId}`);
        case 'delete_report':
          $reportId = $_POST['report_id'];
          $deleted = $this->userDashboardModel->deleteReportById($reportId);

          if ($deleted) {
            $response['status'] = 1;
            $response['message'] = "Report deleted successfully.";
          } else {
            $response['status'] = 0;
            $response['message'] = "Failed to delete report.";
          }
          echo json_encode($response);
          exit;
          break;
        }
      }
    }
  }
  private function getReports($userId){

    return $this->userDashboardModel->getReports($userId);
  }

   private function deleteReportById($reportId){

    return $this->userDashboardModel->deleteReportById($reportId);
  }
  

}
?>

