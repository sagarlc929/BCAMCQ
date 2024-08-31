<?php
// models/UserReportModel.php

class UserReportModel {
  private $conn;

  public function __construct() {
    $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check the connection
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function addReportToModel($userId, $marks, $subjectId) {
    // Start a transaction
    $this->conn->begin_transaction();

    try {
      // First query: Insert into user_report and get the auto-increment report_id
      $query1 = "INSERT INTO user_report (user_id) VALUES (?)";
      
      // Prepare statement
      if ($stmt1 = $this->conn->prepare($query1)) {
        // Bind parameters
        $stmt1->bind_param("i", $userId);
        
        // Execute statement
        if (!$stmt1->execute()) {
          throw new Exception("Failed to insert into user_report: " . $stmt1->error);
        }
        
        // Get the inserted report_id
        $reportId = $this->conn->insert_id;
        
        // Close the first statement
        $stmt1->close();
      } else {
        throw new Exception("Error preparing statement for user_report: " . $this->conn->error);
      }

      // Second query: Insert into report using the retrieved report_id
      $query2 = "INSERT INTO report (report_id, marks, subject_id) VALUES (?, ?, ?)";
      
      // Prepare statement
      if ($stmt2 = $this->conn->prepare($query2)) {
        // Bind parameters
        $stmt2->bind_param("iis", $reportId, $marks, $subjectId);
        
        // Execute statement
        if (!$stmt2->execute()) {
          throw new Exception("Failed to insert into report: " . $stmt2->error);
        }
        
        // Close the second statement
        $stmt2->close();
      } else {
        throw new Exception("Error preparing statement for report: " . $this->conn->error);
      }

      // Commit the transaction
      $this->conn->commit();

      // Prepare a response array on success
      $response = [
        'status' => 1,
        'message' => "Report added successfully."
      ];
      
    } catch (Exception $e) {
      // Rollback the transaction on error
      $this->conn->rollback();

      // Prepare a response array on failure
      $response = [
        'status' => 0,
        'message' => $e->getMessage()
      ];
    }
    
    // Return the response
    return $response;
  }

  public function closeConnection() {
    $this->conn->close();
  }
}
?>
