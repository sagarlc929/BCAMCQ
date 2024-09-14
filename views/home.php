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
  <!-- Correct Font Awesome 5.15.4 link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
  <div class="slidebar flex-sidebar">
    <div>
    <a class="active" href="?route=home"><i class="fas fa-home"></i> Home</a>
    <a href="?route=login"><i class="fas fa-sign-in-alt"></i> Login</a>
    <a href="?route=register"><i class="fas fa-user-plus"></i> Register</a>
    </div>
<div>
  <a href="?route=login_admin"><i class="fas fa-user-tie"></i> Admin</a>
 <a href="?route=about"><i class="fas fa-info-circle"></i> About</a>
</div>
  </div> 

  <div class="section">
    <div class="content">
      <h1>Welcome to BCA MCQ</h1>
      <h2>About BCA MCQ</h2>
      <p>
        BCA MCQ is an innovative platform designed to enhance academic performance through dynamic multiple-choice question (MCQ) practice.
      </p>
<div style="display: flex; justify-content: left; min-width: 600px;">
      <!-- Quiz Container -->
      <div id="quiz-container">
        <div id="question-container"></div>
        <div id="options-container" class="options-container"></div>
      </div>

      <!-- Result Container (hidden initially) -->
      <div id="correct-answer" class="correct-answer"></div>
    </div>
</div>
  </div>
  <script src="js/homePage.js"></script>
</body>
</html>