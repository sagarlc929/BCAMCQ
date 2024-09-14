<!--
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - BCA MCQ</title>
  <link rel="stylesheet" type="text/css" href="css/login-style.css">
  <link rel="stylesheet" type="text/css" href="css/reader.css">
</head>
<body>
  <header>


-->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to BCA MCQ</title>
  <link rel="stylesheet" href="css/home-style.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/respon-nav.css">

  <link rel="stylesheet" href="css/quiz-style.css">

  <link rel="stylesheet" type="text/css" href="css/login-style.css">
  <!-- Correct Font Awesome 5.15.4 link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
  <div class="slidebar flex-sidebar">
    <div>
    <a href="?route=home"><i class="fas fa-home"></i> Home</a>
    <a href="?route=login"><i class="fas fa-sign-in-alt"></i> Login</a>
    <a href="?route=register"><i class="fas fa-user-plus"></i> Register</a>
    </div>
    <div>
    <a class="active" href="?route=login_admin"><i class="fas fa-user-tie"></i> Admin</a>
    <a href="?route=about"><i class="fas fa-info-circle"></i> About</a>
   </div> 
  </div> 

  <div class="content">
</header> 
    <h1 style="padding:0.5rem;">Hi, Admin</h1>
  </header> 


  <form action="?route=login_admin" method="POST">
    
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required/>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required/>
    <button type="submit" class="text-base">Log In</button>
  </form>
</body>
</html>
