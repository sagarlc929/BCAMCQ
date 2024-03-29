
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Qestion Manage</title>
  <link rel="stylesheet" href="css/quiz-style.css">
  <!-- Add your CSS styles or include external stylesheets here -->

</head>
<body>
  <h1>Question Manage</h1>
  <!-- Add a container for questions -->
 <form action="?route=question_manage" method="POST">
  <input type="hidden" name="action" value="new">
  <button type="submit">Add</button>
  <div id="questions">

<!--
    <div id="question-container"></div>
    <div id="options-container" class="options-container"></div>
    <button id="next-button" onclick="checkAnswer()">Next</button>
  </div>

  <div id="result-container" class="result-container" style="display:none;">
    <div id="result-marks" class="result"></div>
    <div id="correct-answer" class="correct-answer"></div>
-->
  </div>
  <script>
    var allQuestion = <?php echo json_encode($allQuestion); ?>;
  </script>
<script src="js/questionManage.js">
</script> 
</body>
</html>
