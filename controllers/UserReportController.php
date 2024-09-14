
<?php 
// include_once 'models/QuizModel.php';
include_once 'models/UserReportModel.php';

$userReportController  = new UserReportController;

if (isset($_POST['action'])) {
  $userReportController->processUserReport();
}

class UserReportController  {
  private $userReportModel;

  public function __construct(){
    //    $this->quizModel = new QuizModel();
    $this->userReportModel = new UserReportModel();
  }

  public function processUserReport()
  {
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Check if the action parameter is provided in the POST data
      if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Handle the action based on the value of the 'action' parameter
        switch ($action) {
        case 'set_report':

          $userId = $_SESSION['user_id'];
          $marks = $_POST['marks'];
          $subjectId = $_POST['subject_id'];
          $response = $this->addReportToModel($userId, $marks, $subjectId);
          header('Content-Type: application/json');
          echo json_encode($response);
          exit;
          break;

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

    return $this->userReportModel->getReports($userId);
  }

   private function deleteReportById($reportId){

    return $this->userReportModel->deleteReportById($reportId);
  }
  private function addReportToModel($userId, $marks, $subjectId){
    return $this->userReportModel->addReportToModel($userId, $marks, $subjectId);
  }
  
}
?>
