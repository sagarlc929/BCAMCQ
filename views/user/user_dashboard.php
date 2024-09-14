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
    <link rel="stylesheet" href="css/popup-box.css">
    <link rel="stylesheet" href="css/user-dashboard-style.css">
    <link rel="stylesheet" href="css/respon-nav.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  </head>

  <body>
    <header>
<div class="slidebar flex-sidebar">
    <div>
        <a href="?route=home"><i class="fas fa-home"></i> Home</a>
        <a id="regular-a" class="active" onclick="displayRegularQn()" style="display:flex; gap:5px;">
            <i class="fas fa-calendar-day"></i><p>Regular Question Practice</p>
        </a>
        <a id="past-a" class="" onclick="displayPastQn()" style="display:flex; gap:5px;">
            <i class="fas fa-history"></i> <p>Past Question Practice</p>
        </a>
    </div>
    <div>
        <a id="report-a" class="" onclick="displayReports()">
            <i class="fas fa-chart-line"></i> My Reports
        </a>
        <a id="profile-a" class="" onclick="displayProfile()">
            <i class="fas fa-user"></i> My Profile
        </a>
     <a href="?route=logout" onclick="customConfirm('Are you sure you want to log out?', function(result) {
    if (result) {
        window.location.href = '?route=logout'; // Proceed with logout
    }
}); return false;">
    <i class="fas fa-sign-out-alt"></i> Log Out
</a>
    </div>
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
      <div class="form-column">
        <div class="column">
          <label for="edit-first-name">First Name:</label>
          <input type="text" id="edit-first-name" name="fname" required>

          <label for="edit-last-name">Last Name:</label>
          <input type="text" id="edit-last-name" name="lname" required>

          <label for="edit-username">Username:</label>
          <input type="text" id="edit-username" name="uname" required>
        </div>

        <div class="column">
          <label for="edit-email">Email:</label>
          <input type="email" id="edit-email" name="email" required>

          <label for="edit-contact-no">Contact No:</label>
          <input type="text" id="edit-contact-no" name="contact_no" required>
        </div>
      </div>

      <div class="form-buttons">
        <button type="button" class="proceed" onclick="saveProfile()">Save Changes</button>
        <button type="button" class="abort" onclick="closeEditProfileModal()">Cancel</button>
      </div>
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
