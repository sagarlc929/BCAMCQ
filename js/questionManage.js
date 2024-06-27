//var allQuestion = <?php echo json_encode($allQuestion); ?>;
//generateTable(allQuestion); //questions.innerHTML = generateTable(allQuestion);

function generateTable(data) {
  if(data.status == false){
  } else {
    const tableBody = document.getElementById("tableBody");
    tableBody.innerHTML = "";

    data.forEach((item) => {
      const row = document.createElement("tr");
      row.id = "row-" + item.question_id;
      row.innerHTML = `
<td>${item.question_id}</td>
<td>${item.description}</td>
<td>${item.option_A}</td>
<td>${item.option_B}</td>
<td>${item.option_C}</td>
<td>${item.option_D}</td>
<td>${item.answer}</td>
<td>${item.explanation}</td>
<td class="table-controls">
  <button class="deleteBtn" type="button" data-question-id="${item.question_id}" onclick="deleteQuestion(this.getAttribute('data-question-id'))">DELETE</button>
  <button class="modifyBtn" type="button" data-question-id="${item.question_id}" onclick="modifyQuestion(this.getAttribute('data-question-id'))">MODIFY</button>
</td>
`;
      tableBody.appendChild(row);
    });
  }
}

// Function to populate semester dropdown
function populateSemesterDropdown() {
  const semesterSelect = document.getElementById('semesterSelect');
  semesterSubjects.forEach((semester, index) => {
    const semesterName = Object.keys(semester)[0]; // Assuming each object has only one key
    const option = document.createElement('option');
    option.value = semesterName;
    option.textContent = semesterName;
    semesterSelect.appendChild(option);
  });
}

// Function to populate subject dropdown based on selected semester
function populateSubjectDropdown() {
  const subjectSelect = document.getElementById('subjectSelect');
  const semesterSelect = document.getElementById('semesterSelect');
  subjectSelect.innerHTML = '<option value="">Select Subject</option>'; // Reset subject dropdown

  const selectedSemester = semesterSelect.value;
  const selectedSemesterData = semesterSubjects.find(semester => Object.keys(semester)[0] === selectedSemester);

  if (selectedSemesterData) {
    const subjects = selectedSemesterData[selectedSemester];
    subjects.forEach(subject => {
      const option = document.createElement('option');
      option.value = subject;
      option.textContent = subject;
      subjectSelect.appendChild(option);
    });
  }
}

// Event listener for semester dropdown to populate subject dropdown
document.getElementById('semesterSelect').addEventListener('change', populateSubjectDropdown);
// Populate semester dropdown on page load
populateSemesterDropdown();


const subjectSelect = document.getElementById('subjectSelect');
const qnAddBtn = document.getElementById('add');
const tableContainer = document.querySelector('.table-container');
const selectSemSubMes = document.getElementById('select-sem-sub-mes')
subjectSelect.addEventListener('change', addAddBtn);
semesterSelect.addEventListener('change', addAddBtn);
function addAddBtn(){
  if (subjectSelect.value === "") {
    qnAddBtn.style.display = "none";
    tableContainer.style.display = "none";
    selectSemSubMes.style.display = "block";
  } else {
    qnAddBtn.style.display = "block";
    tableContainer.style.display = "block";
    selectSemSubMes.style.display = 'none';
  }
}

//form popup
function togglePopup() { 
  const overlay = document.getElementById('popupOverlay'); 
  overlay.classList.toggle('show'); 
}

const blurDiv = document.getElementById("blur");
const newQuestionMenu = document.getElementById("new-question");
const addBtn = document.getElementById("add");
const overlay = document.getElementById('popupOverlay'); 

addBtn.addEventListener('click', ()=>{
  overlay.classList.toggle('show'); 
  const selectedSemSpan = document.getElementById("selected-sem-span");
  const selectedSubSpan = document.getElementById("selected-sub-span");
  const semesterSelect = document.getElementById('semesterSelect');
  const subjectSelect = document.getElementById('subjectSelect');

  selectedSemSpan.innerText = semesterSelect.value;
  selectedSubSpan.innerText = subjectSelect.value;

  document.getElementById('proceedBtn').innerText = 'Add Question';
  document.getElementById('proceedBtn').onclick = addQuestion;
});


