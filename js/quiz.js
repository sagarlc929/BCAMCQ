const questionContainer = document.getElementById("question-container");
const optionsContainer = document.getElementById("options-container");
const resultContainer = document.getElementById("result-container");
const quizContainer = document.getElementById("quiz-container");
const correctAnswer = document.getElementById("correct-answer");
const wrongAnswers = [];
var currentQuestion = 0;
var score = 0;
//console.log("hi sagar");
//console.log("questions");
function showQuestion() {
  clearOptionsContainer()
  const currentQuestionObject = questions[currentQuestion];
  questionContainer.innerHTML = currentQuestionObject["description"];
  currentQuestionObject.options.forEach((option, index) => {

    // Create radio button
    const radioButton = document.createElement("input");
    radioButton.type = "radio";
    radioButton.name = "option";
    radioButton.id = String.fromCharCode(65 + index); // ASCII value of a is 65

    // Create lable for radio button
    const label = document.createElement("label");
    label.textContent = option;
    label.setAttribute("for", String.fromCharCode(65 + index));

    // Creating div to store row radio button and it's label
    const div = document.createElement("div");
    div.id = "option-" + String.fromCharCode(65 + index);
    // Append radio button and label div in continer
    optionsContainer.appendChild(div);
    div.appendChild(radioButton);
    div.appendChild(label);
    div.appendChild(document.createElement("br"));
  });
}

function checkAnswer() {
  // Get the selected options
  const selectedOption = document.querySelector('input[name="option"]:checked');
  // Check if an option is selecolor: var(--red-color); /* Ucted
  if (selectedOption) {
    const selectedOptionId = selectedOption.id; // Get the value of selected  option
    const currentQuestionObject = questions[currentQuestion];
    // Compare the selected answer with the correct answer
    if (selectedOptionId === currentQuestionObject.answer) {
      score++;
      console.log("correct");
    } else {
      console.log("wrong");
      const wrongAnswer = {
        wrongQuNumber: currentQuestion,
        wrongQnOption: selectedOptionId
      }
      wrongAnswers.push(wrongAnswer);
      console.log(wrongAnswers);
    }
    // move to the next quesion or display result 
    if (currentQuestion < questions.length - 1) {
      // If there are more quesions, move to next quesion
      currentQuestion++;
      showQuestion();
    } else {
      // If the quesions have been answered, show the result
      showResult();
    }
  } else {

  }

}

function clearOptionsContainer() {
  optionsContainer.innerHTML = ""; // Clear the content of the options container
}

/*
  <div id="result-container" class="result-container" style="display:none;">
  <div id="result" class="result"></div>
  <div id="correct-answer" class="correct-answer"></div>
<
  */
function showResult() {

  quizContainer.style.display = "none";
  resultContainer.style.display = "block";
  showResultDiv();
  explainAnswer();
}
function explainAnswer() {

  const wrongQnNumberArr = [];
  const wrongQnOptionArr = [];
  wrongAnswers.forEach((answer) => {
    wrongQnNumberArr.push(answer.wrongQuNumber);
    wrongQnOptionArr.push(answer.wrongQnOption);
  });

  for (let i = 0; i < questions.length; i++) {
    const question = questions[i];

    const quizDiv = document.createElement("div");
    quizDiv.id = "answer-" + i;

    if (wrongQnNumberArr.includes(i)) {
      quizDiv.classList.add("wrongAnsweredQn");
      quizDiv.classList.add("card");
    } else {
      quizDiv.classList.add("correctAnsweredQn");
      quizDiv.classList.add("card");
    }

    console.log(wrongQnNumberArr);
    console.log(wrongQnOptionArr);
    const descriptionDiv = document.createElement("div");
    descriptionDiv.innerHTML = question["description"];

    const optionDiv = document.createElement("div");

    question.options.forEach((option, index) => {
      const eachOption = document.createElement("div");
      const idChar = String.fromCharCode(65 + index); // ASCII value of a is 97
      eachOption.id = idChar;
      if (idChar === wrongQnOptionArr[i]) {
        eachOption.classList.add("wrong-option");
      } else if (idChar == question.answer) {
        eachOption.classList.add("correct-option");
      } else {
        eachOption.classList.add("none-option");
      }
      eachOption.textContent = option;
      optionDiv.appendChild(eachOption);
      //optionDiv.appendChild(document.createElement("br"));
    });

    const explainDiv = document.createElement("div");
    explainDiv.classList.add("answer-explanation");
    explainDiv.innerHTML = question["explanation"];

    quizDiv.appendChild(descriptionDiv);
    quizDiv.appendChild(optionDiv);
    quizDiv.appendChild(explainDiv);
    correctAnswer.appendChild(quizDiv);

  }

}
function showResultDiv() {
  const resultMarksDiv = document.getElementById("result-marks");
  resultMarksDiv.innerHTML = `marks:${score}/10`;
}
//test  
//showResult();
showQuestion();
