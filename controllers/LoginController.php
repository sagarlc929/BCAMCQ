<?php
// controllers/LoginController.php

require_once 'models/LoginModel.php';
class LoginController{
  public function displayLoginForm(){
    include 'views/login.php';
  }

  public function processLogin(){
    // Check if the login form s submitted
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      // Retrieve the submitted username and password
      $username = $_POST['username'];
      $password = $_POST['password'];

      //Validation the username and password (implement this)
      if($this->validateCredentials($username, $password)){
        // Successfull login
        // Redirect to the dashboard or another page
        session_start();

        // After successful login validation
        $_SESSION['user_authenticated'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $this->getCurrentUserId($username);

        echo"login successfull";
        header('Location: ?route=user_dashboard');
        exit;
      } else {
        //Failed Login 
        //You may set an error message and display it on the login form
        //For simplicity, we'll redirect back t the login form
        header('Location: ?route=login');
        exit;
      }
    }
  }
  
  private function validateCredentials($username, $password){
    $userModel = new LoginModel();
    return $userModel->validateCredentials($username, $password);
  }

  private function getCurrentUserId($username){
    $userModel = new LoginModel();
    return $userModel->getCurrentUserId($username);
  }
}
?>
