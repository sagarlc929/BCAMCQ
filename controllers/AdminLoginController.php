<!---
   $adminLoginController = new AdminLoginController();
    $adminLoginController->displayAdminLoginForm();
    $adminLoginController->processAdminLogin();
    break;

-->
<?php
// controllers/LoginController.php

require_once 'models/AdminLoginModel.php';
class AdminLoginController{
  public function displayAdminLoginForm(){
    include 'views/admin/admin_login.php';
  }

  public function processAdminLogin(){
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
        header('Location: ?route=admin_dashboard');
        exit;
      } else {
        //Failed Login 
        //You may set an error message and display it on the login form
        //For simplicity, we'll redirect back t the login form
        header('Location: ?route=admin');
        exit;
      }
    }
  }
  
  private function validateCredentials($username, $password){
    // Implement your logic to validate the credentials 
    // Check against the or any autthnication mechainsm
    // Return true on successful validation, false otherwise
    // Example: check aginst a user table in the database
    $adminLoginModel = new AdminLoginModel();
    return $adminLoginModel->validateCredentials($username, $password);
  }
}
?>
