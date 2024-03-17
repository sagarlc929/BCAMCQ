
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include necessary files and configurations
require_once 'config.php';
require_once 'controllers/UserController.php'; 
require_once 'controllers/LoginController.php';
require_once 'controllers/UserRegister.php';
require_once 'controllers/UserDashboardController.php';
require_once 'controllers/QuizController.php';

// Sample route handling
$route = isset($_GET['route']) ? $_GET['route'] : 'home';

// Example: Routing logic to determine which controller and method to invoke
switch($route){
  case 'home':
    // Display the home page
    include 'views/home.php';
    break;

  case 'login':
    // Include the login controller
    $loginController = new LoginController();
    $loginController->displayLoginForm();
    $loginController->processLogin();
    break;

  case 'register':
    // Include the user registration controller
    $userRegister = new UserRegister();
    $userRegister->displayRegisterForm();
    $userRegister->processSubmitForm();
    break;

  case 'user_dashboard':
    // Include the UserDashboardController
    $userDashboardController = new UserDashboardController();
    $userDashboardController->displayUserDashboard();
    break;

  case 'quiz':
    // Include the QuizController
    $quizController = new QuizController();
    $quizController->displayQuizPage();
    break;

  default: 
    // Handle 404 - Page Not Found
    http_response_code(404);
    echo '404 - Page Not Found';
    break;
}
?>

