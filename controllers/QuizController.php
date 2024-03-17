
<?php
include_once 'models/QuizModel.php';
class QuizController{
  public function displayQuizPage() {
    // Fetch semester and subject values from the URL
    $semester = isset($_GET['sem']) ? $_GET['sem'] : '';
    $subject = isset($_GET['subject']) ? $_GET['subject'] : '';
   // echo"hi This is Quiz controller";
    // Display the quiz page with the selected semester and subject
    //echo $semester . $subject;
$quizModel = new QuizModel();
$questions = $quizModel->getQuestions($semester,$subject);
   // print_r($questions);
$jsonQuestions = json_encode($questions);
var_dump($questions);
    include 'views/quiz/quiz.php';
  }
}
?>
