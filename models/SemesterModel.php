<?php // models/SemesterModel.php

class SemesterModel {
  private $conn;

  public function __construct() {
    $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    //Check the connection
    if($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function getSemesters(){
    $semesters = array();// Initialize an array to stor the results
    
    // Query to fetch semesters formt the database
    $query = "SELECT semester_name FROM semester";
    $result = $this->conn->query($query);

    if($result){
      // Fetch data and store in the $semesters array 
      while($row = $result->fetch_assoc()){
        $semesters[]= $row["semester_name"];
      }
      //Free result set 
      $result->free_result();
      $this->closeConnection();
    } else {
      // Handle the query error as need
      echo "Error: " . $this->conn->error;
    }
    return $semesters;
  }

  public function closeConnection(){
    $this->conn->close();
  }
}

?>
