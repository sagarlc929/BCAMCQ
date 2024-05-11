<?php

class UserManageModel {
  private $conn;

  public function __construct() {
    // Database connection is established in the constructor
    $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check the connection
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function getAllUsers() {
    $users= array(); // Initialize an array to store the questions

    // Query to fetch questions from the database
    $query = "SELECT * FROM user";

    // Execute the query
    $result = $this->conn->query($query);

    if ($result) {
      // Fetch rows and store them in the $questions array
      while ($row = $result->fetch_assoc()) {
        $users[] = $row;
      }
      $result->free(); // Free the result set
    } else {
      // Handle the query error if needed
      echo "Error: " . $this->conn->error;
    }

    return $users;
  }

}
?>
