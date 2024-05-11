
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management</title>
  <link rel="stylesheet" href="css/quiz-style.css">
  <!-- Add your CSS styles or include external stylesheets here -->
</head>

<body>
  <h1>User Management</h1>
  <div class="container">
    <!-- Add a table to display user data -->
    <div id="message"> hi</div>
    <button type="button" id="add">Add</button>
    <div class="table-container">
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
          echo "<td>" . "<button type='button' class='deleteBtn' id='delete'>Delete</button><button type='button' class='modifyBtn' id='modify'>Modify</button>" . "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
    </div>
  </div>
 <div id="popupOverlay" class="overlay-container">
    <div class="popup-box">
      <h2 style="color: gray;">Add New Question</h2>

      <label for="description">Description:</label>
      <input type="text" id="description" name="description" required><br>

      <label for="optionA">Option A:</label>
      <input type="text" id="optionA" name="optionA" required><br>

      <label for="optionB">Option B:</label>
      <input type="text" id="optionB" name="optionB" required><br>

      <label for="optionC">Option C:</label>
      <input type="text" id="optionC" name="optionC" required><br>

      <label for="optionD">Option D:</label>
      <input type="text" id="optionD" name="optionD" required><br>

      <label for="answer">Answer:</label>
      <input type="text" id="answer" name="answer" required><br>

      <label for="explanation">Explanation:</label>
      <textarea id="explanation" name="explanation" rows="4" cols="50" required></textarea><br>


      <select id="semesterSelect">
        <option value="">Select Semester</option>
      </select>

      <select id="subjectSelect">
        <option value="">Select Subject</option>
      </select>

      <button  id="add-question">Add Question</button>
     <button class="btn-close-popup" onclick="togglePopup()"> 
      Close 
    </button>
  </div>


  <script src="js/userManage.js"></script>
</body>

</html>

