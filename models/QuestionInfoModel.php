<?php
require_once 'config.php'; // Include the configuration file

class QuestionInfoModel {
  private $conn;

  public function __construct() {
    $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check the connection
    if($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  // Function to get the number of questions for a specific subject
  public function getSubQunNumModel($subjectName) {
    $query = "SELECT COUNT(*) as total 
              FROM subject_question sq
              JOIN subject s ON sq.subject_id = s.subject_id
              WHERE s.subject_name = ?";
              
    $stmt = $this->conn->prepare($query);
    
    if (!$stmt) {
      return 0;
    }
    $stmt->bind_param('s', $subjectName);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['total']; // Return the number of questions
  }

  // Function to get the past question years for a specific subject
  public function getPastArrModel($subjectName) {
    $query = "SELECT DISTINCT q.year 
              FROM question q
              JOIN subject_question sq ON q.question_id = sq.question_id
              JOIN subject s ON sq.subject_id = s.subject_id
              WHERE s.subject_name = ? AND q.year IS NOT NULL";
              
    $stmt = $this->conn->prepare($query);
    
    if (!$stmt) {
      error_log("Prepare failed: " . $this->conn->error);
      return [];
    }
    
    $stmt->bind_param('s', $subjectName);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $years = [];
    while ($row = $result->fetch_assoc()) {
      $years[] = $row['year']; // Collect all the distinct years
    }
    
    return $years; // Return an array of years with past questions
  }
}

