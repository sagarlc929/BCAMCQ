
<?php
       $questionManageController = new QuestionManageController;
      if (isset($_POST['action'])) {
        $questionManageController->processQuestionManage();
      } else {
        $questionManageController->displayQuestionManageDashboard();
      }


class QuestionManageController {
  private $questionModel;
  public function __construct() {
    // Instantiate the QuestionModel in the controller's constructor
    $this->questionModel = new QuestionManageModel();
  }

  public function displayQuestionManageDashboard() {
    $allQuestion = $this->getAllQuestion();
    $this->setAllQuestion($allQuestion);
  }

  private function getAllQuestion() {
    return $this->questionModel->getAllQuestion();
  }

  private function setAllQuestion($allQuestion) {
    require_once 'views/admin/manage/question_manage.php';
  } 

  public function processQuestionManage() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Check if the action parameter is provided in the POST data
      if (isset($_POST['action'])) {
        $action = $_POST['action'];
        //echo $action;
/*
 <form action="?route=question_manage" method="POST">
  <input type="hidden" name="action" value="new">
  <button type="submit">Add</button>
  <div id="questions">
 */


        // Handle the action based on the value of the 'action' parameter
        switch ($action) {
          case 'delete':
            // Check if the question ID is provided in the POST data
            if (isset($_POST['question_id'])) {
              $questionId = $_POST['question_id'];

              // Perform the deletion operation and store the result in $deleted
              $deleted = $this->deleteQuestion($questionId);
             // echo "**$questionId**";
              if ($deleted) {
                // Redirect back to the question manage page after deletion
                //header('Location: ?route=question_manage');
                //
               $response = [
               'message' => "Deleted successfully $questionId",
               'delete_flag' => 1
              ];
              } else {
                $response = [
               'message' => 'Failed to delete question',
               'delete_flag' => 0
               ];
              }
            } else {
              // Handle the case where question ID is missing
                $response = [
               'message' => 'Question ID is missing',
               'delete_flag' => 0
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
            header('Location: ?route=question_manage');
            exit;
          break;
          case 'new':
            echo"new?";
           // header('Location: ?route=question_form');
     //       also views/admin/manage/question_manage.php which i dont want modify code

              // Check if the necessary data for modifying a question is provided
            // Implement modification logic here

            // Redirect back to the question manage page after modification
            //header('Location: ?route=question_manage');
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
      //header('Location: ?route=question_manage');
      echo 'Invalid request method';

    }
  }

  // Function to delete a question
  private function deleteQuestion($questionId) {
    // Implement your logic to delete the question using the QuestionModel or database operations
    // Return true if the question is successfully deleted, false otherwise
    return $this->questionModel->deleteQuestion($questionId);
  }

  // Function to modify a question
  private function modifyQuestion($questionId, $description, $optionA, $optionB, $optionC, $optionD, $answer, $explanation) {
    // Implement your logic to modify the question using the QuestionModel or database operations
    // Return true if the question is successfully modified, false otherwise
    return $this->questionModel->modifyQuestion($questionId, $description, $optionA, $optionB, $optionC, $optionD, $answer, $explanation);
  }
}

// Create an instance of the controller and process the question management action
?>

