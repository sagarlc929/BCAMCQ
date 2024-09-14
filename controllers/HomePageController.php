<?php
// HomePageController.php

require_once 'models/HomePageModel.php';

$homePageController = new HomePageController();

// Determine request type and process accordingly
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $homePageController->processQuestionManage(); // Handle POST requests
} else {
    // Serve the home page for GET requests
    $homePageController->showHomePage();
}

class HomePageController {
    private $homePageModel;

    public function __construct() {
        // Instantiate the model
        $this->homePageModel = new HomePageModel();
    }

    // Handle POST requests for question management
    public function processQuestionManage() {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
            error_log("Action received: " . $action); // Log the action

            switch ($action) {
                case 'getARanQuestion':
                    $modelResponse = $this->getARanQuestion();
                    if ($modelResponse) {
                        $response = [
                            'message' => "Success",
                            'status' => 1,
                            'data' => $modelResponse
                        ];
                    } else {
                        $response = [
                            'message' => "No question found.",
                            'status' => 0
                        ];
                    }
                    break;
                
                default:
                    $response = [
                        'message' => "Invalid action.",
                        'status' => 0
                    ];
                    break;
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        } else {
            error_log("No action received");
        }
    }

    // Private function to get a random question
    private function getARanQuestion() {
        return $this->homePageModel->getARanQuestionModel();
    }

    // Display the home page
    public function showHomePage() {
        require_once 'views/home.php';
    }
}
?>

