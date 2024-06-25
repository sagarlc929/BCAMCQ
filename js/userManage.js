const messageDiv = document.getElementById('message');
const tableBody = document.querySelector('tbody');
//form popup
function togglePopup() { 
  const overlay = document.getElementById('popupOverlay'); 
  overlay.classList.toggle('show'); 
}

const blurDiv = document.getElementById("blur");
const newQuestionMenu = document.getElementById("new-question");
const addBtn = document.getElementById("add-user");
const overlay = document.getElementById('popupOverlay'); 

addBtn.addEventListener('click', ()=>{
  overlay.classList.toggle('show'); 
});
// Add user
const addUserProceed = document.getElementById('add-user-proceed');
addUserProceed.onclick = addUserAjax;
// Add click event listener to the "Add User" button


function addUserAjax() {
  if(validateForm()){
    const addFirstName = document.getElementById('first-name').value;
    const addLastName = document.getElementById('last-name').value;
    const addEmail = document.getElementById('email').value;
    const addContactNo = document.getElementById('contact-no').value;
    const addUserName = document.getElementById('user-name').value;
    const addNewPassword = document.getElementById('new-password').value;
    const messageDiv = document.getElementById('message');
    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        const responseObject = JSON.parse(this.responseText);
        messageDiv.innerHTML = responseObject.message;
        messageDiv.className = 'alert';
        messageDiv.classList.add("show");

        if (responseObject.status == true) {
          messageDiv.classList.add("alert-success");
          document.getElementById('first-name').value = "";
          document.getElementById('last-name').value = "";
          document.getElementById('email').value = "";
          document.getElementById('contact-no').value = "";
          document.getElementById('user-name').value = "";
          document.getElementById('confirm-password').value = "";
          document.getElementById('new-password').value = "";

          const newRow = document.createElement("tr");
          newRow.id = `row-${responseObject.id}`;
          newRow.innerHTML = `<td>${responseObject.id}</td>
            <td>${addFirstName}</td>
            <td>${addLastName}</td>
            <td>${addEmail}</td>
            <td>${addContactNo}</td>
            <td>${addUserName}</td>
            <td>
              <button class="deleteBtn" type="button" data-user-id="${responseObject.id}" onclick="deleteUser(this.getAttribute('data-user-id'))">DELETE</button>
              <button class="modifyBtn" type="button" data-user-id="${responseObject.id}" onclick="modifyUser(this.getAttribute('data-user-id'))">MODIFY</button>
            </td>
          `;
          tableBody.appendChild(newRow);
          setTimeout(() => {
            messageDiv.classList.remove("show");
          }, 3000);
        } else {
          messageDiv.classList.add("alert-danger");
          setTimeout(() => {
            messageDiv.classList.remove("show");
          }, 5000);
        }
      }
    };

    xhttp.open("POST", "?route=user_manage");
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    let data = `action=addNewUser&first-name=${encodeURIComponent(addFirstName)}&last-name=${encodeURIComponent(addLastName)}&email=${encodeURIComponent(addEmail)}&contact-no=${encodeURIComponent(addContactNo)}&user-name=${encodeURIComponent(addUserName)}&new-password=${encodeURIComponent(addNewPassword)}`;
    xhttp.send(data);
  }
}




function validateForm() {
  let isValid = true;
  const popupBox = document.querySelector('.popup-box');
  const inputs = popupBox.querySelectorAll('input');

  let password = '';
  let confirmPassword = '';

  inputs.forEach(input => {
    if (input.type !== 'submit' && input.type !== 'checkbox') {
      if (!input.value.trim()) {
        isValid = false;
        showMessage(`Please fill in ${input.name.replace(/-/g, ' ')}`);
      }

      if (input.name === 'new-password') {
        password = input.value.trim();
      }

      if (input.name === 'confirm-password') {
        confirmPassword = input.value.trim();
      }
    }
  });

  if (password !== confirmPassword) {
    isValid = false;
    showMessage('Passwords do not match');
  }

  return isValid;
}

function showMessage(message) {

  messageDiv.className = 'alert'; // Reset class to 'alert'

        messageDiv.classList.add("show"); // Remove "show" class to trigger fade-out
  messageDiv.classList.add("alert-danger");
  messageDiv.innerText = message;
  setTimeout(() => {
    messageDiv.classList.remove("show"); // Remove "show" class to trigger fade-out
  }, 5000); 
}

