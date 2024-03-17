
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Page</title>
    <link rel="styelsheet" href="/css/cssQuiz.css">
  <!-- Add your CSS styles or include external stylesheets here -->
  <style>
    /* Add your custom styles here */
    .question {
      display: none;
    }
    
body {
  font-family: 'Arial', sans-serif;
}

#quiz-container {
  max-width: 600px;
  margin: 50px auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 8px;
}

.options-container {
  display: flex;
  flex-direction: column;
}

.result-container {
  margin-top: 20px;
  font-weight: bold;
}

  </style>
</head>
<body>
  <h1>Quiz Page</h1>
  <p>Semester: <?php echo htmlspecialchars($_GET['sem']); ?></p>
  <p>Subject: <?php echo htmlspecialchars($_GET['subject']); ?></p>

  <!-- Add a container for questions -->
  <!--
 <div id="quiz-container">
  <div id="question-container"></div>
  <div id="options-container" class="options-container"></div>
  <button id="next-button" onclick="nextQuestion()">Next</button>
  <div id="result-container" class="result-container"></div>
</div>
-->

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
    var questions = <?php echo $jsonQuestions;?> 
  </script>
  <!-- Include your JavaScript for quiz functionality -->
  <script src="js/quiz.js"></script>
</body>
</html>
