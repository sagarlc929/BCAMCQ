
<?php // UserRegisterController.php

require_once 'models/UserProfileModel.php';

class UserProfileController {

  private $userProfileModel;

  public function __construct()
  {
    $this->userProfileModel = new UserProfileModel();
  }

 public function processUserProfile() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Check if the action parameter is provided in the POST data
      if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Handle the action based on the value of the 'action' parameter
        switch ($action) {
          case 'update_profile':
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $uname = $_POST['uname'];
            $email = $_POST['email'];
            $contact_no = $_POST['contact_no']; 
            $currentUser = $_SESSION['user_id'];

            // Validate input and check for uniqueness
            if ($this->infoInvalid($currentUser, $uname, $email)) {
              $response = [
                'message' => '<h4 style="text-align:center">Username or email already exists.</h4><hr /> Please choose different credentials.',
                'status' => 0 // Error status code
              ];
            } elseif ($this->updateProfile($currentUser, $fname, $lname, $uname, $email, $contact_no)) {
              $response = [
                'message' => '<h4 style="text-align:center">Profile updated successfully.</h4><hr /><i>Redirect to login:</i> <a class="alert-link" href="?route=login">login page</a>',
                'status' => 1 // Success status code
              ];
            } else {
              $response = [
                'message' => 'Failed to update profile.',
                'status' => 0 // Error status code
              ];
            }

            // Return JSON response
            header('Content-Type: application/json');
            echo json_encode($response);
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

  // Function to validate the info
  private function infoInvalid($currentUser, $userName, $email) {
    return $this->userProfileModel->modelInfoInvalid($currentUser, $userName, $email);
  }

  // Function to update the profile
  private function updateProfile($currentUser, $fname, $lname, $uname, $email, $contact_no) {
    return $this->userProfileModel->modelUpdateProfile($currentUser, $fname, $lname, $uname, $email, $contact_no);
  }
}
?>

