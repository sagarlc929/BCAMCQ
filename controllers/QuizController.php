
<?php
include_once 'models/QuizModel.php';

class QuizController{
    public function displayQuizPage() {
        // Fetch semester and subject values from the URL
        $semester = isset($_GET['sem']) ? $_GET['sem'] : '';
        $subject = isset($_GET['subject']) ? $_GET['subject'] : '';
        
        $quizModel = new QuizModel();
        $questions = $quizModel->getQuestions($semester, $subject);
        
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
        
        // Convert formatted questions to JSON for JavaScript processing
       // no  needed $jsonQuestions = json_encode($formattedQuestions);
        
        // Pass the JSON-encoded questions to the view
        include 'views/quiz/quiz.php';
    }
}
?>

