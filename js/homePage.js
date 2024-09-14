
document.addEventListener("DOMContentLoaded", function() {
  const quizContainer = document.getElementById("quiz-container");
  const questionContainer = document.getElementById("question-container");
  const correctAnswerContainer = document.getElementById("correct-answer");
  const correctAnswerDiv = document.getElementById("correct-answer");

  function fetchQuestion() {
    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
        console.log(this.responseText);

        // Sanitize the response
        let sanitizedResponse = this.responseText.replace(/\n/g, '').trim();
        sanitizedResponse = sanitizedResponse.replace(/^>/, '').trim();

        // Parse the JSON response
        const responseObject = JSON.parse(sanitizedResponse);

        if (responseObject.status === 1 && responseObject.data) {
          const questionData = responseObject.data;
          displayQuestion(questionData);
        } else {
          console.error("Failed to fetch question: ", responseObject.message);
        }
      } else if (this.readyState === 4) {
        console.error("Error fetching data. Status:", this.status);
      }
    };

    xhttp.open("POST", "?route=home", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    let data = `action=getARanQuestion`;
    xhttp.send(data);
  }

  function displayQuestion(questionData) {
    const optionsContainer = document.getElementById("options-container");

    // Hide the correct answer container and show the question container
    correctAnswerDiv.style.display = "none";
    quizContainer.style.display = "block";
    optionsContainer.innerHTML = "";

    // Set the question text
    questionContainer.innerHTML = questionData.description;

    // Create the options dynamically
    const options = ["A", "B", "C", "D"];
    options.forEach((option) => {
      const radioButton = document.createElement("input");
      radioButton.type = "radio";
      radioButton.name = "option";
      radioButton.id = "radioBtn-" + option;

      const label = document.createElement("label");
      label.textContent = questionData[`option_${option}`];
      label.setAttribute("for", "radioBtn-" + option);

      const div = document.createElement("div");
      div.classList.add("option");
      div.appendChild(radioButton);
      div.appendChild(label);

      optionsContainer.appendChild(div);
    });

    // Randomly select an option
    const randomOption = options[Math.floor(Math.random() * options.length)];
    document.getElementById("radioBtn-" + randomOption).checked = true;

    // Show the question for 5 seconds, then show the answer
    setTimeout(() => {
      checkAnswer(questionData);
    }, 5000); // Check answer after 5 seconds
  }

  function checkAnswer(questionData) {
    const selectedOption = document.querySelector('input[name="option"]:checked');
    if (selectedOption) {
      const selectedOptionId = selectedOption.id.split("-")[1];
      const selectedOptionText = questionData[`option_${selectedOptionId}`];
      const correctAnswer = questionData.answer;

      const quizDiv = document.createElement("div");
      quizDiv.classList.add("card");

      // Add appropriate class based on whether the selected answer is correct or not
      if (selectedOptionText === correctAnswer) {
        quizDiv.classList.add("correctAnsweredQn");
      } else {
        quizDiv.classList.add("wrongAnsweredQn");
      }

      const descriptionDiv = document.createElement("div");
      descriptionDiv.innerHTML = questionData.description;

      const optionDiv = document.createElement("div");
      ["A", "B", "C", "D"].forEach((option) => {
        const eachOption = document.createElement("div");
        const optionText = questionData[`option_${option}`];

        // Apply styles based on correctness of options
        if (optionText === correctAnswer) {
          eachOption.classList.add("correct-option", "text-2xl");
        } else if (selectedOptionText === optionText) {
          eachOption.classList.add("wrong-option", "text-2xl");
        } else {
          eachOption.classList.add("none-option", "text-2xl");
        }
        eachOption.textContent = optionText;
        optionDiv.appendChild(eachOption);
      });

      const explainDiv = document.createElement("div");
      explainDiv.classList.add("answer-explanation", "text-3xl");
      explainDiv.innerHTML = questionData.explanation;

      quizDiv.appendChild(descriptionDiv);
      quizDiv.appendChild(optionDiv);
      quizDiv.appendChild(explainDiv);

      correctAnswerContainer.innerHTML = ''; // Clear previous answers
      correctAnswerContainer.appendChild(quizDiv);

      // Hide the question container and show the correct answer container
      correctAnswerDiv.style.display = "block";
      quizContainer.style.display = "none";

      // Fetch a new question after displaying the answer for 5 seconds
      setTimeout(() => {
        fetchQuestion(); // Fetch a new question
      }, 5000); // New question after 5 seconds
    } else {
      // If no option is selected, just hide the question and show a message
      questionContainer.style.display = "none";
      correctAnswerContainer.innerHTML = "<div class='card'><p>No option selected</p></div>";
      correctAnswerContainer.style.display = "block";

      // Fetch a new question after displaying the message for 5 seconds
      setTimeout(() => {
        fetchQuestion(); // Fetch a new question
      }, 5000); // New question after 5 seconds
    }
  }

  // Fetch the first question when the page loads
  fetchQuestion();
});

