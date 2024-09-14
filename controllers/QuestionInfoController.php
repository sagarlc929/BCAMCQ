<?php
// file name: QuestionInfoController.php
require_once 'models/QuestionInfoModel.php'; // Include the model file

$questionInfoController = new QuestionInfoController();
$questionInfoController->processQuestionInfo();

class QuestionInfoController
{
  private $questionInfoModel;

  public function __construct()
  {
    $this->questionInfoModel = new QuestionInfoModel();
  }

  public function processQuestionInfo()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Check if the type parameter is provided in the POST data
      if (isset($_POST['type'])) {
        $action = $_POST['type'];
        $subjectName = $_POST['subject'];

        // Handle the action based on the value of the 'type' parameter
        switch ($action) {
          case 'regular':
            $temp = $this->getSubQunNum($subjectName);
            $response = [
              'status' => true,
              'message' => 'success',
              'data' => $temp,
              'type' => 'regular'
            ];
            break;

          case 'past':
            $temp = $this->getPastArr($subjectName);
            $response = [
              'status' => true,
              'message' => 'success',
              'data' => $temp,
              'type' => 'past'
            ];
            break;

          default:
            $response = ['status' => false, 'message' => 'Invalid action type'];
        }

        // Return response as JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        exit; // Exit after sending the response
      }
    }
  }

  // Private function to handle regular questions
  private function getSubQunNum($subjectName)
  {
    return $this->questionInfoModel->getSubQunNumModel($subjectName);
  }

  // Private function to handle past questions
  private function getPastArr($subjectName)
  {
    return $this->questionInfoModel->getPastArrModel($subjectName);
  }
}