const subjectSelectOption = document.getElementById("subjectSelect");

subjectSelectOption.addEventListener('change',()=>{
  const subjectSelected = encodeURIComponent(document.getElementById('subjectSelect').value);
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText)
      const responseObject = JSON.parse(this.responseText);
      console.log(responseObject.data);
      if(responseObject.data.length === 0){
        const tableBody = document.getElementById("tableBody");
        const row = document.createElement("tr");
        row.id= 'no-qn-mes-row';
        tableBody.innerHTML = "";
        row.innerHTML = `<td colspan=9><span class="no-qn-mes">no questions</span></td>`;
        tableBody.appendChild(row);
      }
      else if (responseObject.status === 1) {
        generateTable(responseObject.data);
      } else {
        console.error('Error: ' + responseObject.message); // Log the error message
      }       // console.log(responseObject);
    }
  };
  xhttp.open("POST", "?route=question_manage");
  xhttp.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded",
  );
  let data = `action=getQuestions&subjectSelected=${subjectSelected}`;
  xhttp.send(data);
});


function addQuestion() {
  const addDesc = document.getElementById('description').value;
  const addOptA = document.getElementById('optionA').value;
  const addOptB = document.getElementById('optionB').value;
  const addOptC = document.getElementById('optionC').value;
  const addOptD = document.getElementById('optionD').value;
  var addAnsw;
  const addExpl = document.getElementById('explanation').value;
  const addSeme = document.getElementById('semesterSelect').value;
  const addSubj = document.getElementById('subjectSelect').value;
  var radioButtons = document.querySelectorAll('input[type="radio"][name="opt-rad"]');

  radioButtons.forEach(function(radioButton) {
    if (radioButton.checked) {
      var selectedId = radioButton.id;
      var lastChar = selectedId.charAt(selectedId.length - 1);
      addAnsw = document.getElementById("option"+lastChar).value;
    }
  });

  const messageDiv = document.getElementById('message');
  const xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      const responseObject = JSON.parse(this.responseText);
      messageDiv.innerText = responseObject.message; // Set inner HTML
      messageDiv.className = 'alert'; // Reset class to 'alert'
      messageDiv.classList.add("show"); 

      if (responseObject.status == true) {
        messageDiv.classList.add("alert-success");
        document.getElementById('description').value = "";
        document.getElementById('optionA').value = "";
        document.getElementById('optionB').value = "";
        document.getElementById('optionC').value = "";
        document.getElementById('optionD').value = "";
        document.getElementById('explanation').value = "";

        const newRow = document.createElement("tr");
        newRow.id = `row-${responseObject.id}`;
        newRow.innerHTML = `<td>${responseObject.id}</td><td>${addDesc}</td><td>${addOptA}</td><td>${addOptB}</td><td>${addOptC}</td><td>${addOptD}</td><td>${addAnsw}</td><td>${addExpl}</td>
          <button class="deleteBtn" type="button" data-question-id="${responseObject.id}" onclick="deleteQuestion(this.getAttribute('data-question-id'))">DELETE</button>
          <button class="modifyBtn" type="button" data-question-id="${responseObject.id}" onclick="modifyQuestion(this.getAttribute('data-question-id'))">MODIFY</button>
        `;
        tableBody.appendChild(newRow);
        if (document.querySelector("#no-qn-mes-row")) {
          document.querySelector("#no-qn-mes-row").remove();
        }
        setTimeout(() => {
          messageDiv.classList.remove("show"); // Remove "show" class to trigger fade-out
        }, 3000);

      } else {
        messageDiv.classList.add("alert-danger");
        setTimeout(() => {
          messageDiv.classList.remove("show"); // Remove "show" class to trigger fade-out
        }, 5000); // 3 seconds
      }
    }
  };

  // Use the POST method and set the appropriate content type
  xhttp.open("POST", "?route=question_manage");
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  // Send the request with the questionId as data
  let data = `action=addNewQuestion&description=${encodeURIComponent(addDesc)}&optionA=${encodeURIComponent(addOptA)}&optionB=${encodeURIComponent(addOptB)}&optionC=${encodeURIComponent(addOptC)}&optionD=${encodeURIComponent(addOptD)}&answer=${encodeURIComponent(addAnsw)}&explanation=${encodeURIComponent(addExpl)}&semesterSelect=${encodeURIComponent(addSeme)}&subjectSelect=${encodeURIComponent(addSubj)}`;
  xhttp.send(data);
}

