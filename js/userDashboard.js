
const messageDiv = document.getElementById("message");
const regularAnc = document.getElementById("regular-a");
const pastAnc = document.getElementById("past-a");
const reportAnc = document.getElementById("report-a");
const profileAnc = document.getElementById("profile-a");
const titleInTxt = document.getElementById("title");
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
			if (dropdown.classList.contains("show")) {
				dropdown.classList.remove("show");
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
		button.addEventListener("click", function () {
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
		/*
    // Create links for each subject
    for (var j = 0; j < subjects.length; j++) {
      var subjectLink = document.createElement("a");
      subjectLink.href = '?route=quiz&sem=' + encodeURIComponent(semester) + '&subject=' + encodeURIComponent(subjects[j]);
      subjectLink.textContent = subjects[j];
      dropdownContent.appendChild(subjectLink);
    }
*/
		// Create links for each subject
		for (var j = 0; j < subjects.length; j++) {
			const currentSub = subjects[j];
			// Check if the element with ID 'past-a' contains the 'active' class

			// Create a new button element for each subject
			var subjectBtn = document.createElement("button");

			// Set the button's text content
			subjectBtn.textContent = subjects[j];

			// Add a click event handler (use arrow function to pass parameters)
			subjectBtn.onclick = function () {
				console.log(currentSub);
				var quizType = "regular";
				if (document.getElementById("past-a").classList.contains("active")) {
					quizType = "past";
				}
				subBtnClickHandel(currentSub, quizType);
			};

			// Append the button to the dropdown content
			dropdownContent.appendChild(subjectBtn);
		}

		semesterContainer.appendChild(dropdownContent);

		semesterDiv.appendChild(semesterContainer);
	}

	const main = document.getElementById("main");
	main.innerHTML = ""; // Clear previous content
	main.appendChild(semesterDiv);

	// Close the dropdown if the user clicks outside of it
	window.addEventListener("click", function (event) {
		if (!event.target.matches(".dropbtn") && currentDropdown !== null) {
			currentDropdown.classList.remove("show");
			currentDropdown = null;
		}
	});
}

displayRegularQn();
// Flags to track the current state
var isRegularQuestion = true;
var isPastQuestion = false;

function displayRegularQn() {
	titleInTxt.innerText = "Regular Practice";
	displaySubject();
	isRegularQuestion = true;
	isPastQuestion = false;

	// Update the active class for the links
	regularAnc.classList.add("active");
	pastAnc.classList.remove("active");
	profileAnc.classList.remove("active");
	reportAnc.classList.remove("active");
}

function displayPastQn() {
	titleInTxt.innerText = "Past Question Practice";
	displaySubject();
	isRegularQuestion = false;
	isPastQuestion = true;

	// Update the active class for the links
	regularAnc.classList.remove("active");
	reportAnc.classList.remove("active");
	profileAnc.classList.remove("active");
	pastAnc.classList.add("active");
}

function displayReports() {
	// Add your displayReport function implementation here

	// Update the active class for the links
	titleInTxt.innerText = "My Reports";
	regularAnc.classList.remove("active");
	pastAnc.classList.remove("active");
	profileAnc.classList.remove("active");
	reportAnc.classList.add("active");

	// Function to fetch and display reports
	const xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			console.log(this.responseText);
			const reports = JSON.parse(this.responseText);
			const main = document.getElementById("main");
			main.innerHTML = ""; // Clear existing content
			const flexDiv = document.createElement("div");
			flexDiv.id = "flex-div-report";
			main.appendChild(flexDiv);
			if (reports.length > 0) {
				// Create cards for each report
				reports.forEach((report) => {
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

function displayProfile() {
	// Update the active class for the links
	titleInTxt.innerText = "My Profile";
	regularAnc.classList.remove("active");
	pastAnc.classList.remove("active");
	reportAnc.classList.remove("active");
	profileAnc.classList.add("active");

	// Create an XMLHttpRequest to fetch and display the profile info
	const xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			// Log the raw response text to the console
			console.log("Raw response:", this.responseText);

			// Parse the response to JSON
			try {
				const response = JSON.parse(this.responseText);

				// Check if the profile data is valid and display it
				if (response.status === 1) {
					const profile = response.data; // Profile data is inside the 'data' property

					// Get the main section
					const main = document.getElementById("main");

					// Clear existing content and display the profile information
					main.innerHTML = `
          <div class="profile-container">
              <h2>Profile Information</h2>
              <div class="profile-info">
                <p><strong>First Name:</strong> <span id="first-name">${profile.fname}</span></p>
                <p><strong>Last Name:</strong> <span id="last-name">${profile.lname}</span></p>
                <p><strong>Username:</strong> <span id="username">${profile.uname}</span></p>
                <p><strong>Email:</strong> <span id="email">${profile.email}</span></p>
                <p><strong>Contact No:</strong> <span id="contact-no">${profile.contact_no}</span></p>
              </div>
              <button class="edit-button" onclick="editProfile()">Edit Profile</button>
            </div>
          `;
				} else {
					console.error(
						"Failed to retrieve profile information:",
						response.message
					);
				}
			} catch (error) {
				console.error("Error parsing JSON:", error);
			}
		} else if (this.readyState == 4) {
			console.error(
				"Failed to fetch profile information. Status:",
				this.status
			);
		}
	};

	// Open and send the XMLHttpRequest
	xhttp.open("POST", "?route=user_dashboard", true);
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhttp.send("action=get_user_info");
}

function deleteReport(reportId) {
	// Function to delete a report
	customConfirm(
		`Are you sure you want to delete this report?`,
		function (result) {
			if (result) {
				const xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function () {
					if (this.readyState == 4 && this.status == 200) {
						console.log(this.responseText);
						const responseObject = JSON.parse(this.responseText);
						messageDiv.innerText = responseObject.message; // Set inner HTML
						messageDiv.className = "alert"; // Reset class to 'alert'
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
				xhttp.setRequestHeader(
					"Content-Type",
					"application/x-www-form-urlencoded"
				);
				xhttp.send(`action=delete_report&report_id=${reportId}`);
			}
		}
	);
}


// custom confirm function definition
function customConfirm(message, callback) {
	// Create overlay
	const overlay = document.createElement("div");
	overlay.className = "custom-confirm-overlay";

	// Create confirm box
	const confirmBox = document.createElement("div");
	confirmBox.className = "custom-confirm-box";

	// Create confirm message
	const confirmMessage = document.createElement("div");
	confirmMessage.className = "custom-confirm-message";
	confirmMessage.textContent = message;

	// Create buttons container
	const buttonsContainer = document.createElement("div");
	buttonsContainer.className = "custom-confirm-buttons";

	// Create OK button
	const okButton = document.createElement("button");
	okButton.className = "custom-confirm-button custom-confirm-ok";
	okButton.textContent = "OK";
	okButton.onclick = function () {
		document.body.removeChild(overlay);
		if (typeof callback === "function") {
			callback(true);
		}
	};

	// Create Cancel button
	const cancelButton = document.createElement("button");
	cancelButton.className = "custom-confirm-button custom-confirm-cancel";
	cancelButton.textContent = "Cancel";
	cancelButton.onclick = function () {
		document.body.removeChild(overlay);
		if (typeof callback === "function") {
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

function editProfile() {
	// Populate the form fields with the current profile data
	document.getElementById("edit-first-name").value =
		document.getElementById("first-name").innerText;
	document.getElementById("edit-last-name").value =
		document.getElementById("last-name").innerText;
	document.getElementById("edit-username").value =
		document.getElementById("username").innerText;
	document.getElementById("edit-email").value =
		document.getElementById("email").innerText;
	document.getElementById("edit-contact-no").value =
		document.getElementById("contact-no").innerText;

	// Display the modal
	document.getElementById("editProfileModal").style.display = "block";
}

function closeEditProfileModal() {
	document.getElementById("editProfileModal").style.display = "none";
}

function saveProfile() {
	customConfirm(`Are you sure to apply changes?`, function (result) {
		// Collect form data
		const form = document.getElementById("editProfileForm");
		const formData = new FormData(form);

		// Send the data to the server
		const xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				// Handle the response from the server
				console.log(this.responseText);
				const response = JSON.parse(this.responseText);
				messageDiv.innerHTML = response.message; // Set inner HTML
				messageDiv.className = "alert"; // Reset class to 'alert'
				messageDiv.classList.add("show"); // Remove "show" class to trigger fade-out
				//messageDiv.style.dispaly= 'block';

				if (response.status === 1) {
					// Update profile information on the page
					document.getElementById("first-name").innerText =
						formData.get("fname");
					document.getElementById("last-name").innerText =
						formData.get("lname");
					document.getElementById("username").innerText = formData.get("uname");
					document.getElementById("email").innerText = formData.get("email");
					document.getElementById("contact-no").innerText =
						formData.get("contact_no");

					// Close the modal
					closeEditProfileModal();
					/*
 messageDiv.innerHTML = responseObject.message; // Set inner HTML
        messageDiv.className = 'alert'; // Reset class to 'alert'
        messageDiv.classList.add("show"); // Remove "show" class to trigger fade-out
        //messageDiv.style.dispaly= 'block';
        if (responseObject.status === 1) {
          messageDiv.classList.add("alert-success");
          // setTimeout(() => {
          //   goLogin();
          // }, 10000); // 10 seconds
        } else {
          messageDiv.classList.add("alert-danger");
          setTimeout(() => {
            messageDiv.classList.remove("show"); // Remove "show" class to trigger fade-out
          }, 5000); // 3 seconds
        }

*/
					// Optionally, display a success message
					//        alert('Profile updated successfully.');
					messageDiv.classList.add("alert-success");
					setTimeout(() => {
						messageDiv.classList.remove("show"); // Remove "show" class to trigger fade-out
					}, 5000); // 3 seconds
				} else {
					messageDiv.classList.add("alert-danger");
					setTimeout(() => {
						messageDiv.classList.remove("show"); // Remove "show" class to trigger fade-out
					}, 5000); // 3 seconds
				}
			}
		};

		xhttp.open("POST", "?route=user_profile", true);
		xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		const data = `action=update_profile&fname=${formData.get(
			"fname"
		)}&lname=${formData.get("lname")}&uname=${formData.get(
			"uname"
		)}&email=${formData.get("email")}&contact_no=${formData.get("contact_no")}`;
		xhttp.send(data);
	});
}

function subBtnClickHandel(subject, quizType) {
	// Create an XMLHttpRequest object
	const xhttp = new XMLHttpRequest();

	// Define what happens when the request completes
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			// Parse the response from the server
      console.log(this.responseText);
			const responseObject = JSON.parse(this.responseText);
			if (responseObject.status == 1 || responseObject.status == true) {
				if (responseObject.type === "regular") {
					// Create popup for regular quiz type
					createRegularQuizPopup(responseObject.data, subject, quizType);
				} else if (responseObject.type === "past") {
					// Create popup for past quiz type
					createPastQuizPopup(responseObject.data, subject, quizType);
				}
			} else {
				alert(responseObject.message);
			}
		}
	};
	// Open the connection
	xhttp.open("POST", "?route=question_info", true);
	xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	// Prepare the data to send
	const data = `type=${encodeURIComponent(
		quizType
	)}&subject=${encodeURIComponent(subject)}`;;

	// Send the request
	xhttp.send(data);
}

// Function to create a regular quiz popup
function createRegularQuizPopup(maxQuestions, subject, quizType) {
    // Check if maxQuestions is 0
    if (maxQuestions === 0) {
        const popup = document.createElement('div');
        popup.className = 'simple-overlay show';
        popup.innerHTML = `
            <div class="simple-popup">
                <span class="simple-close">&times;</span>
                <h2>No Questions Available</h2>
                <p>There are no questions available at the moment. Please check back later.</p>
                <div class="simple-buttons">
                    <button type="button" class="simple-cancel">Cancel</button>
                </div>
            </div>
        `;
        document.body.appendChild(popup);
        setupPopupClose(popup);
        return;
    }

    const popup = document.createElement('div');
    popup.className = 'simple-overlay show';
    popup.innerHTML = `
        <div class="simple-popup">
            <span class="simple-close">&times;</span>
            <h2>Enter Number of Questions</h2>
            <form>
                <label for="numQuestions">Number of Questions (Min: 1, Max: ${maxQuestions})</label>
                <input type="number" id="numQuestions" name="numQuestions" min="1" max="${maxQuestions}" required>
                <div class="simple-buttons">
                    <button type="button" class="simple-proceed" onclick="navigateToQuiz('regular', '${subject}', document.getElementById('numQuestions').value)">Play Quiz</button>
                    <button type="button" class="simple-cancel">Cancel</button>
                </div>
            </form>
        </div>
    `;
    document.body.appendChild(popup);
    setupPopupClose(popup);
}

// Function to create a past quiz popup
function createPastQuizPopup(years, subject, quizType) {
    if (years.length === 0) {
        const popup = document.createElement('div');
        popup.className = 'simple-overlay show';
        popup.innerHTML = `
            <div class="simple-popup">
                <span class="simple-close">&times;</span>
                <h2>No Past Questions Available</h2>
                <p>There are no past questions available for this subject. Please check back later.</p>
                <div class="simple-buttons">
                    <button type="button" class="simple-cancel">Cancel</button>
                </div>
            </div>
        `;
        document.body.appendChild(popup);
        setupPopupClose(popup);
        return;
    }

    const popup = document.createElement('div');
    popup.className = 'simple-overlay show';
    let options = years.map(year => `<option value="${year}">${year}</option>`).join('');
    popup.innerHTML = `
        <div class="simple-popup">
            <span class="simple-close">&times;</span>
            <h2>Select Year</h2>
            <form>
                <label for="yearSelect">Select a Year</label>
                <select id="yearSelect" name="yearSelect">
                    ${options}
                </select>
                <div class="simple-buttons">
                    <button type="button" class="simple-proceed" onclick="navigateToQuiz('past', '${subject}', document.getElementById('yearSelect').value)">Play Quiz</button>
                    <button type="button" class="simple-cancel">Cancel</button>
                </div>
            </form>
        </div>
    `;
    document.body.appendChild(popup);
    setupPopupClose(popup);
}

// Function to navigate to the quiz URL
function navigateToQuiz(type, subject, parameter) {
    const url = `?route=quiz&type=${type}&subject=${encodeURIComponent(subject)}`;
    const separator = url.includes('?') ? '&' : '?'; // Check if there are existing parameters
    const fullUrl = `${url}${separator}${type === 'regular' ? `number=${parameter}` : `year=${parameter}`}`;
    window.location.href = fullUrl;
}

// Function to setup popup close event
function setupPopupClose(popup) {
    const closeBtn = popup.querySelector('.simple-close');
    const cancelBtn = popup.querySelector('.simple-cancel');
    closeBtn.addEventListener('click', () => document.body.removeChild(popup));
    cancelBtn.addEventListener('click', () => document.body.removeChild(popup));
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

