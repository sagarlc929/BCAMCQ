<?php // models/SubjectModel.php

class SubjectModel {
  private $conn;

  public function __construct() {
    $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    //Check the connection
    if($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }
public function getSubjects($semesterName) {
    $semesterNametemp = "First Semester";
        // Query to fetch subjects from the database
        $sql_select = "SELECT subject_name FROM subject 
                       NATURAL JOIN subject_semester 
                       NATURAL JOIN semester 
                       WHERE semester_name = '$semesterName'";

        // Execute the query
        $result = $this->conn->query($sql_select);

        if ($result) {
            // Fetch data and store in the $subjects array
            while ($row = $result->fetch_assoc()) {
                $subjects[] = $row['subject_name'];
            }

            // Free result set
            $result->free_result();
         //   $this->closeConnection();
        } else {
            // Handle the query error as needed
            echo "Error: " . $this->conn->error;
        }

        return $subjects;
    }

}
?>