function deleteQuestion(questionId){
  customConfirm(`Are you sure you want to delete this question?i.e:${questionId}`, function(result) {
    if (result) {
      const xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const responseObject = JSON.parse(this.responseText);
          document.getElementById("message").innerText = responseObject.message;
          const rowToDelete = document.getElementById("row-"+questionId);

          const messageDiv = document.getElementById('message');
          messageDiv.innerText = responseObject.message; // Set inner HTML
          messageDiv.className = 'alert'; // Reset class to 'alert'
          messageDiv.classList.add("show"); 

          if (responseObject.status == 1) {
            messageDiv.classList.add("alert-success");
            if (rowToDelete) {
              rowToDelete.remove();
              //implment check 
              const tableBody = document.getElementById('tableBody');
              const tableRow = document.getElementsByTagName('tr');
              if(tableRow){
                const tableBody = document.getElementById("tableBody");
                const row = document.createElement("tr");
                row.id = 'no-qn-mes-row';
                tableBody.innerHTML = "";
                row.innerHTML = `<td colspan=9><span class="no-qn-mes">no questions</span></td>`;
                tableBody.appendChild(row);
              }
              setTimeout(() => {
                messageDiv.classList.remove("show"); // Remove "show" class to trigger fade-out
              }, 3000);

            } 
          }else {
            messageDiv.classList.add("alert-danger");
            setTimeout(() => {
              messageDiv.classList.remove("show"); // Remove "show" class to trigger fade-out
            }, 5000); // 3 seconds
          }

        }
      };
      // Use the POST method and set the appropriate content type
      xhttp.open("POST", "?route=question_manage");
      xhttp.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded",
      );
      // Send the request with the questionId as data
      let data = `action=delete&question_id=${questionId}`;
      xhttp.send(data);
    }
  });
}

function modifyQuestion(questionId){
  /*
  customConfirm(`Are you sure you want to modify this question?i.e:${questionId}`, function(result) {
    if (result) {
      */
  togglePopup();

  const selectedSemSpan = document.getElementById("selected-sem-span");
  const selectedSubSpan = document.getElementById("selected-sub-span");
  const semesterSelect = document.getElementById('semesterSelect');
  const subjectSelect = document.getElementById('subjectSelect');
  selectedSemSpan.innerText = semesterSelect.value;
  selectedSubSpan.innerText = subjectSelect.value;

  const row = document.getElementById(`row-${questionId}`);
  if (row) {
    const cells = row.getElementsByTagName('td');
    const rowData = [];
    for (let i = 0; i <= 7; i++) {
      rowData.push(cells[i].innerText);
    }
    document.getElementById('description').value = rowData[1];
    document.getElementById('optionA').value = rowData[2];
    document.getElementById('optionB').value = rowData[3];
    document.getElementById('optionC').value = rowData[4];
    document.getElementById('optionD').value = rowData[5];
    document.getElementById('explanation').value = rowData[7];
    for(let i = 2; i <=5; i++){
      if(rowData[6] === rowData[i]){
        document.getElementById(`radOpt-${String.fromCharCode(i + 63)}`).checked = true;
      }
    }
    document.getElementById('proceedBtn').innerText = 'Update Question';
    document.getElementById('proceedBtn').onclick = function(){
      updateQuestionAjax(questionId);
    };
  } else {
    console.log('Row not found');
  }
}

