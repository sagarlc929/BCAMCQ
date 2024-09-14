
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Questions Manage</title>
  <link rel="stylesheet" href="css/quiz-style.css">
  <link rel="stylesheet" href="css/popup-box.css">
  <link rel="stylesheet" href="css/respon-nav.css">
  <link rel="stylesheet" href="css/alert.css">
  <link rel="stylesheet" href="css/manage.css">
  <!-- Font Awesome CSS for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
  /* General form styling */
  .year-label {
    font-size: 1.2rem;
    color: #333;
    margin-right: 10px;
  }

  .year-dropdown {
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f9f9f9;
    color: #555;
    width: 200px;
    transition: border-color 0.3s ease, background-color 0.3s ease;
  }

  .year-dropdown:hover {
    border-color: #888;
    background-color: #fff;
  }

  .year-dropdown:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
  }

  /* Media queries for responsiveness */
  @media (max-width: 768px) {
    .year-dropdown {
      width: 100%;
    }
  }
</style>
</head>
<body>

  <div class="slidebar flex-sidebar">
 <div>
      <a href="?route=home"><i class="fas fa-home"></i> Home</a>
      <a  href="?route=user_manage"><i class="fas fa-users"></i> Users Manage</a>
<a class="active" href="?route=question_manage" style="display: flex; gap: 5px;">
  <i class="fas fa-question-circle"></i>
  <p>Questions Manage</p> <!-- Properly closed the <p> tag -->
</a>
    </div>
    <div>
<a href="?route=logout" onclick="customConfirm('Are you sure you want to log out?', function(result) {
    if (result) {
        window.location.href = '?route=logout'; // Proceed with logout
    }
}); return false;">
    <i class="fas fa-sign-out-alt"></i> Log Out
</a>
    </div>
  </div>
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
                  <th>year</th>
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

  <!-- Semester and Subject Information -->
  <div class="selected-sem-sub">
    <p>Selected Semester: <span id="selected-sem-span"></span></p>
    <p>Selected Subject: <span id="selected-sub-span"></span></p>
  </div>

  <!-- Multi-column layout for the form content -->
  <div class="popup-content">
    
    <!-- Column 1: Description and Options -->
    <div class="column">
      <!-- Description -->
      <label for="description">Description:</label>
      <input type="text" id="description" name="description" required>

      <!-- Option A -->
      <label for="optionA">Option A:</label>
      <div class="option-btn">
        <input type="text" id="optionA" class="opt-txt" name="optionA" required>
        <input type="radio" name="opt-rad" id="radOpt-A" checked>
      </div>

      <!-- Option B -->
      <label for="optionB">Option B:</label>
      <div class="option-btn">
        <input type="text" id="optionB" class="opt-txt" name="optionB" required>
        <input type="radio" name="opt-rad" id="radOpt-B">
      </div>
    </div>

    <!-- Column 2: Options and Explanation -->
    <div class="column">
      <!-- Option C -->
      <label for="optionC">Option C:</label>
      <div class="option-btn">
        <input type="text" id="optionC" class="opt-txt" name="optionC" required>
        <input type="radio" name="opt-rad" id="radOpt-C">
      </div>

      <!-- Option D -->
      <label for="optionD">Option D:</label>
      <div class="option-btn">
        <input type="text" id="optionD" class="opt-txt" name="optionD" required>
        <input type="radio" name="opt-rad" id="radOpt-D">
      </div>

      <!-- Explanation -->
      <label for="explanation">Explanation:</label>
      <textarea id="explanation" name="explanation" rows="3" cols="50" required></textarea>
    </div>
  </div>
<label for="year" class="year-label">Select Year:</label>
<select id="year" name="year" required class="year-dropdown">
  <option value="0" selected>Select Year</option>
  <!-- JavaScript will dynamically insert the years here -->
</select

  <!-- Buttons at the bottom -->
  <div class="popup-buttons">
    <button id="proceedBtn">Proceed</button>
    <button class="btn-close-popup" onclick="togglePopup()">Close</button>
  </div>
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
