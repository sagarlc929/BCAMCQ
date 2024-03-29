
<?php
// controllers/UserRegister.php

require_once 'models/UserRegisterModel.php';
class UserRegisterController{
  public function displayRegisterForm(){
    include 'views/register/register_form.php';
  }

  public function processSubmitForm(){
    // Check if the form is submitted
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      // Retrieve the submitted data
      $firstName = $_POST['first-name'];
      $lastName = $_POST['last-name'];
      $email = $_POST['email'];
      $username = $_POST['user-name'];
      $password = $_POST['new-password'];
      $contactNo = $_POST['contact-no'];

      // Validate the form data
      $error = $this->validateForm($firstName, $lastName, $email, $username, $password, $contactNo);
      if (!$error) {
        // Successful registration
        echo <<<HTML
        <form method="post" action="?route=login">
          You are registered successfully. Please login to continue.
        </form>
        HTML;

        // Redirect to the login page after a delay
        header('Location: ?route=login');
        exit;
      } else {
        // Failed registration
        echo "Registration failed"; // You can display an error message here
        echo "<br>Error: $error"; // Display the specific error message
        // For simplicity, we'll redirect back to the registration form after a delay
        header('Location: ?route=register');
        exit;
      }
    }
  }
  
  private function validateForm($firstName, $lastName, $email, $username, $password, $contactNo) {
    $registerModel = new UserRegisterModel();
    if ($registerModel->userAlreadyExists($username)) {
      return "Username already exists. Please choose a different username.";
    } elseif ($registerModel->addUser($firstName, $lastName, $email, $username, $password, $contactNo)) {
      return ""; // No error
    } else {
      return "Registration failed. Please try again later."; // Generic error message
    }
  }
}
