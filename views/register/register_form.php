<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <link rel="stylesheet" href="css/UserDashboard.css">
    <link rel="stylesheet" href="css/register_form_style.css" />
  </head>
  <body>
    <h1>Registration Form</h1>
    <p>Please fill out this form with the required information</p>
    <form method="post" action='?route=register'>
      <fieldset>
        <label for="first-name">Enter Your First Name: <input id="first-name" name="first-name" type="text"  /></label>
        <label for="last-name">Enter Your Last Name: <input id="last-name" name="last-name" type="text"  /></label>
        <label for="email">Enter Your Email: <input id="email" name="email" type="email"  /></label>
        <label for="contact-no">Enter User Contact Number: <input id="contact-no" name="contact-no" type="text" /></label>
      </fieldset>
      <fieldset>
      <!--  <legend>Account type (required)</legend> -->
        <label for="user-name">Enter User Name: <input id="user-name" name="user-name" type="text" required /></label>
        <label for="new-password">Create a New Password: <input id="new-password" name="new-password" type="password"  required /></label>
        <label for="confirm-password">Confirm New Password: <input id="confirm-password" name="confirm-password" type="password"  /></label>
      </fieldset>
      <label for="terms-and-conditions">
        <input class="inline" id="terms-and-conditions" type="checkbox"  name="terms-and-conditions" /> I accept the <a href="abc.com">terms and conditions</a>
      </label>
      <input type="submit" value="Submit" />
    </form>
  </body>
</html>
