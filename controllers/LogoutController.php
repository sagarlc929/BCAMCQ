
<?php

// Start the session (if not already started)
session_start();

$logoutController = new LogoutController;
$logoutController->destroySess();

// Redirect to the home page
header("Location:?route=home");
exit();

class LogoutController {
  public function destroySess() {

    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();
  }
}
?>

