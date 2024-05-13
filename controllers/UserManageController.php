<?php
require_once 'models/UserManageModel.php'; // Include the model file first

$userManageController = new UserManageController();

if (isset($_POST['action'])) {
  $userManageController->processUserManage();
} else {
  $userManageController->displayUserManageDashboard();
}

class UserManageController
{
  private $userManageModel;

  public function __construct()
  {
    $this->userManageModel = new UserManageModel();
  }

  public function displayUserManageDashboard()
  {
    $users = $this->userManageModel->getAllUsers(); 
    require_once 'views/admin/manage/user_manage.php';
  }

  public function processUserManage(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Check if the action parameter is provided in the POST data
      if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Handle the action based on the value of the 'action' parameter
        switch ($action) {
        case 'delete':
          // Check if the question ID is provided in the POST data
          if (isset($_POST['question_id'])) {
            $questionId = $_POST['question_id'];

            // Perform the deletion operation and store the result in $deleted
            $deleted = $this->deleteQuestion($questionId);
            if ($deleted) {

              // Redirect back to the question manage page after deletion
              $response = [
                'message' => "Deleted successfully $questionId",
                'status' => 1
              ];
            } else {
              $response = [
                'message' => 'Failed to delete question',
                'status' => 0
              ];
            }
          } else {
            // Handle the case where question ID is missing
            $response = [
              'message' => 'Question ID is missing',
              'status' => 0
            ];
            //echo 'Question ID is missing';
          }
          header('Content-Type: application/json');
          echo json_encode($response);
          exit;
          break;

        case 'modify':
          // Check if the necessary data for modifying a question is provided
          // Implement modification logic here

          // Redirect back to the question manage page after modification
          //header('Location: ?route=question_manage');
          exit;
          break;
        case 'addNewUser':

          $description = $_POST['description'];
          $optionA = $_POST['optionA'];
          $optionB = $_POST['optionB'];
          $optionC = $_POST['optionC'];
          $optionD = $_POST['optionD'];
          $answer = $_POST['answer'];
          $explanation = $_POST['explanation'];
          $semesterSelect = $_POST['semesterSelect'];
          $subjectSelect = $_POST['subjectSelect'];

          $response = $this->addQuestion($description,$optionA,$optionB,$optionC,$optionD,$answer,$explanation,$subjectSelect);
          header('Content-Type: application/json');
          echo json_encode($response);
          exit;
          break;
        case 'getQuestions':
          $subSelected = $_POST['subjectSelected'];
          $questions = $this->getQuestions($subSelected);
          $response = [
            'message' => 'ok',
            'status' => 1,
            'data'=>$questions
          ];

          header('Content-Type: application/json');
          echo json_encode($response);

          exit;
          break;

        default:
          // Handle invalid action
          echo 'Invalid action';
          break;
        }
      } else {
        // Handle action parameter missing
        echo 'Action parameter is missing';
      }
    } else {
      // Handle invalid request method
      echo 'Invalid request method';
    }

  }
}

?>

