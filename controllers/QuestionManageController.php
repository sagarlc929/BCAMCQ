
<?php // QuestionManageController.php

require_once 'models/QuestionManageModel.php';
require_once 'models/SemesterModel.php';
require_once 'models/SubjectModel.php';
$questionManageController = new QuestionManageController;
if (isset($_POST['action'])) {
  $questionManageController->processQuestionManage();
} else {
  $questionManageController->displayQuestionManageDashboard();
}


class QuestionManageController
{
  private $questionModel;
  private $semesterModel;
  private $subjectModel;

  public function __construct()
  {
    // Instantiate the QuestionModel in the controller's constructor
    $this->questionModel = new QuestionManageModel();
    $this->semesterModel = new SemesterModel();
    // Instantiate the SubjectModel
    $this->subjectModel = new SubjectModel();
  }

  public function displayQuestionManageDashboard()
  {
    $semesters = $this->semesterModel->getSemesters();
    $semSub = [];

    foreach ($semesters as $semester) {
      $subjects = $this->subjectModel->getSubjects($semester);
      $semSub[] = [$semester => $subjects];
    }
    require_once 'views/admin/manage/question_manage.php';

  }


  public function processQuestionManage()
  {
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
//updateQuestion&
        case 'updateQuestion':

          $id = $_POST['id'];
          $description = $_POST['description'];
          $optionA = $_POST['optionA'];
          $optionB = $_POST['optionB'];
          $optionC = $_POST['optionC'];
          $optionD = $_POST['optionD'];
          $answer = $_POST['answer'];
          $explanation = $_POST['explanation'];
          $year = $_POST['year'];
          $response = $this->updateQuestion($id,$description,$optionA,$optionB,$optionC,$optionD,$answer,$explanation,$year);
          header('Content-Type: application/json');
          echo json_encode($response);
          exit;
          break;

        case 'addNewQuestion':
          $description = $_POST['description'];
          $optionA = $_POST['optionA'];
          $optionB = $_POST['optionB'];
          $optionC = $_POST['optionC'];
          $optionD = $_POST['optionD'];
          $answer = $_POST['answer'];
          $explanation = $_POST['explanation'];
          $year = $_POST['year'];
          $semesterSelect = $_POST['semesterSelect'];
          $subjectSelect = $_POST['subjectSelect'];
          $response = $this->addQuestion($description,$optionA,$optionB,$optionC,$optionD,$answer,$explanation,$subjectSelect,$year);
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

  // Function to delete a question
  private function deleteQuestion($questionId)
  {
    // Implement your logic to delete the question using the QuestionModel or database operations
    // Return true if the question is successfully deleted, false otherwise
    return $this->questionModel->deleteQuestion($questionId);
  }

  private function addQuestion($description,$optionA,$optionB,$optionC,$optionD,$answer,$explanation,$subjectSelect,$year){
    return $this->questionModel->addQuestion($description, $optionA, $optionB, $optionC,$optionD,$answer, $explanation, $subjectSelect, $year);
  }

  private function updateQuestion($id,$description,$optionA,$optionB,$optionC,$optionD,$answer,$explanation, $year){
    return $this->questionModel->updateQuestion($id,$description, $optionA, $optionB, $optionC,$optionD,$answer, $explanation,$year);
  }

  private function getQuestions($subjectSelected){
    return $this->questionModel->getQuestions($subjectSelected);
  }
}
?>

