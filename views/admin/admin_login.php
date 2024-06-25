
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
    <a href="?route=home"><img class="w-8 float-left" src="images/logo-black.png" alt="logo"></a>
    <h1>Hi, Admin</h1>
  </header> 


  <form action="?route=login_admin" method="POST">
    
    <label for="username">Username:</lable>
    <input type="text" id="username" name="username" required/>

    <label for="password">Password:</lable>
    <input type="password" id="password" name="password" required/>
    <button type="submit" class="text-base">Log In</button>
  </form>
</body>
</html>
