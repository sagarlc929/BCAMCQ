
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
  const inputs = form.querySelectorAll('input');

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
  messageDiv.innerText = message;
}

