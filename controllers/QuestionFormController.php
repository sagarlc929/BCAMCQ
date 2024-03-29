<?php
/*  require_once 'contoller/QuestionFormController.php';
      $questionFormController = new QuestionFormController;
      $questionFormController->displayQuestionFrom();
      $questionManageController->processQuestionFormSubmittion();
 */  


require_once 'models/QuestionManageModel.php';

class QuestionFormController {
  private $questionModel;

  public function __construct() {
    // Instantiate the QuestionModel in the controller's constructor
    $this->questionModel = new QuestionManageModel();
  }

  public function displayQuestionFrom() {
    require_once 'views/question/question_form.php';
  }



  public function processQuestionFormSubmittion() {
 //   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //   
  exit;
  }
}

?>
