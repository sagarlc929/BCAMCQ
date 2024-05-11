<?php
require_once 'models/UserManageModel.php'; // Include the model file first

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
}

$userManageController = new UserManageController();
$userManageController->displayUserManageDashboard();
?>

