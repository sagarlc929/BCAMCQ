
const messageDiv = document.getElementById("message");
const regularAnc = document.getElementById("regular-a");
const pastAnc = document.getElementById("past-a");
const reportAnc = document.getElementById("report-a");
// Example JSON data for semSub
// var semSub = <?php echo $jsonSemSub; ?>;

function displaySubject() {
  var semesterDiv = document.createElement("div");
  var currentDropdown = null;

  // Function to close all dropdowns
  function closeAllDropdowns() {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
      var dropdown = dropdowns[i];
      if (dropdown.classList.contains('show')) {
        dropdown.classList.remove('show');
      }
    }
  }

  // Iterate through the semSub array and build the HTML content
  for (var i = 0; i < semSub.length; i++) {
    var semesterObject = semSub[i];
    var semester = Object.keys(semesterObject)[0];
    var subjects = semesterObject[semester];

    // Create a container div for each semester
    var semesterContainer = document.createElement("div");
    semesterContainer.className = "dropdown";

    // Create a button for the dropdown
    var button = document.createElement("button");
    button.textContent = semester;
    button.className = "dropbtn";

    // Event listener to toggle the dropdown content
    button.addEventListener("click", function() {
      var dropdownContent = this.nextElementSibling;

      // Toggle the dropdown content
      if (dropdownContent.classList.contains("show")) {
        dropdownContent.classList.remove("show");
        currentDropdown = null;
      } else {
        // Close all other dropdowns
        closeAllDropdowns();

        // Show the current dropdown
        dropdownContent.classList.add("show");
        currentDropdown = dropdownContent;
      }
    });

    semesterContainer.appendChild(button);

    // Create a div for the dropdown content
    var dropdownContent = document.createElement("div");
    dropdownContent.className = "dropdown-content";

    // Create links for each subject
    for (var j = 0; j < subjects.length; j++) {
      var subjectLink = document.createElement("a");
      subjectLink.href = '?route=quiz&sem=' + encodeURIComponent(semester) + '&subject=' + encodeURIComponent(subjects[j]);
      subjectLink.textContent = subjects[j];
      dropdownContent.appendChild(subjectLink);
    }

    semesterContainer.appendChild(dropdownContent);

    semesterDiv.appendChild(semesterContainer);
  }

  const main = document.getElementById("main");
  main.innerHTML = ""; // Clear previous content
  main.appendChild(semesterDiv);

  // Close the dropdown if the user clicks outside of it
  window.addEventListener("click", function(event) {
    if (!event.target.matches('.dropbtn') && currentDropdown !== null) {
      currentDropdown.classList.remove("show");
      currentDropdown = null;
    }
  });
}
/*
   <a id="regular"class="active" onclick="displayRegularQn()">Regular Practice</a>
      <a id="past"class="" onclick="displayPastQn()">Past Question Practice</a>
      <a id="report"class="" onclick="displayReports()">My Reports</a>
*/
displayRegularQn();
// Flags to track the current state
var isRegularQuestion = true;
var isPastQuestion = false;



function displayRegularQn() {
  displaySubject();
  isRegularQuestion = true;
  isPastQuestion = false;

  // Update the active class for the links
  regularAnc.classList.add('active');
  pastAnc.classList.remove('active');
  reportAnc.classList.remove('active');
}

function displayPastQn() {
  displaySubject();
  isRegularQuestion = false;
  isPastQuestion = true;

  // Update the active class for the links
  regularAnc.classList.remove('active');
  pastAnc.classList.add('active');
  reportAnc.classList.remove('active');
}

function displayReports() {
  // Add your displayReport function implementation here

  // Update the active class for the links
  regularAnc.classList.remove('active');
  pastAnc.classList.remove('active');
  reportAnc.classList.add('active');

  // Function to fetch and display reports
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        const reports = JSON.parse(this.responseText);
        const main = document.getElementById("main");
        main.innerHTML = ""; // Clear existing content
        const flexDiv = document.createElement("div");
        flexDiv.id= "flex-div-report";
        main.appendChild(flexDiv);
        if(reports.length >0){

        // Create cards for each report
        reports.forEach(report => {
          const card = document.createElement("div");
          card.className = "report-card";

 //       <h3>Report ID: ${report.report_id}</h3>
          const reportDetails = `
<h3 style="color:#555;">Semester: ${report.semester_name}</h3>
<h3 style="color:#555;">Subject: ${report.subject_name}</h3>
<h1>Marks: ${report.marks}</h1>
<button class="delete-btn" onclick="deleteReport(${report.report_id})">Delete</button>
`;
          card.innerHTML = reportDetails;
          flexDiv.appendChild(card);
        });
    } else {
        main.innerHTML = "<h2>no reports.</h2>";
      }
      }
    };
//user_dashboard"
    xhttp.open("POST", "?route=user_dashboard", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    let data = `action=getReport`;
    xhttp.send(data);
}

function deleteReport(reportId) {
  // Function to delete a report
  customConfirm(`Are you sure you want to delete this report?`, function(result) {
    if (result) {
      const xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          const responseObject = JSON.parse(this.responseText);
          messageDiv.innerText = responseObject.message; // Set inner HTML
          messageDiv.className = 'alert'; // Reset class to 'alert'
          messageDiv.classList.add("show"); 

          if (responseObject.status == 1) {

            displayReports(); // Refresh the reports list
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
      xhttp.open("POST", "?route=user_dashboard", true);
      xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhttp.send(`action=delete_report&report_id=${reportId}`);
    }
  });
}

// custom confirm function definition
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

