
<?php
// Initialize session and error reporting
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Include necessary files and configurations
require_once 'config.php';

// Sample route handling
$route = isset($_GET['route']) ? $_GET['route'] : 'home';

// Example: Routing logic to determine which controller and method to invoke
switch ($route) {
    case 'home':
        // Display the home page
        include 'views/home.php';
        break;

    case 'login':
        // include the login controller
        require_once 'controllers/LoginController.php';
        $loginController = new LoginController();
        $loginController->displayLoginForm();
        $loginController->processLogin();
        break;

    case 'register':
        // Include the user registration controller
        require_once 'controllers/UserRegisterController.php';
        $userRegisterController = new UserRegisterController();
        $userRegisterController->displayRegisterForm();
        $userRegisterController->processSubmitForm();
        break;

    case 'user_dashboard':
        // Include the UserDashboardController
        require_once 'controllers/UserDashboardController.php';
        $userDashboardController = new UserDashboardController();
        $userDashboardController->displayUserDashboard();
        break;
 case 'admin_dashboard':
        // Include the UserDashboardController
        require_once 'controllers/AdminDashboardController.php';
        $adminDashboardController = new AdminDashboardController();
        $adminDashboardController->displayAdminDashboard();
        break;

    case 'quiz':
        // Include the QuizController
        require_once 'controllers/QuizController.php';
        $quizController = new QuizController();
        $quizController->displayQuizPage();
        break;

    case 'admin':
        require_once 'controllers/AdminLoginController.php';
        $adminLoginController = new AdminLoginController();
        $adminLoginController->displayAdminLoginForm();
        $adminLoginController->processAdminLogin();
        break;
    case 'user_manage':
        require_once 'controllers/UserManageController.php';
        $userManageController = new UserManageController();
        $userManageController->displayUserManageDashboard();
        break;
    case 'question_manage':
        require_once 'controllers/QuestionManageController.php';
        $questionManageController = new QuestionManageController();
        $questionManageController->displayQuestionManageDashboard();
        $questionManageController->processQuestionManage();
        break;
    case 'question_form':
      require_once 'controllers/QuestionFormController.php';
      $questionFormController = new QuestionFormController;
      $questionFormController->displayQuestionFrom();
      //$questionManageController->processQuestionFormSubmittion();
      break;
    default:
        // Handle 404 - Page Not Found
        http_response_code(404);
        echo '404 - Page Not Found';
        break;
}
?>

