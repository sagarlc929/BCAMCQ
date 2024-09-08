<?php 

//require_once 'models/QuestionManageModel.php';
require_once 'models/SemesterModel.php';
require_once 'models/SubjectModel.php';
require_once 'models/UserDashboardModel.php';
require_once 'models/UserProfileModel.php';

$userDashboardController = new UserDashboardController;
if (isset($_POST['action'])) {
  $userDashboardController->processUserDashboard();
} else {
  $userDashboardController->displayUserDashboard();
}


class UserDashboardController
{
 private $userDashboardModel; 
 private $userProfileModel; 

 public function __construct() {
    $this->userDashboardModel = new UserDashboardModel();
    $this->userProfileModel = new UserProfileModel();
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

          case 'get_user_info':
            // Retrieve user ID from session
            $userId = $_SESSION['user_id'];
        
            // Get the user profile information
            $profileData = $this->getProfile($userId);
        
            // Decode the JSON data into an object
            $response = json_decode($profileData);
        
            // Check if the profile data was retrieved successfully
            if ($response) {
                // Construct the response array
                $responseArray = [
                    'status' => 1,
                    'message' => "User information retrieved successfully.",
                    'data' => $response // Include the profile data
                ];
            } else {
                // Handle the case where profile data could not be retrieved
                $responseArray = [
                    'status' => 0,
                    'message' => "Failed to retrieve user information."
                ];
            }
        
            // Set the content type to JSON
            header('Content-Type: application/json');
        
            // Return the response as JSON
            echo json_encode($responseArray);
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
  private function getProfile($userId){

    return $this->userProfileModel->getProfile($userId);
  }
   private function deleteReportById($reportId){

    return $this->userDashboardModel->deleteReportById($reportId);
  }
  

}
?>

