<?php
include_once 'models/QuizModel.php';
// include_once 'models/UserReportModel.php';

$quizController = new QuizController();
$quizController->processQuiz();

class QuizController {
    private $quizModel;
    // private $userReportModel;

    public function __construct() {
        $this->quizModel = new QuizModel();
        // $this->userReportModel = new UserReportModel();
    }

   public function processQuiz() {
    // Ensure `type` is set and valid
    if (!isset($_GET['type'])) {
        echo 'Error: Missing type parameter';
        return;
    }

    $type = $_GET['type'];
    $subject = isset($_GET['subject']) ? $_GET['subject'] : ''; // Ensure subject is provided
    $formattedQuestions = [];
    $subjectId = null; // Initialize subjectId
    $subjectName = $_GET['subject'];
    $subjectId = $this->quizModel->getSubjectId($subject);

    $semesterName = $this->quizModel->getSemesterFromSubject($subject);
    if ($type === 'regular') {
        $num = isset($_GET['number']) ? intval($_GET['number']) : 10;
        if ($num > 0) {
            $response = $this->getQuestionsReg($subject, $num);
            $questions = $response['questions'];
            //$subjectId = $response['subject_id']; // Get subjectId from response
            
            foreach ($questions as $question) {
                $formattedQuestion = [
                    'description' => $question['description'],
                    'options' => [$question['option_A'], $question['option_B'], $question['option_C'], $question['option_D']],
                    'answer' => $question['answer'],
                    'explanation' => $question['explanation']
                ];
                $formattedQuestions[] = $formattedQuestion;
            }

            // Include the view file for displaying questions
            include 'views/quiz/quiz.php';
        } else {
            echo 'Error: Invalid number of questions';
        }
    } else if ($type === 'past') {
        $year = isset($_GET['year']) ? $_GET['year'] : '';

        if ($year) {
            $response = $this->getQuestionsPas($subject, $year);
            $questions = $response['questions'];
            //$subjectId = $response['subject_id']; // Get subjectId from response

            foreach ($questions as $question) {
                $formattedQuestion = [
                    'description' => $question['description'],
                    'options' => [$question['option_A'], $question['option_B'], $question['option_C'], $question['option_D']],
                    'answer' => $question['answer'],
                    'explanation' => $question['explanation']
                ];
                $formattedQuestions[] = $formattedQuestion;
            }

            // Include the view file for displaying questions
            include 'views/quiz/quiz.php';
        } else {
            echo 'Error: Year parameter missing';
        }
    } else {
        echo 'Error: Invalid type parameter';
    }
}

    // Private function to get regular questions
    private function getQuestionsReg($subject, $num) {
        return $this->quizModel->getQuestionsRegModel($subject, $num);
    }

    // Private function to get past questions
    private function getQuestionsPas($subject, $year) {
        return $this->quizModel->getQuestionsPasModel($subject, $year);
    }
}
?>

