<?php // models/UserModel.php
require_once 'config.php'; // Input the configuration

class UserModel {
  private $conn;

  public function __construct() {
    $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    //Check the connection
    if($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }
  public function validateCredentials($username, $password){
    // Implemetn your logic to validate the credentials 
    // Check against the database or any authentication mechanism
    // Return true on successful validation, false otherwise
    // Example: check against a user table in the database
    // You might use password_hash an password_verify for password hashing

    // Use prepared statement to prevent SQL injection
    $stmt = $this->conn->prepare("SELECT password FROM user WHERE uname=?");
    
    if($stmt ===false){
      // Throw an exception with an error message
      throw new Exception('Error prepareing the SQL statement');
    }

    $stmt->bind_param("s", $username);// Bind the parameter

    // Execute the statement
    $stmt->execute();

    // Bind the result variable
    $stmt->bind_result($hashedPasswordFromDatabase);

    // Fetch the result
    $stmt->fetch();

    //close the statement 
    $stmt->close();

    // Check if a matching username was found
    if($hashedPasswordFromDatabase !== null){
      // Verify the provided password agninst the hashed password from the database
      return password_verify($password, $hashedPasswordFromDatabase);
    } else {
      // Username not found
      echo"user not found";
      return false;
    }
    /* not needed
    $hashedPasswordFromDatabase = '...'; // Retrive hashed password from the database
    return password_verify($password, $hashedPasswordFromDatabase);
    */
  }
}
?>
