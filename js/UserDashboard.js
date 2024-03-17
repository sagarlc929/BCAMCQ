// Assuming $jsonSemSub is a valid JSON string passed from PHP
// var semSub = <?php echo $jsonSemSub; ?>;

// Create a div to contain semester data
var semesterDiv = document.createElement("div");

// Keep track of the currently open dropdown
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
    subjectLink.href = ' ?route=quiz&sem=' + encodeURIComponent(semester) + '&subject=' + encodeURIComponent(subjects[j]);
    subjectLink.textContent = subjects[j];
    dropdownContent.appendChild(subjectLink);
  }

  semesterContainer.appendChild(dropdownContent);

  semesterDiv.appendChild(semesterContainer);
}

document.body.appendChild(semesterDiv);

// Close the dropdown if the user clicks outside of it
window.addEventListener("click", function(event) {
  if (!event.target.matches('.dropbtn') && currentDropdown !== null) {
    currentDropdown.classList.remove('show');
    currentDropdown = null;
  }
});
