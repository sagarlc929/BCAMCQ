
<?php
include_once 'models/QuizModel.php';
include_once 'models/UserReportModel.php';

$quizController  = new QuizController;

if (isset($_POST['action'])) {
  $quizController->processQuiz();
} else {
  $quizController->displayQuiz();
}

class QuizController {
  private $quizModel, $userReportModel;

  public function __construct(){
    $this->quizModel = new QuizModel();
    $this->userReportModel = new UserReportModel();
  }
    public function displayQuiz() {
        // Fetch semester and subject values from the URL
      $semester = isset($_GET['sem']) ? $_GET['sem'] : '';
       $subject = isset($_GET['subject']) ? $_GET['subject'] : '';
        
        /*$quizModel = new QuizModel();*/
        $response = $this->quizModel->getQuestions($semester, $subject);
        $subjectId = $response['subject_id'];
        $questions = $response['questions'];
        
        // Format questions into the desired structure
        $formattedQuestions = [];
        foreach ($questions as $question) {
            $formattedQuestion = [
                'description' => $question['description'],
                'options' => [$question['option_A'], $question['option_B'], $question['option_C'], $question['option_D']], // Corrected syntax
                'answer' => $question['answer'],
                'explanation' => $question['explanation']
            ];
            $formattedQuestions[] = $formattedQuestion;
        }
               include 'views/quiz/quiz.php';
    }

  public function processQuiz()
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
          //$response = $this->getReports($userId);
          // $response = ['status'=>1,
          //   'message'=>"php get it ",
          //   'marks' => $marks,
          //   'subject_id' => $subjectId
          // ];
          header('Content-Type: application/json');
          echo json_encode($response);
          exit;
          break;
      //xhttp.send(`action=delete_report&report_id=${reportId}`);

      //TODO: Move this to  UserReportController.php
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
  private function addReportToModel($userId, $marks, $subjectId){
    return $this->userReportModel->addReportToModel($userId, $marks, $subjectId);
  }
  
}
?>
