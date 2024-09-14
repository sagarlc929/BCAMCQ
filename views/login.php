
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
    <a class="active" href="?route=login"><i class="fas fa-sign-in-alt"></i> Login</a>
    <a href="?route=register"><i class="fas fa-user-plus"></i> Register</a>
    </div>
    <div>
    <a href="?route=login_admin"><i class="fas fa-user-tie"></i> Admin</a>
    <a href="?route=about"><i class="fas fa-info-circle"></i> About</a>
   </div> 
  </div> 

  <div class="content">
  <header>
    <h1>Login</h1>
  </header>  
  <form action="?route=login" method="POST">
    
    <label for="username">Username:</lable>
    <input type="text" id="username" name="username" required/>

    <label for="password">Password:</lable>
    <input type="password" id="password" name="password" required/>
    <button type="submit">Log In</button>
  </form>

<p style="padding-top: 10px;">Don’t have an account?<a href="?route=register">Sign up here.</a></p>
</div>
</body>
</html>
