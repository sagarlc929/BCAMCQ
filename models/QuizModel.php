
<?php // models/Quiz.php

class QuizModel {
  private $conn;

  public function __construct() {
    $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    //Check the connection
    if($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function getQuestions($semester, $subject){
    $questions = array();// Initialize an array to store the questions
    // Query to fetch semesters formt the database


$query = "SELECT description, option_A, option_B, option_C, option_D, answer, explanation 
          FROM question 
          NATURAL JOIN subject_question 
          NATURAL JOIN semester_subject 
          NATURAL JOIN subject 
          NATURAL JOIN semester 
          WHERE subject.subject_name = '$subject' AND semester.semester_name = '$semester' 
          ORDER BY RAND() 
          LIMIT 10";

    $result = $this->conn->query($query);

    if($result){
    // Fetch 10 random rows and store them in the $questions array
    $questions = [];
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
    $result->free();
      $this->closeConnection();
    } else {
      // Handle the query error as need
      echo "Error: " . $this->conn->error;
    }
    return $questions;
  }

  public function closeConnection(){
    $this->conn->close();
  }
}

?>
