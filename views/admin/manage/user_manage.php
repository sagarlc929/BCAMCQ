
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users Manage</title>
  <link rel="stylesheet" href="css/quiz-style.css">
  <link rel="stylesheet" href="css/respon-nav.css">
  <link rel="stylesheet" href="css/alert.css">
  <link rel="stylesheet" href="css/popup-box.css">
  <link rel="stylesheet" href="css/manage.css">
  <!-- Font Awesome CSS for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

  <div class="slidebar flex-sidebar">
 <div>
      <a href="?route=home"><i class="fas fa-home"></i> Home</a>
      <a class="active" href="?route=user_manage"><i class="fas fa-users"></i> Users Manage</a>
<a href="?route=question_manage" style="display: flex; gap: 5px;">
  <i class="fas fa-question-circle"></i>
  <p>Questions Manage</p> <!-- Properly closed the <p> tag -->
</a>
    </div>
    <div>
<a href="?route=logout" onclick="customConfirm('Are you sure you want to log out?', function(result) {
    if (result) {
        window.location.href = '?route=logout'; // Proceed with logout
    }
}); return false;">
    <i class="fas fa-sign-out-alt"></i> Log Out
</a>

    </div>
  </div>
</div>
  <div class="container content">
  <h1>User Manage</h1>
    <!-- Add a table to display user data -->
    <button type="button" class="add"  style ="display:block;"id="add-user">Add</button>
    <div class="table-container-user">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Username</th>
          <th>Email</th>
          <th>Contact Number</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Assuming $users is an array of user data retrieved from your database
      //row.id = "row-" + item.question_id;
        foreach ($users as $user) {
          echo "<tr id='row-" . $user['u_id'] . "' >";
          echo "<td>" . $user['u_id'] . "</td>";
          echo "<td>" . $user['fname'] . "</td>";
          echo "<td>" . $user['lname'] . "</td>";
          echo "<td>" . $user['uname'] . "</td>";
          echo "<td>" . $user['email'] . "</td>";
          echo "<td>" . $user['contact_no'] . "</td>";
          echo "<td>";
          echo "<button class='deleteBtn' type='button' data-user-id='" . $user['u_id'] . "' onclick='deleteUser(this.getAttribute(\"data-user-id\"))'>DELETE</button>";
          echo " ";
          echo "<button class='modifyBtn' type='button' data-user-id='" . $user['u_id'] . "' onclick='modifyUser(this.getAttribute(\"data-user-id\"))'>MODIFY</button>";
          echo "</td>";
          echo "</tr>";
        }
?>
      </tbody>
    </table>
    </div>
  </div>


<div id="popupOverlay" class="overlay-container">
 
<div class="popup-box">
  <h2 id="popup-title">Add New User</h2>
  
  <!-- Multi-column layout -->
  <div class="popup-content">
    <div class="column">
      <label for="first-name">First Name:</label>
      <input type="text" id="first-name" name="first-name" required="">

      <label for="last-name">Last Name:</label>
      <input type="text" id="last-name" name="last-name" required="">

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required="">
    </div>

    <div class="column">
      <label for="contact-no">Contact Number:</label>
      <input type="tel" id="contact-no" name="contact-no" required="">

      <label for="user-name">User Name:</label>
      <input type="text" id="user-name" name="user-name" required="">

      <label for="new-password">New Password:</label>
      <input type="password" id="new-password" name="new-password" required="">
      <label for="confirm-password">Confirm New Password:</label>
      <input type="password" id="confirm-password" name="confirm-password" required="">
    </div>
  </div>

  <!-- Buttons -->
  <div class="popup-buttons">
    <button id="btn-proceed" onclick="addUser()">Add User</button>
    <button class="btn-close-popup" onclick="togglePopup()">Close</button>
  </div>
</div>
</div>

<div class="alert" id="message"></div>
<script src="js/userManage.js"></script>
</body>

</html>

