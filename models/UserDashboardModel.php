
<?php // models/UserDashboardModel.php

class UserDashboardModel {
  private $conn;

  public function __construct() {
    $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    //Check the connection
    if($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function getReports($userId){
    // Initialize an array to store the reports
    $reports = array();

    // Prepare the SQL query
   $query = "SELECT 
      ur.report_id,
      s.semester_name,
      sub.subject_name,
      r.marks
    FROM 
      user_report ur
    JOIN 
      report r ON ur.report_id = r.report_id
    JOIN 
      semester_subject ss ON r.subject_id = ss.subject_id
    JOIN 
      semester s ON ss.semester_id = s.semester_id
    JOIN 
      subject sub ON ss.subject_id = sub.subject_id
    WHERE 
      ur.user_id = ?
    ORDER BY 
      ur.report_id DESC";
    // Prepare and execute the statement
    if ($stmt = $this->conn->prepare($query)) {
      // Bind the user ID to the statement
      $stmt->bind_param("i", $userId);

      // Execute the statement
      $stmt->execute();

      // Get the result
      $result = $stmt->get_result();

      // Fetch all rows and store them in the $reports array
      while ($row = $result->fetch_assoc()) {
        $reports[] = $row;
      }

      // Free the result
      $result->free();

      // Close the statement
      $stmt->close();
    } else {
      // Handle the query error as needed
      echo "Error: " . $this->conn->error;
    }

    // Close the database connection
    $this->closeConnection();

    // Return the reports
    return $reports;
  }

     public function deleteReportById($reportId) {
        // Perform deletion query
        $query = "DELETE FROM user_report WHERE report_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $reportId); // Assuming report_id is an integer

        // Execute the query
        if ($stmt->execute()) {
            // Check if any rows were affected
            if ($stmt->affected_rows > 0) {
                return true; // Report deleted successfully
            } else {
                return false; // Report not found or not deleted
            }
        } else {
            return false; // Query execution failed
        }
    }

  public function closeConnection(){
    $this->conn->close();
  }
}
?>
