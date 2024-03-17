<!-- views/user/loign.php -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - BCA MCQ</title>
  <link rel="stylesheet" type="text/css" href"/css/styles.css">
</head>
<body>
  <h1>Login</h1>
  
  <form action="?route=login" method="POST">
    
    <label for="username">Username:</lable>
    <input type="text" id="username" name="username" required/>

    <label for="password">Password:</lable>
    <input type="password" id="password" name="password" required/>
    <button type="submit">Log In</button>
  </form>
</body>
</html>
