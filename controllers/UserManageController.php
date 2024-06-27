<?php
require_once 'models/UserManageModel.php'; // Include the model file first

$userManageController = new UserManageController();

if (isset($_POST['action'])) {
  $userManageController->processUserManage();
} else {
  $userManageController->displayUserManageDashboard();
}

class UserManageController
{
  private $userManageModel;

  public function __construct()
  {
    $this->userManageModel = new UserManageModel();
  }

  public function displayUserManageDashboard()
  {
    $users = $this->userManageModel->getAllUsers(); 
    require_once 'views/admin/manage/user_manage.php';
  }

  public function processUserManage(){

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Check if the action parameter is provided in the POST data
      if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Handle the action based on the value of the 'action' parameter
        switch ($action) {

        case 'delete':
          // Check if the user ID is provided in the POST data
          if (isset($_POST['user_id'])) {
            $userId = $_POST['user_id'];

            // Perform the deletion operation and store the result in $deleted
            $deleted = $this->deleteUser($userId);
            if ($deleted) {
              // Redirect back to the user manage page after deletion
              $response = [
                'message' => "Deleted successfully user ID $userId",
                'status' => 1
              ];
            } else {
              $response = [
                'message' => 'Failed to delete user',
                'status' => 0
              ];
            }
          } else {
            // Handle the case where user ID is missing
            $response = [
              'message' => 'User ID is missing',
              'status' => 0
            ];
          }
          header('Content-Type: application/json');
          echo json_encode($response);
          exit;
          break;
        case 'updateUser':
          $id = $_POST['id'];
          $firstName = $_POST['first-name'];
          $lastName = $_POST['last-name'];
          $email = $_POST['email'];
          $contactNo = $_POST['contact-no'];
          $userName = $_POST['user-name'];
          $newPassword = $_POST['new-password'];

          $response = $this->updateUser($id, $firstName, $lastName, $email, $contactNo, $userName, $newPassword);

          header('Content-Type: application/json');
          echo json_encode($response);
          exit;
          break;

        case 'addNewUser':

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
    else if ($this->userManageModel->userAlreadyExists($username)) {
      $response = [
        'message' => '<h4 style="text-align:center">Username already exists.</h4><hr /> Please choose a different username.',
        'status' => 0 // Error status code
      ];
      return json_encode($response);
    }

    // Initialize the variable $success
    $success = false;

    // Add user to the database
    list($success, $id) = $this->userManageModel->addUser($firstName, $lastName, $email, $username, $password, $contactNo);

    if ($success) {
      $response = [
        'message' => '<h4 style="text-align:center">User registered successfully.</h4>',
        'status' => 1, // Success status code
        'id' => $id
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

  private function updateUser($id, $firstName, $lastName, $email, $contactNo, $userName, $newPassword) {
    return $this->userManageModel->updateUser($id, $firstName, $lastName, $email, $contactNo, $userName, $newPassword);
  }
  private function deleteUser($userId){
    return $this->userManageModel->deleteUser($userId);
  }
}
?>

