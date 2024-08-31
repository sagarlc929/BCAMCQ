
<?php // models/Quiz.php

class QuizModel {
  private $conn;

  public function __construct() {
    $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check the connection
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function getQuestions($semester, $subject) {
    $questions = array(); // Initialize an array to store the questions
    
    // Query to fetch questions from the database
    $query = "SELECT description, option_A, option_B, option_C, option_D, answer, explanation 
              FROM question 
              NATURAL JOIN subject_question 
              NATURAL JOIN semester_subject 
              NATURAL JOIN subject 
              NATURAL JOIN semester 
              WHERE subject.subject_name = ? AND semester.semester_name = ? 
              ORDER BY RAND() 
              LIMIT 10";
    
    // Prepare statement
    if ($stmt = $this->conn->prepare($query)) {
      // Bind parameters
      $stmt->bind_param("ss", $subject, $semester);
      
      // Execute statement
      $stmt->execute();
      
      // Get result
      $result = $stmt->get_result();
      
      // Fetch rows and store them in the $questions array
      while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
      }
      
      // Free result
      $result->free();
      
      // Close statement
      $stmt->close();
    } else {
      // Handle the query error as needed
      echo "Error: " . $this->conn->error;
    }

    // Query to get subject_id
    $subjectId = null;
    $query = "SELECT subject_id FROM subject WHERE subject_name = ?";
    
    // Prepare statement
    if ($stmt = $this->conn->prepare($query)) {
      // Bind parameters
      $stmt->bind_param("s", $subject);
      
      // Execute statement
      $stmt->execute();
      
      // Get result
      $result = $stmt->get_result();
      
      // Fetch the subject_id
      if ($row = $result->fetch_assoc()) {
        $subjectId = $row['subject_id'];
      }
      
      // Free result
      $result->free();
      
      // Close statement
      $stmt->close();
    } else {
      // Handle the query error as needed
      echo "Error: " . $this->conn->error;
    }

    // Close the connection
    $this->closeConnection();
    
    $response = [
      "subject_id" => $subjectId,
      "questions" => $questions
    ];
    
    return $response;
  }

  public function closeConnection() {
    $this->conn->close();
  }
}

?>

