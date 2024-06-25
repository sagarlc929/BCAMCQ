
<!-- views/user/dashboard.php -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!---<link rel="stylesheet" href="/css/styles.css"> -->
    <link rel="stylesheet" href="css/home-style.css">
    <link rel="stylesheet" href="css/user-dashboard-style.css">
  </head>
  <body>
  <header>
    <a href="?route=home"><img class="w-8 float-left" src="images/logo-black.png" alt="logo"></a>
    <h1>User Dashboard</h1>
  </header> 
    <!-- Include dashboard content -->
    <!-- Fetch and display semester list from the database -->
    <div id="semester"></div>
    <script>
      var semSub = <?php echo $jsonSemSub; ?>;
    </script>
    <script src="js/UserDashboard.js"></script> 
  </body>
</html>
