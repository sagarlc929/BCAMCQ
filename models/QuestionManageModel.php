<?php

class QuestionManageModel {
  private $conn;

  public function __construct() {
    // Database connection is established in the constructor
    $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check the connection
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }


public function deleteQuestion($questionId) {
    // Prepare the DELETE query using a prepared statement to avoid SQL injection
    $query = "DELETE FROM subject_question WHERE question_id = ?;"; // Delete related entries first
    $stmt = $this->conn->prepare($query);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param('i', $questionId);
    $stmt->execute();

    $stmt->close();

    $query = "DELETE FROM question WHERE question_id = ?";
    $stmt = $this->conn->prepare($query);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param('i', $questionId);
    $stmt->execute();

    $stmt->close();

    return true;
}
  public function getAllQuestion() {
    $questions = array(); // Initialize an array to store the questions

    // Query to fetch questions from the database
    $query = "SELECT * FROM question";

    // Execute the query
    $result = $this->conn->query($query);

    if ($result) {
      // Fetch rows and store them in the $questions array
      while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
      }
      $result->free(); // Free the result set
    } else {
      // Handle the query error if needed
      echo "Error: " . $this->conn->error;
    }

    return $questions;
  }

  public function closeConnection() {
    // Close the database connection
    $this->conn->close();
  }
}
?>
