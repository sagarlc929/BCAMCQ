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
    <div class = "slidebar">
      <a class="" href="?route=home">Home</a>
      <a id="regular-a"class="active" onclick="displayRegularQn()">Regular Practice</a>
      <a id="past-a"class="" onclick="displayPastQn()">Past Question Practice</a>
      <a id="report-a"class="" onclick="displayReports()">My Reports</a>
      <a class="" href="?route=logout">Log Out</a>
    </div>
    <div class="content">
      <header>
        <h1>Regular Practice</h1>
      </header> 
      <section id="main">
      </section>
    </div>
    <div class="alert" id="message"></div>
    <script>
      var semSub = <?php echo $jsonSemSub; ?>;
    </script>
    <script src="js/userDashboard.js"></script> 
  </body>
</html>
