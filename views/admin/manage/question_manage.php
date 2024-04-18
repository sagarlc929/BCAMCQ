
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
<div id="message" style =""> hi</div>
<div class="container">
  <button type="button" id="add">Add</button>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Description</th>
                        <th>Option A</th>
                        <th>Option B</th>
                        <th>Option C</th>
                        <th>Option D</th>
                        <th>Answer</th>
                        <th>Explanation</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>
    </div>
<p>hi sagar</p>
  <!-- Add a container for questions -->
<!--
 <form action="?route=question_manage" method="POST">
  <input type="hidden" name="action" value="new">
</form>
  <div id="questions">

    <div id="question-container"></div>
    <div id="options-container" class="options-container"></div>
    <button id="next-button" onclick="checkAnswer()">Next</button>
  </div>

  <div id="result-container" class="result-container" style="display:none;">
    <div id="result-marks" class="result"></div>
    <div id="correct-answer" class="correct-answer"></div>
  </div>
<div id= "menu-card" style="display:none;"></div>
-->
  <script>
    var allQuestion = <?php echo json_encode($allQuestion); ?>;
  </script>
<script src="js/questionManage.js">
</script> 
<script src="jquery/jquery-3.7.1.js"></script>
</body>
</html>
