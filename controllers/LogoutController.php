<?php

$logoutController = new LogoutController;
$logoutController-> destroySess();
class LogoutController{
  public function destroySess() {

    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();

  }
}
?>
