
<?php // models/HomePageModel.php
require_once 'config.php'; // Include the configuration

class HomePageModel
{
  private $conn;

  public function __construct()
  {
    // Establish database connection
    $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check the connection
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  // Function to get a random question from the database

public function getARanQuestionModel() {
    $query = "SELECT * FROM question ORDER BY RAND() LIMIT 1";
    $result = $this->conn->query($query);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}
  // Function to close the database connection
  public function __destruct()
  {
    $this->conn->close();
  }
}
?>
>
