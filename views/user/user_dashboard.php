<!-- views/user/dashboard.php -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!---<link rel="stylesheet" href="/css/styles.css"> -->
    <link rel="stylesheet" href="css/home-style.css">
    <link rel="stylesheet" href="css/alert.css">
    <link rel="stylesheet" href="css/user-dashboard-style.css">
    <link rel="stylesheet" href="css/respon-nav.css">
  </head>

  <body>
    <header>
    <div class = "slidebar">
      <a class="" href="?route=home">Home</a>
      <a id="regular-a"class="active" onclick="displayRegularQn()">Regular Practice</a>
      <a id="past-a"class="" onclick="displayPastQn()">Past Question Practice</a>
      <a id="report-a"class="" onclick="displayReports()">My Reports</a>
      <a id="profile-a"class="" onclick="displayProfile()">My Profile</a>
      <a class="" href="?route=logout">Log Out</a>
    </div>

</header>
    <div class="content">
      <div class="title" id="title">
        <h1>Regular Practice</h1>
</div>
      <section id="main">
      </section>
    </div>
<!-- Profile Edit Modal -->
<div id="editProfileModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeEditProfileModal()">&times;</span>
    <h2>Edit Profile</h2>
    <form id="editProfileForm">
      <label for="edit-first-name">First Name:</label>
      <input type="text" id="edit-first-name" name="fname" required>
      <br>
      <label for="edit-last-name">Last Name:</label>
      <input type="text" id="edit-last-name" name="lname" required>
      <br>
      <label for="edit-username">Username:</label>
      <input type="text" id="edit-username" name="uname" required>
      <br>
      <label for="edit-email">Email:</label>
      <input type="email" id="edit-email" name="email" required>
      <br>
      <label for="edit-contact-no">Contact No:</label>
      <input type="text" id="edit-contact-no" name="contact_no" required>
      <br>
      <button type="button" class="proceed" onclick="saveProfile()">Save Changes</button>

      <button type="button" class="abort" onclick="closeEditProfileModal()">Cancel</button>
    </form>
  </div>
</div>

    <div class="alert" id="message"></div>
    <script>
      var semSub = <?php echo $jsonSemSub; ?>;
    </script>
    <script src="js/customConfirm.js"></script> 
    <script src="js/userDashboard.js"></script> 
  </body>
</html>
