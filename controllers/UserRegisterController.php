
<?php // UserRegisterController.php

require_once 'models/UserRegisterModel.php';

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
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Retrieve the submitted data
      $firstName = $_POST['first-name'];
      $lastName = $_POST['last-name'];
      $email = $_POST['email'];
      $username = $_POST['user-name'];
      $password = $_POST['new-password'];
      $contactNo = $_POST['contact-no'];

      // Validate the form data
      $response = $this->validateForm($firstName, $lastName, $email, $username, $password, $contactNo);
      header('Content-Type: application/json');
      echo $response;
      exit; // Ensure no further execution after echoing JSON response
    }
  }

  private function validateForm($firstName, $lastName, $email, $username, $password, $contactNo) {

    if ($this->userRegisterModel->userAlreadyExists($username)) {
      $response = [
        'message' => '<h4>Failed</h4><hr>Username already exists. Please choose a different username.',
        'status' => 0 // Error status code
      ];
      return json_encode($response);
    } elseif ($this->userRegisterModel->addUser($firstName, $lastName, $email, $username, $password, $contactNo)) {
      $response = [
        'message' => '<h4>User registered successfully</h4>.<hr><p><i>Redirecting to the <a class="alert-link"href="?route=login">login page</a></i></p>',
        'status' => 1 // Success status code
      ];
      return json_encode($response);
    } else {
      $response = [
        'message' => 'Registration failed. Please try again later.',
        'status' => 0 // Error status code
      ];
      return json_encode($response);
    }
  }
}
