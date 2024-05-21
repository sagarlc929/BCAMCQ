//var allQuestion = <?php echo json_encode($allQuestion); ?>;
generateTable(allQuestion); //questions.innerHTML = generateTable(allQuestion);

function generateTable(data) {
  if(data.status == false){
    //console.log(data.message);
  } else {

    const tableBody = document.getElementById("tableBody");
    tableBody.innerHTML = "";

    data.forEach((item) => {
      const row = document.createElement("tr");
      row.id = item.question_id;
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
<button class="deleteBtn" type="button" data-question-id="${item.question_id}">DELETE</button>
<button class="modifyBtn" type="button">Modify</button>
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

subjectSelect.addEventListener('change', () => {
  console.log(subjectSelect.value);
  if (subjectSelect.value === "") {
    qnAddBtn.style.display = "none";
  } else {
    qnAddBtn.style.display = "block";
  }
});

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
});



document.addEventListener("DOMContentLoaded", function () {

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
    // Use the POST method and set the appropriate content type
    xhttp.open("POST", "?route=question_manage");
    xhttp.setRequestHeader(
      "Content-Type",
      "application/x-www-form-urlencoded",
    );
    // Send the request with the questionId as data
    let data = `action=getQuestions&subjectSelected=${subjectSelected}`;
    xhttp.send(data);
  });

  // Get all the buttons with the class 'deleteBtn'
  const deleteBtns = document.querySelectorAll(".deleteBtn");

  // Loop through each button and add a click event listener
  deleteBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      const questionId = btn.dataset.questionId;
      if (
        confirm(
          `Are you sure you want to delete this question?i.e:${questionId}`,
        )
      )
      {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const responseObject = JSON.parse(this.responseText);
            document.getElementById("message").innerText = responseObject.message;
            const rowToDelete = document.getElementById(questionId);
            if (responseObject.delete_flag == 1) {
              if (rowToDelete) {
                rowToDelete.remove();
              }
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
  });


  // add question  
  const addQuestion = document.getElementById('add-question');

  // Loop through each button and add a click event listener
  addQuestion.addEventListener('click', () => {
    const addDesc = encodeURIComponent(document.getElementById('description').value);
    const addOptA = encodeURIComponent(document.getElementById('optionA').value);
    const addOptB = encodeURIComponent(document.getElementById('optionB').value);
    const addOptC = encodeURIComponent(document.getElementById('optionC').value);
    const addOptD = encodeURIComponent(document.getElementById('optionD').value);
    const addAnsw = encodeURIComponent(document.getElementById('answer').value);
    const addExpl = encodeURIComponent(document.getElementById('explanation').value);
    const addSeme = encodeURIComponent(document.getElementById('semesterSelect').value);
    const addSubj = encodeURIComponent(document.getElementById('subjectSelect').value);
    //const addSubj = encodeURIComponent(document.getElementById('subjectSelect').value);

    // Do something with the questionId, e.g., send an AJAX request to delete the question

    const messageDiv = document.getElementById('message');
    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        try {
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
            document.getElementById('answer').value = "";
            document.getElementById('explanation').value = "";
            const newQnId = 12; 
            const newRow = document.createElement("tr");
            newRow.innerHTML = `<td>${newQnId}</td><td>${addDesc}</td><td>${addOptA}</td><td>${addOptB}</td><td>${addOptC}</td><td>${addOptD}</td><td>${addAnsw}</td><td>${addExpl}</td><td class="table-controls"><button class="deleteBtn" type="button" data-question-id="${newQnId}">DELETE</button><button class="modifyBtn" type="button">Modify</button></td>`;
            tableBody.appendChild(newRow);
            setTimeout(() => {
              messageDiv.classList.remove("show"); // Remove "show" class to trigger fade-out
            }, 3000);

          } else {
            messageDiv.classList.add("alert-danger");
            setTimeout(() => {
             messageDiv.classList.remove("show"); // Remove "show" class to trigger fade-out
            }, 5000); // 3 seconds
          }

        } catch (error) {
          console.error("Error parsing JSON:", error);
        }
      }
    };

    // Use the POST method and set the appropriate content type
    xhttp.open("POST", "?route=question_manage");
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Send the request with the questionId as data
    let data = `action=addNewQuestion&description=${addDesc}&optionA=${addOptA}&optionB=${addOptB}&optionC=${addOptC}&optionD=${addOptD}&answer=${addAnsw}&explanation=${addExpl}&semesterSelect=${addSeme}&subjectSelect=${addSubj}`;
    xhttp.send(data);
  });
});

 
