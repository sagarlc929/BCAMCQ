//var allQuestion = <?php echo json_encode($allQuestion); ?>;
generateTable(allQuestion); //questions.innerHTML = generateTable(allQuestion);
 function generateTable(data) {
            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = '';

            data.forEach(item => {
                const row = document.createElement('tr');
                  row.id = item.question_id;
                row.innerHTML = `
                    <td>${item.question_id}</td>
                    <td>${item.description}</td>
                    <td>${item.option_A}</td>
                    <td>${item.option_B}</td>
                    <td>${item.option_C}</td>
                    <td>${item.option_D}</td>
                    <td>${item.answer}</td>
                    <td>${item.explanation}</td>
                    <td class="table-controls">
                        <button class="deleteBtn" type="button" data-question-id="${item.question_id}">DELETE</button>
                        <button class="modifyBtn" type="button">Modify</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
}


document.addEventListener('DOMContentLoaded', function() {
    // Get all the buttons with the class 'deleteBtn'
  const deleteBtns = document.querySelectorAll('.deleteBtn');

  // Loop through each button and add a click event listener
  deleteBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const questionId = btn.dataset.questionId;
      console.log(`Question ID: ${questionId}`);
      // Do something with the questionId, e.g., send an AJAX request to delete the question
      const xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         // document.getElementById("demo").innerHTML =
          console.log("onready:1");
         console.log(this.responseText);
          const responseObject = JSON.parse(this.responseText);
           // responseObject.message
          
        document.getElementById('message').innerText = responseObject.message;
        const rowToDelete = document.getElementById(questionId);
        if(responseObject.delete_flag == 1){
            if (rowToDelete) {
              rowToDelete.remove();
            }
          }
        }
      };
     // Use the POST method and set the appropriate content type
     xhttp.open("POST", "?route=question_manage");
     xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
     // Send the request with the questionId as data
    let data = `action=delete&question_id=${questionId}`;
     xhttp.send(data);
    });
  });
});
  /*
  const deleteElements = document.querySelectorAll('.deleteBtn');
  deleteElements.forEach.addEventListener('click',()=>{

  const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("demo").innerHTML =
        this.responseText;
      }
    };
    xhttp.open("GET", `?route=question_manage&action=delete&id=${id}`);
    xhttp.send(); 
    });
  */

