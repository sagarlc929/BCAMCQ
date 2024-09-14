<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to BCA MCQ</title>
  <link rel="stylesheet" href="css/home-style.css">
  <link rel="stylesheet" href="css/header.css">

  <link rel="stylesheet" href="css/alert.css">
  <link rel="stylesheet" href="css/respon-nav.css">

  <link rel="stylesheet" href="css/quiz-style.css">

  <link rel="stylesheet" href="css/register_form_style.css" />
  <!-- <link rel="stylesheet" type="text/css" href="css/login-style.css"> -->
  <!-- Correct Font Awesome 5.15.4 link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
  <div class="slidebar flex-sidebar">
    <div>
    <a href="?route=home"><i class="fas fa-home"></i> Home</a>
    <a href="?route=login"><i class="fas fa-sign-in-alt"></i> Login</a>
    <a class="active" href="?route=register"><i class="fas fa-user-plus"></i> Register</a>
    </div>
    <div>
    <a href="?route=login_admin"><i class="fas fa-user-tie"></i> Admin</a>
    <a href="?route=about"><i class="fas fa-info-circle"></i> About</a>
   </div> 
  </div> 

  <div class="content">

  <header>
    <h1>Registration Form</h1>
  </header> 
<form id="registrationForm" class="form-container" method="post" action="?route=register">

    <fieldset>
      <label for="first-name">Enter Your First Name: <input id="first-name" name="first-name" type="text" required /></label>
      <label for="last-name">Enter Your Last Name: <input id="last-name" name="last-name" type="text" required /></label>
      <label for="email">Enter Your Email: <input id="email" name="email" type="email" required /></label>
      <label for="contact-no">Enter User Contact Number: <input id="contact-no" name="contact-no" type="tel" required /></label>
    </fieldset>
    <fieldset>
      <label for="user-name">Enter User Name: <input id="user-name" name="user-name" type="text" required /></label>
      <label for="new-password">Create a New Password: <input id="new-password" name="new-password" type="password" required /></label>
      <label for="confirm-password">Confirm New Password: <input id="confirm-password" name="confirm-password" type="password" required /></label>
    </fieldset>

   <label for="terms-and-conditions">
  <input class="inline" id="terms-and-conditions" type="checkbox" name="terms-and-conditions" required />
  <span>I accept the <a href="abc.com" style="display: inline;">terms and conditions</a>.</span>
</label>
    <input type="hidden" name="action" value="register"/>
    <button style="width: 80%;" id="submit" type="submit">Submit</button>
  </form>
</div>
  <div class="alert" id="message"></div>
  <script src="js/register_form.js"></script>
</body>
</html>

