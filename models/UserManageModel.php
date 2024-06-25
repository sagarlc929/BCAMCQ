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
    $query = "SELECT u_id, fname, lname, uname, email, contact_no FROM user";

    $result = $this->conn->query($query);

    if ($result) {
      while ($row = $result->fetch_assoc()) {
        $users[] = $row;
      }
      $result->free(); // Free the result set
    } else {
      echo "Error: " . $this->conn->error;
    }
    return $users;
  }

  function userAlreadyExists($username)
  {
    $stmt = $this->conn->prepare("SELECT COUNT(*) FROM user WHERE uname=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  function addUser($firstName, $lastName, $email, $username, $password, $contactNo) {

    $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $this->conn->prepare("INSERT INTO user (fname, lname, email, uname, password, contact_no) VALUES (?, ?, ?, ?, ?,?)");
    $stmt->bind_param("ssssss", $firstName, $lastName, $email, $username, $encryptedPassword, $contactNo);

    if ($stmt->execute()) {
      $insertedId = $stmt->insert_id; // Get the auto-generated ID of the inserted question
      //return true;
      $success = true;
      return [$success, $insertedId];
    } else {
      return false;
    }

    $stmt->close();
  }

}
?>
