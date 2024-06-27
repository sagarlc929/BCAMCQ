
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
// changing title and button text
const btnProceed = document.getElementById('btn-proceed');
const popupTitle = document.getElementById('popup-title');
btnProceed.innerText = "Add User";
btnProceed.onclick = addUserAjax;
popupTitle.innerText = "Add New User";
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

function modifyUser(userId) {
  // Open the popup form
  // console.log(`userid:${user}`)
  togglePopup();
  popupTitle.innerText = "Update User";

  const row = document.getElementById(`row-${userId}`);
  if (row) {
    const cells = row.getElementsByTagName('td');
    const rowData = [];
    for (let i = 0; i <= 5; i++) {
      rowData.push(cells[i].innerText);
    }
    // Populate the form fields with existing user data
    document.getElementById('first-name').value = rowData[1];
    document.getElementById('last-name').value = rowData[2];
    document.getElementById('user-name').value = rowData[3];
    document.getElementById('email').value = rowData[4];
    document.getElementById('contact-no').value = rowData[5];
    document.getElementById('new-password').value = ''; // Clear the password field
    document.getElementById('confirm-password').value = ''; // Clear the password field
    // Update the button text and onclick event
    btnProceed.innerText = "Update User";
    btnProceed.onclick = function() {
      updateUserAjax(userId);
    };
  } else {
    console.log('Row not found');
  }
}

function updateUserAjax(userId) {
  if (validateForm()) {
    const updateFirstName = document.getElementById('first-name').value;
    const updateLastName = document.getElementById('last-name').value;
    const updateEmail = document.getElementById('email').value;
    const updateContactNo = document.getElementById('contact-no').value;
    const updateUserName = document.getElementById('user-name').value;
    const updateNewPassword = document.getElementById('new-password').value;
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

          // Update the row with new user data
          const row = document.getElementById(`row-${userId}`);
          if (row) {
            const cells = row.getElementsByTagName('td');
            cells[1].innerText = updateFirstName;
            cells[2].innerText = updateLastName;
            cells[3].innerText = updateUserName;
            cells[4].innerText = updateEmail;
            cells[5].innerText = updateContactNo;
          }

          // Close the popup form
          document.querySelector('.btn-close-popup').click();
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

    let data = `action=updateUser&id=${encodeURIComponent(userId)}&first-name=${encodeURIComponent(updateFirstName)}&last-name=${encodeURIComponent(updateLastName)}&email=${encodeURIComponent(updateEmail)}&contact-no=${encodeURIComponent(updateContactNo)}&user-name=${encodeURIComponent(updateUserName)}&new-password=${encodeURIComponent(updateNewPassword)}`;
    xhttp.send(data);
  }
}



function deleteUser(userId) {
  customConfirm(`Are you sure you want to delete this user? ID: ${userId}`, function(result) {
    if (result) {
      const xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const responseObject = JSON.parse(this.responseText);
          document.getElementById("message").innerText = responseObject.message;
          const rowToDelete = document.getElementById("row-" + userId);

          const messageDiv = document.getElementById('message');
          messageDiv.innerText = responseObject.message;
          messageDiv.className = 'alert';
          messageDiv.classList.add("show");

          if (responseObject.status == 1) {
            messageDiv.classList.add("alert-success");
            if (rowToDelete) {
              rowToDelete.remove();
              // Implement check
              const tableBody = document.getElementById('tableBody');
              const tableRows = document.getElementsByTagName('tr');
              if (tableRows.length === 1) { // Assuming the first row might be the header
                const noUserRow = document.createElement("tr");
                noUserRow.id = 'no-user-msg-row';
                tableBody.innerHTML = "";
                noUserRow.innerHTML = `<td colspan=9><span class="no-user-msg">No users available</span></td>`;
                tableBody.appendChild(noUserRow);
              }
              setTimeout(() => {
                messageDiv.classList.remove("show");
              }, 3000);
            }
          } else {
            messageDiv.classList.add("alert-danger");
            setTimeout(() => {
              messageDiv.classList.remove("show");
            }, 5000);
          }
        }
      };
      // Use the POST method and set the appropriate content type
      xhttp.open("POST", "?route=user_manage");
      xhttp.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
      );
      // Send the request with the userId as data
      let data = `action=delete&user_id=${userId}`;
      xhttp.send(data);
    }
  });
}


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

