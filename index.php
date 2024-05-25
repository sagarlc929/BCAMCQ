
<?php
// Initialize session and error reporting
//session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
// Include necessary files and configurations
require_once "config.php";

// Sample route handling
$route = isset($_GET["route"]) ? $_GET["route"] : "home";

// Example: Routing logic to determine which controller and method to invoke
switch ($route) {
case "home":
  // Display the home page
  include "views/home.php";
  break;

case "login":
  // include the login controller
  require_once "controllers/LoginController.php";
  $loginController = new LoginController();
  $loginController->displayLoginForm();
  $loginController->processLogin();
  break;

case "register":
  // Include the user registration controller
  require_once "controllers/UserRegisterController.php"; 
  break;

case "user_dashboard":

  session_start();
  if (!isset($_SESSION['user_authenticated']) || $_SESSION['user_authenticated'] !== true) {
    header('Location: login.php');
    exit;
  }

  // Include the UserDashboardController
  require_once "controllers/UserDashboardController.php";
  $userDashboardController = new UserDashboardController();
  $userDashboardController->displayUserDashboard();
  break;

case "report":

  session_start();
  if (!isset($_SESSION['user_authenticated']) || $_SESSION['user_authenticated'] !== true) {
    header('Location: login.php');
    exit;
  }

  // Include the UserDashboardController
  require_once "controllers/UserReportController.php";
  /* $userDashboardController = new UserDashboardController(); */
  /* $userDashboardController->displayUserDashboard(); */
  break;

case "admin_dashboard":
  session_start();
  if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    header('Location:?route=admin');
    exit;
  }
  // Include the UserDashboardController
  require_once "controllers/AdminDashboardController.php";
  $adminDashboardController = new AdminDashboardController();
  $adminDashboardController->displayAdminDashboard();
  break;

case "quiz":

  session_start();
  if (!isset($_SESSION['user_authenticated']) || $_SESSION['user_authenticated'] !== true) {
    header('Location: login.php');
    exit;
  }

  // Include the QuizController
  require_once "controllers/QuizController.php";
  $quizController = new QuizController();
  $quizController->displayQuizPage();
  break;

case "admin":

  require_once "controllers/AdminLoginController.php";
  $adminLoginController = new AdminLoginController();
  $adminLoginController->displayAdminLoginForm();
  $adminLoginController->processAdminLogin();
  break;

case "user_manage":

  session_start();
  if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    header('Location:?route=admin');
    exit;
  }
  require_once "controllers/UserManageController.php";
  break;
case "question_manage":

  session_start();
  if (!isset($_SESSION['admin_authenticated']) || $_SESSION['admin_authenticated'] !== true) {
    header('Location:?route=admin');
    exit;
  }
  require_once "controllers/QuestionManageController.php";
  break;
case "logout":
  require_once "controllers/LogoutController.php";
  break;
default:
  // Handle 404 - Page Not Found
  http_response_code(404);
  echo "404 - Page Not Found";
  break;
}

?>
