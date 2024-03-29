

<?php
require_once 'config.php'; // Include the configuration file

class AdminLoginModel {
  private $conn;

  public function __construct() {
    $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check the connection
    if($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }

    // Start the session here
    session_start();
  }

  public function validateCredentials($username, $password){
    // Implement your logic to validate the credentials 
    // Check against the database or any authentication mechanism
    // Return true on successful validation, false otherwise
    // Example: check against a user table in the database
    // You might use password_hash and password_verify for password hashing

    // Use prepared statement to prevent SQL injection
    $stmt = $this->conn->prepare("SELECT password FROM admin WHERE aname=?");
    
    if($stmt === false){
      // Throw an exception with an error message
      throw new Exception('Error preparing the SQL statement');
    }

    $stmt->bind_param("s", $username);// Bind the parameter

    // Execute the statement
    $stmt->execute();

    // Bind the result variable
    $stmt->bind_result($hashedPasswordFromDatabase);

    // Fetch the result
    $stmt->fetch();

    // Close the statement 
    $stmt->close();

    // Check if a matching username was found
    if($hashedPasswordFromDatabase !== null){
      // Verify the provided password against the hashed password from the database
      return password_verify($password, $hashedPasswordFromDatabase);
    } else {
      // Username not found
      echo "User not found";
      $_SESSION['error'] = "**User not found (LoginModel.php)**";
      return false;
    }
  }
}

// Including other files and sleep(3) should be outside the class definition

?>
