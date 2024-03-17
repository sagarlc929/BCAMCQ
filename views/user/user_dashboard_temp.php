
<style>
  .dropbtn {
    background-color: #3498DB;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
  }

  .dropbtn:hover, .dropbtn:focus {
    background-color: #2980B9;
  }

  .dropdown {
    position: relative;
    display: inline-block;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
  }

  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  .dropdown a:hover {background-color: #ddd;}

  .show {display: block;}
</style>

<h1>hi</h1>

<script>
  // Assuming $jsonSemSub is a valid JSON string passed from PHP
  var semSub = <?php echo $jsonSemSub; ?>;

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
      subjectLink.href = "https://www.google.com"; // Update the href as needed
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
</script>
