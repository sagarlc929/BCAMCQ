
<?php // models/RegistrationController.php
require_once 'config.php'; // Input the configuration

class UserRegisterModel
{
  private $conn;

  public function __construct()
  {
    $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    //Check the connection
    if($this->conn->connect_error)
    {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }
 
  // Function to check if a user exists
  function userAlreayExit($username)
  {
    // Prepare the SQL statement
    $stmt = $this->conn->prepare("SELECT COUNT(*) FROM user WHERE uname=?");
    // Bind the parameter
    $stmt->bind_param("s", $username);
    // Execute the statement
    $stmt->execute();
    // Bind the result
    $stmt->bind_result($count);
    // Fetch the result
    $stmt->fetch();
    // Close the statement
    $stmt->close();

    // Check if the count is greater than 0
    if ($count > 0)
    {
        // User exists
        return true;
    }
    else
    {
        // User does not exist
        return false;
    }
  }

  function addUser($firstName, $lastName, $email, $username, $password, $contactNo) {

    // Encrypt the password
    $encryptedPassword = password_hash($password, PASSWORD_DEFAULT);
    // Prepare the SQL statement to insert a new user
    $stmt = $this->conn->prepare("INSERT INTO user (fname, lname, email, uname, password, contact_no) VALUES (?, ?, ?, ?, ?,?)");
    // Bind parameters
    $stmt->bind_param("ssssss", $firstName, $lastName, $email, $username, $encryptedPassword, $contactNo);
    
    // Execute the statement
    if ($stmt->execute()) {
        // User added successfully
        return true;
    } else {
        // Error adding user
        return false;
    }
    // Close the statement
    $stmt->close();
  }
}
?>
