
<?php // models/UserProfileModel.php

class UserProfileModel {
  private $conn;

  public function __construct() {
    $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    //Check the connection
    if($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function getProfile($userId){
    $userProfile = array();

    // Prepare the SQL query
   $query = "SELECT 
      u.fname,
      u.lname,
      u.uname,
      u.email,
      u.contact_no
    FROM 
      user u
    WHERE 
      u.u_id = ?";
    // Prepare and execute the statement
    if ($stmt = $this->conn->prepare($query)) {
      // Bind the user ID to the statement
      $stmt->bind_param("i", $userId);

      // Execute the statement
      $stmt->execute();

      // Get the result
      $result = $stmt->get_result();

      // Fetch the row and store it in the $userProfile array
      if ($row = $result->fetch_assoc()) {
        $userProfile = $row;
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

    // Return the user profile in JSON format
    return json_encode($userProfile);
  }

     public function modifyProfile($reportId) {
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

  // Check if the username or email already exists for another user
  function modelInfoInvalid($currentUser, $userName, $email) {
    // Prepare SQL query to check if the username or email exists for another user
    $query = "SELECT * FROM user WHERE (uname = ? OR email = ?) AND u_id != ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ssi", $userName, $email, $currentUser);
    $stmt->execute();
    $result = $stmt->get_result();

    // If there's any result, it means the username or email already exists
    if ($result->num_rows > 0) {
      return true; // Invalid info
    } else {
      return false; // Valid info
    }
  }

  // Update profile information for the current user
  function modelUpdateProfile($currentUser, $fname, $lname, $uname, $email, $contact_no) {
    // Prepare SQL query to update the user's profile
    $query = "UPDATE user SET fname = ?, lname = ?, uname = ?, email = ?, contact_no = ? WHERE u_id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("sssssi", $fname, $lname, $uname, $email, $contact_no, $currentUser);
    
    // Execute the query and check if it was successful
    if ($stmt->execute()) {
      return true; // Update successful
    } else {
      return false; // Update failed
    }
  }

  // Close database connection
  public function closeConnection() {
    $this->conn->close();
  }

}
?>
