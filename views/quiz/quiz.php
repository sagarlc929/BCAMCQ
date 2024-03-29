
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz Page</title>
  <link rel="stylesheet" href="css/quiz-style.css">
  <!-- Add your CSS styles or include external stylesheets here -->

</head>
<body>
<header>
  <h1>Quiz Page</h1>
</header>
<section>
  <p>Semester: <?php echo htmlspecialchars($_GET['sem']); ?></p>
  <p>Subject: <?php echo htmlspecialchars($_GET['subject']); ?></p>

  <!-- Add a container for questions -->
  <div id="quiz-container">
    <div id="question-container"></div>
    <div id="options-container" class="options-container"></div>
    <button id="next-button" onclick="checkAnswer()">Next</button>
  </div>

  <div id="result-container" class="result-container" style="display:none;">
    <div id="result-marks" class="result"></div>
    <div id="correct-answer" class="correct-answer"></div>
  </div>

  <script>
    var questions = <?php echo json_encode($formattedQuestions); ?>;
  </script>
  <script src="js/quiz.js"></script>
</section>
</body>
</html>
