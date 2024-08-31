<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qestion Manage</title>
    <link rel="stylesheet" href="css/quiz-style.css">
    <link rel="stylesheet" href="css/respon-nav.css">
    <link rel="stylesheet" href="css/alert.css">
    <link rel="stylesheet" href="css/manage.css">
    <!-- Add your CSS styles or include external stylesheets here -->
  </head>
  <body>
    <div class = "slidebar">
      <a class="" href="?route=home">Home</a>
      <a class=""href="?route=user_manage">Manage Users</a>
      <a class="active"href="?route=question_manage">Manage Questions</a>
      <a class="" href="?route=logout">Log Out</a>
    </div>
    <div class="content">
      <h1>Question Manage</h1>
      <div class="select-options-div">
        <select class= "select-option" id="semesterSelect">
          <option value="">Select Semester</option>
        </select>
        <select  class= "select-option" id="subjectSelect">
        <option value="">Select Subject</option>
        </select>
      </div>
      <div id="message" class="alert"></div>
        <div class="container">
          <button type="button" id="add">Add</button>
          <div id="select-sem-sub-mes">
           <p> select semester and subject</p> 
          </div>        
          <div id="table-container"class="table-container">
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
      <div id="popupOverlay" class="overlay-container">
        <div class="popup-box">
          <h2>Add New Question</h2>
          <div class="selected-sem-sub">
            <p>Selected Semester: <span id="selected-sem-span"></span></p>
            <p>Selected Subject: <span id="selected-sub-span"></span></p>
          </div>
          <label for="description">Description:</label>
          <input type="text" id="description" name="description" required><br>

          <label for="optionA">Option A:</label>
          <div class="option-btn">
          <input type="text" id="optionA" class="opt-txt" name="optionA" required><input type="radio" name="opt-rad" id="radOpt-A" checked>
          </div>
          <div class="option-btn">
          <label for="optionB">Option B:</label>
          <input type="text" id="optionB" class="opt-txt" name="optionB" required><input type="radio" name="opt-rad"  id="radOpt-B">
          </div>

          <div class="option-btn">
          <label for="optionC">Option C:</label>
          <input type="text" id="optionC" class="opt-txt"  name="optionC" required><input type="radio" name="opt-rad"  id="radOpt-C">
          </div>

          <div class="option-btn">
          <label for="optionD">Option D:</label>
          <input type="text" id="optionD" class="opt-txt" name="optionD" required><input type="radio" name="opt-rad"  id="radOpt-D">
          </div>

          <label for="explanation">Explanation:</label>
          <textarea id="explanation" name="explanation" rows="4" cols="50" required></textarea><br>

          <button id="proceedBtn">proced button</button>
          <button class="btn-close-popup" onclick="togglePopup()">Close</button>
        </div>
      </div>
      <div class="alert" id="message"></div>
    </div>

<script>
var semesterSubjects = <?php echo json_encode($semSub); ?>;
</script>
    <script src="js/questionManage.js"></script>
  </body>

</html>
