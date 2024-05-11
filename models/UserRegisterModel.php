
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
  function userAlreadyExists($username)
  {
    // Prepare the SQL statement
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
        return true;
    } else {
        return false;
    }

    $stmt->close();
  }
}
?>
