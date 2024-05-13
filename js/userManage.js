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
});

/*
document.addEventListener("DOMContentLoaded", function () {

  const subjectSelectOption = document.getElementById("subjectSelect");
  subjectSelectOption.addEventListener('change',()=>{
    const subjectSelected = encodeURIComponent(document.getElementById('subjectSelect').value);
    console.log('hi' + subjectSelected);
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText)
        const responseObject = JSON.parse(this.responseText);
        console.log(responseObject.data);
        if (responseObject.status === 1) {
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

*/

// Add user
const addUser = document.getElementById('add-user');

// Add click event listener to the "Add User" button
addUser.addEventListener('click', () => {
  const firstName = encodeURIComponent(document.getElementById('first-name').value);
  const lastName = encodeURIComponent(document.getElementById('last-name').value);
  const email = encodeURIComponent(document.getElementById('email').value);
  const contactNo = encodeURIComponent(document.getElementById('contact-no').value);
  const userName = encodeURIComponent(document.getElementById('user-name').value);
  const newPassword = encodeURIComponent(document.getElementById('new-password').value);
  const confirmPassword = encodeURIComponent(document.getElementById('confirm-password').value);

  // Send an AJAX request to add the new user
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      try {
        const responseObject = JSON.parse(this.responseText);
        // Use responseObject here, e.g., show success message or update user list
      } catch (error) {
        console.error("Error parsing JSON:", error);
      }
    }
  };

  // Use the POST method and set the appropriate content type
  //case "register":
  xhttp.open("POST", "?route=add_user");
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  // Send the request with user data
  let data = `action=addNewUser&first_name=${firstName}&last_name=${lastName}&email=${email}&contact_no=${contactNo}&user_name=${userName}&new_password=${newPassword}&confirm_password=${confirmPassword}`;
  xhttp.send(data);
});
      
