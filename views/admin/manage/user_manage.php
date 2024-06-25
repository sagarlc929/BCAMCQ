
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management</title>
  <link rel="stylesheet" href="css/quiz-style.css">
  <link rel="stylesheet" href="css/alert.css">
  <link rel="stylesheet" href="css/respon-nav.css">
  <!-- Add your CSS styles or include external stylesheets here -->
</head>

<body>
      <div class = "slidebar">
      <a class="" href="?route=home">Home</a>
      <a class="active"href="?route=user_manage">Manage Users</a>
      <a class=""href="?route=question_manage">Manage Questions</a>
      <a class="split" href="#help">Help</a>
    </div>
  <div class="container content">
  <h1>User Management</h1>
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
        foreach ($users as $user) {
          echo "<tr>";
          echo "<td>" . $user['u_id'] . "</td>";
          echo "<td>" . $user['fname'] . "</td>";
          echo "<td>" . $user['lname'] . "</td>";
          echo "<td>" . $user['uname'] . "</td>";
          echo "<td>" . $user['email'] . "</td>";
          echo "<td>" . $user['contact_no'] . "</td>";
          echo "<td>" . "<button class='deleteBtn' type='button' data-user-id='". $user['u_id'] . "' onclick='deleteUser(this.getAttribute('data-user-id'))'>DELETE</button> <button class='modifyBtn' type='button' data-user-id='". $user['u_id'] . "' onclick='modifyUser(this.getAttribute('data-user-id'))'>MODIFY</button>" . "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
    </div>
  </div>


<div id="popupOverlay" class="overlay-container">
  <div class="popup-box">
    <h2>Add New User</h2>

    <label for="first-name">First Name:</label>
    <input type="text" id="first-name" name="first-name" required>
    <label for="last-name">Last Name:</label>
    <input type="text" id="last-name" name="last-name" required>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <label for="contact-no">Contact Number:</label>
    <input type="tel" id="contact-no" name="contact-no" required>
    <label for="user-name">User Name:</label>
    <input type="text" id="user-name" name="user-name" required>
    <label for="new-password">New Password:</label>
    <input type="password" id="new-password" name="new-password" required>
    <label for="confirm-password">Confirm New Password:</label>
    <input type="password" id="confirm-password" name="confirm-password" required>
    <button id="add-user-proceed" onclick="addUser()">Add User</button>
    <button class="btn-close-popup" onclick="togglePopup()">Close</button>
  </div>
</div>

<div class="alert" id="message"></div>
<script src="js/userManage.js"></script>
</body>

</html>

