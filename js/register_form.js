
const form = document.getElementById('registrationForm');
const submitBtn = document.getElementById('submit');
const messageDiv = document.getElementById('message');
const xhttp = new XMLHttpRequest(); // Move this line outside the event listener
submitBtn.addEventListener('click', (event) => {
  event.preventDefault(); // Prevent form submission
  if (validateForm()) {
    const formData = new FormData(form);

    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);

        const responseObject = JSON.parse(this.responseText);
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
      }
    };

    xhttp.open("POST", "?route=register");
    xhttp.send(formData);
  }
});

function goLogin() {
  window.location.href = "?route=login";
}

function validateForm() {
  let isValid = true;

  // Get form fields
  const firstName = document.getElementById('first-name').value.trim();
  const lastName = document.getElementById('last-name').value.trim();
  const email = document.getElementById('email').value.trim();
  const contactNo = document.getElementById('contact-no').value.trim();
  const username = document.getElementById('user-name').value.trim();
  const password = document.getElementById('new-password').value.trim();
  const confirmPassword = document.getElementById('confirm-password').value.trim();
  const termsChecked = document.getElementById('terms-and-conditions').checked;

  // Validate first name
  if (!firstName) {
    showMessage('Please enter your first name');
    isValid = false;
    return false; // Stop further validation
  }

  // Validate last name
  if (!lastName) {
    showMessage('Please enter your last name');
    isValid = false;
    return false;
  }

  // Validate email
  if (!email) {
    showMessage('Please enter your email');
    isValid = false;
    return false;
  } else if (!validateEmail(email)) {
    showMessage('Please enter a valid email address');
    isValid = false;
    return false;
  }

  // Validate contact number
  if (!contactNo) {
    showMessage('Please enter your contact number');
    isValid = false;
    return false;
  } else if (!validatePhoneNumber(contactNo)) {
    showMessage('Please enter a valid 10-digit contact number');
    isValid = false;
    return false;
  }

  // Validate username
  if (!username) {
    showMessage('Please enter a username');
    isValid = false;
    return false;
  }

  // Validate password
  if (!password) {
    showMessage('Please create a password');
    isValid = false;
    return false;
  } else if (!validatePassword(password)) {
    showMessage('Password must be at least 8 characters long, and include at least one number or special character.');
    isValid = false;
    return false;
  }

  // Validate confirm password
  if (!confirmPassword) {
    showMessage('Please confirm your password');
    isValid = false;
    return false;
  } else if (password !== confirmPassword) {
    showMessage('Passwords do not match');
    isValid = false;
    return false;
  }

  // Validate terms and conditions checkbox
  if (!termsChecked) {
    showMessage('You must accept the terms and conditions');
    isValid = false;
    return false;
  }

  return isValid; // Return true if all validations pass
}

// Helper function for validating email
function validateEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email);
}

// Helper function for validating password
function validatePassword(password) {
  const re = /^(?=.*[A-Za-z])(?=.*\d|.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
  return re.test(password);
}

// Helper function for validating phone number
function validatePhoneNumber(phoneNumber) {
  const re = /^\d{10}$/;
  return re.test(phoneNumber);
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

