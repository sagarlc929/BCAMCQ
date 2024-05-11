const questionContainer = document.getElementById("question-container");
const optionsContainer = document.getElementById("options-container");
const resultContainer = document.getElementById("result-container");
const quizContainer = document.getElementById("quiz-container");
const correctAnswer = document.getElementById("correct-answer");
const wrongAnswers = [];
var currentQuestion = 0;
var score = 0;


function showQuestion() {
  clearOptionsContainer()
  const currentQuestionObject = questions[currentQuestion];
  questionContainer.innerHTML = currentQuestionObject["description"];
  currentQuestionObject.options.forEach((option, index) => {

    // Create radio button
    const radioButton = document.createElement("input");
    radioButton.type = "radio";
    radioButton.name = "option";
    radioButton.id = "radioBtn-"+String.fromCharCode(65 + index); // ASCII value of a is 65

    // Create lable for radio button
    const label = document.createElement("label");
    label.textContent = option;
    label.id = "label-" + String.fromCharCode(65+index);
    
    label.setAttribute("for", "radioBtn-"+String.fromCharCode(65 + index));

    // Creating div to store row radio button and it's label
    const div = document.createElement("div");
    div.id = "option-" + String.fromCharCode(65 + index);
    // Append radio button and label div in continer
    optionsContainer.appendChild(div);
    div.appendChild(radioButton);
    div.appendChild(label);
    // Compare the selected answer with the correct answer
    div.appendChild(document.createElement("br"));
  });
}


function checkAnswer() {
  // Get the selected options
  const selectedOption = document.querySelector('input[name="option"]:checked');
  // Check if an option is selecolor: var(--red-color); /* Ucted
  if (selectedOption) {
    const selectedOptionChar = selectedOption.id.split('-')[1]; // Get the value of selected  option
    const selectedLableValue = document.getElementById("label-"+selectedOptionChar).innerText;
    const currentQuestionObject = questions[currentQuestion];
    if (selectedLableValue === currentQuestionObject.answer) {
      score++;
    } else {
      const wrongAnswer = {
        wrongQuNumber: currentQuestion,
        wrongQnOption: selectedLableValue
      }
      wrongAnswers.push(wrongAnswer);
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
    const descriptionDiv = document.createElement("div");
    descriptionDiv.innerHTML = question["description"];

    const optionDiv = document.createElement("div");

    question.options.forEach((option, index) => {
      const eachOption = document.createElement("div");
      console.log(wrongAnswers);
      //if (option === wrongQnOptionArr[i]) {
      var a = i;
      //console.log(`***${option}***${wrongQnOptionArr[i]}***${i}`)
      if (option === wrongQnOptionArr[i]) {
        eachOption.classList.add("wrong-option");
      } else if (option == question.answer) {
        eachOption.classList.add("correct-option");
      } else {
        eachOption.classList.add("none-option");
      }
      eachOption.textContent = option;
      optionDiv.appendChild(eachOption);
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
  resultMarksDiv.innerHTML = `marks:${score}/${questions.length}`;
}


showQuestion();