function updateQuestionAjax (questionId){
  console.log("update Adj exec");
  const addDesc = document.getElementById('description').value;
  const addOptA = document.getElementById('optionA').value;
  const addOptB = document.getElementById('optionB').value;
  const addOptC = document.getElementById('optionC').value;
  const addOptD = document.getElementById('optionD').value;
  var addAnsw;
  const addExpl = document.getElementById('explanation').value;
  const addSeme = document.getElementById('semesterSelect').value;
  const addSubj = document.getElementById('subjectSelect').value;
  var radioButtons = document.querySelectorAll('input[type="radio"][name="opt-rad"]');

  radioButtons.forEach(function(radioButton) {
    if (radioButton.checked) {
      var selectedId = radioButton.id;
      var lastChar = selectedId.charAt(selectedId.length - 1);
      addAnsw = document.getElementById("option"+lastChar).value;
    }
  });

  const messageDiv = document.getElementById('message');
  const xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      const responseObject = JSON.parse(this.responseText); // Parse the response text
      console.log(responseObject);
      messageDiv.innerText = responseObject.message; // Set inner HTML
      messageDiv.className = 'alert'; // Reset class to 'alert'
      messageDiv.classList.add("show"); 

      if (responseObject.status == true) {
        document.getElementById('description').value = "";
        document.getElementById('optionA').value = "";
        document.getElementById('optionB').value = "";
        document.getElementById('optionC').value = "";
        document.getElementById('optionD').value = "";
        document.getElementById('explanation').value = "";

        const row = document.getElementById(`row-${questionId}`);
        if(row){
          const cells = row.getElementsByTagName('td');
          cells[1].innerText = addDesc;
          cells[2].innerText = addOptA;
          cells[3].innerText = addOptB;
          cells[4].innerText = addOptC
          cells[5].innerText = addOptD;
          cells[6].innerText = addAnsw;
          cells[7].innerText = addExpl;
        }

        document.querySelector('.btn-close-popup').click();
        messageDiv.classList.add("alert-success");
        setTimeout(() => {
          messageDiv.classList.remove("show"); // Remove "show" class to trigger fade-out
        }, 3000);

      } else {
        messageDiv.classList.add("alert-danger");
        setTimeout(() => {
          messageDiv.classList.remove("show"); // Remove "show" class to trigger fade-out
        }, 5000); // 3 seconds
      }
    }
  };

  xhttp.open("POST", "?route=question_manage");
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  let data = `action=updateQuestion&id=${encodeURIComponent(questionId)}&description=${encodeURIComponent(addDesc)}&optionA=${encodeURIComponent(addOptA)}&optionB=${encodeURIComponent(addOptB)}&optionC=${encodeURIComponent(addOptC)}&optionD=${encodeURIComponent(addOptD)}&answer=${encodeURIComponent(addAnsw)}&explanation=${encodeURIComponent(addExpl)}`;
  xhttp.send(data);
}

function showAlert(message) {
  var alertBox = document.getElementById('customAlert');
  var alertContent = document.getElementById('customAlertContent');
  var closeButton = document.getElementById('customAlertButton');

  // Set the message
  alertContent.innerHTML = message;

  // Show the alert
  alertBox.style.display = 'block';

  // Close the alert when the button is clicked
  closeButton.onclick = function() {
    alertBox.style.display = 'none';
  };
}

// custom confirm function defination

function customConfirm(message, callback) {
  // Create overlay
  const overlay = document.createElement('div');
  overlay.className = 'custom-confirm-overlay';

  // Create confirm box
  const confirmBox = document.createElement('div');
  confirmBox.className = 'custom-confirm-box';

  // Create confirm message
  const confirmMessage = document.createElement('div');
  confirmMessage.className = 'custom-confirm-message';
  confirmMessage.textContent = message;

  // Create buttons container
  const buttonsContainer = document.createElement('div');
  buttonsContainer.className = 'custom-confirm-buttons';

  // Create OK button
  const okButton = document.createElement('button');
  okButton.className = 'custom-confirm-button custom-confirm-ok';
  okButton.textContent = 'OK';
  okButton.onclick = function() {
    document.body.removeChild(overlay);
    if (typeof callback === 'function') {
      callback(true);
    }
  };

  // Create Cancel button
  const cancelButton = document.createElement('button');
  cancelButton.className = 'custom-confirm-button custom-confirm-cancel';
  cancelButton.textContent = 'Cancel';
  cancelButton.onclick = function() {
    document.body.removeChild(overlay);
    if (typeof callback === 'function') {
      callback(false);
    }
  };

  // Append buttons to buttons container
  buttonsContainer.appendChild(okButton);
  buttonsContainer.appendChild(cancelButton);

  // Append elements to confirm box
  confirmBox.appendChild(confirmMessage);
  confirmBox.appendChild(buttonsContainer);

  // Append confirm box to overlay
  overlay.appendChild(confirmBox);

  // Append overlay to body
  document.body.appendChild(overlay);

  // Set focus on the OK button
  okButton.focus();
}
