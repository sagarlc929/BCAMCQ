
<?php
// controllers/UserRegister.php

require_once 'models/UserModel.php';
class UserRegister{
  public function displayRegister(){
    include 'views/register/register_form.php';
  }

  public function processSubmitForm(){
    // Check if the login form s submitted
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      // Retrieve the submitted username and password
      $username = $_POST['username'];
      $password = $_POST['password'];

      //Validation the username and password (implement this)
      if($this->validateCredentials($username, $password)){
        // Successfull login
        // Redirect to the dashboard or another page
        $_SESSION['usrname']=$username;
        echo"login successfull";
        header('Location: ?route=user_dashboard');
        exit;
      } else {
        //Failed Login 
        echo "Login failed";
        //You may set an error message and display it on the login form
        //For simplicity, we'll redirect back t the login form
        header('Location: ?route=login');
        exit;
      }
    }
  }
  
  private function validateCredentials($username, $password){
    // Implement your logic to validate the credentials 
    // Check against the or any autthnication mechainsm
    // Return true on successful validation, false otherwise
    // Example: check aginst a user table in the database
    $userModel = new UserModel();
    return $userModel->validateCredentials($username, $password);
  }
}
?>
