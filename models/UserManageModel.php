<?php // UserManageModel.php

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


  public function updateUser($id, $firstName, $lastName, $email, $contactNo, $userName, $newPassword) {
    // Query to check if the data is the same as the current data
    $checkQuery = "SELECT * FROM user WHERE u_id=? AND fname=? AND lname=? AND email=? AND contact_no=? AND uname=? AND password=?";
    $checkStmt = $this->conn->prepare($checkQuery);

    if (!$checkStmt) {
      return ['status' => false, 'message' => 'Failed to prepare the statement for data check.'];
    }

    // Encrypt the password before checking
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
    $checkStmt->bind_param('issssss', $id, $firstName, $lastName, $email, $contactNo, $userName, $hashedPassword);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
      $checkStmt->close();
      return ['status' => false, 'message' => 'The update data is the same as the existing data.'];
    }

    $checkStmt->close();

    // Update the user in the user table
    $query = "UPDATE user SET fname=?, lname=?, email=?, contact_no=?, uname=?, password=? WHERE u_id=?";
    $stmt = $this->conn->prepare($query);

    if (!$stmt) {
      return ['status' => false, 'message' => 'Failed to prepare the statement for user update.'];
    }

    $stmt->bind_param('ssssssi', $firstName, $lastName, $email, $contactNo, $userName, $hashedPassword, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
      return ['status' => true, 'message' => 'User updated successfully.'];
    } else {
      return ['status' => false, 'message' => 'No changes were made to the user.'];
    }
  }


  public function deleteUser($userId) {
    // Perform the deletion operation
    $query = "DELETE FROM user WHERE u_id = ?";
    $stmt = $this->conn->prepare($query);

    if (!$stmt) {
      return false;
    }

    $stmt->bind_param('i', $userId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
      return true;
    } else {
      return false;
    }
  }

}
?>
