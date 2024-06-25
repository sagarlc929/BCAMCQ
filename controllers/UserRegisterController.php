
<?php // UserRegisterController.php

require_once 'models/UserRegisterModel.php';

// Instantiate the controller and process the form submission
$userRegisterController = new UserRegisterController();

if (isset($_POST['action'])) {
  $userRegisterController->processSubmitForm();
} else {
  $userRegisterController->displayRegisterForm();
}

class UserRegisterController {

  private $userRegisterModel;

  public function __construct()
  {
    $this->userRegisterModel = new UserRegisterModel();
  }

  public function displayRegisterForm() {
    require_once 'views/register/register_form.php';
  }

  public function processSubmitForm() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Check if the action parameter is provided in the POST data
      if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Handle the action based on the value of the 'action' parameter
        switch ($action) {
          case 'register':
            $this->handleRegistration();
            break;

          case 'modify':
            // Handle modify action
            break;

          default:
            // Handle invalid action
            echo 'Invalid action';
            break;
        }
      } else {
        // Handle action parameter missing
        echo 'Action parameter is missing';
      }
    } else {
      // Handle invalid request method
      echo 'Invalid request method';
    }
  }

  private function handleRegistration() {


    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $email = $_POST['email'];
    $username = $_POST['user-name'];
    $password = $_POST['new-password']; // No need to sanitize as it's hashed
    $contactNo = $_POST['contact-no'];
    // Validate the form data
    $response = $this->validateForm($firstName, $lastName, $email, $username, $password, $contactNo);
    header('Content-Type: application/json');
    echo $response;
    exit;
    break;
  }

  private function validateForm($firstName, $lastName, $email, $username, $password, $contactNo) {
    // Validate input fields
    if (!$this->validateFields($firstName, $lastName, $email, $username, $password, $contactNo)) {
      $response = [
        'message' => '<h4>Invalid input data.</h4><hr />please check input data.',
        'status' => 0 // Error status code
      ];
      return json_encode($response);
      
    }

    // Check if username already exists
    else if ($this->userRegisterModel->userAlreadyExists($username)) {
      $response = [
        'message' => '<h4 style="text-align:center">Username already exists.</h4><hr /> Please choose a different username.',
        'status' => 0 // Error status code
      ];
      return json_encode($response);
    }

    // Add user to the database
    else if ($this->userRegisterModel->addUser($firstName, $lastName, $email, $username, $password, $contactNo)) {
      $response = [
        'message' => '<h4 style="text-align:center">User registered successfully.</h4><hr /><i>Redirect to login:<i><a class="alert-link" href="?route=login">login page</a>',
        'status' => 1 // Success status code
      ];
      return json_encode($response);
    } else {
      $response = [
        'message' => '<h4>Registration failed.</h4><br> Please try again later.',
        'status' => 0 // Error status code
      ];
      return json_encode($response);
    }
  }

  private function validateFields($firstName, $lastName, $email, $username, $password, $contactNo) {
    // Add validation logic here (e.g., check if fields are not empty, email format is valid, etc.)
    // Return true if all fields are valid, false otherwise
    return !empty($firstName) && !empty($lastName) && !empty($email) && !empty($username) && !empty($password) && !empty($contactNo);
  }
}


?>

