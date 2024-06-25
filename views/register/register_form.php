
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration Form</title>
  <link rel="stylesheet" href="css/UserDashboard.css">
  <link rel="stylesheet" href="css/register_form_style.css" />
  <link rel="stylesheet" href="css/alert.css" />
  <link rel="stylesheet" href="css/home-style.css" />
  
</head>
<body>
  <header>
    <a href="?route=home"><img class="w-8 float-left" src="images/logo-black.png" alt="logo"></a>
    <h1>Registration Form</h1>
  </header> <form id="registrationForm" class="form-container" method="post" action="?route=register">

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
      <span>I accept the <a href="abc.com">terms and conditions</a></span>
    </label>
    <input type="hidden" name="action" value="register"/>
    <button id="submit" type="submit">Submit</button>
  </form>
  <div class="alert" id="message"></div>
  <script src="js/register_form.js"></script>
</body>
</html>

