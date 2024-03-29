
//<div id="questions">

const questions = document.getElementById("questions");
//var allQuestion = <?php echo json_encode($AllQuestion); ?>;
//console.log(allQuestion);

questions.innerHTML = generateTable(allQuestion);
    function generateTable(data) {
      let table = '<table border="1">';
      table += '<tr><th>ID</th><th>Description</th><th>Option A</th><th>Option B</th><th>Option C</th><th>Option D</th><th>Answer</th><th>Explanation</th><th>Manage</th></tr>';
      
      data.forEach(item => {
        table += '<tr>';
        table += `<td>${item.question_id}</td>`;
        table += `<td>${item.description}</td>`;
        table += `<td>${item.option_A}</td>`;
        table += `<td>${item.option_B}</td>`;
        table += `<td>${item.option_C}</td>`;
        table += `<td>${item.option_D}</td>`;
        table += `<td>${item.answer}</td>`;
    table += `<td>${item.explanation}</td>`;
  
table += `<td>
 <form action="?route=question_manage" method="POST">
  <input type="hidden" name="action" value="delete">
  <input type="hidden" onclick="deleteQuestion()" name="question_id" value="${item.question_id}"> <!-- Replace "1" with the actual question ID -->
  <button type="submit">Delete</button>
</form>
  <form action="?route=question_manage&action=modify" method="POST">
    <input type="hidden" name="question_id" value="${item.question_id}">
    <button type="submit">Modify</button>
  </form>
</td>`;
table += '</tr>';

      });

      table += '</table>';
      return table;
}



function deleteQuestion() {
  // Prompt the user for confirmation
  if (confirm("Are you sure you want to delete this question?")) {
  }
}

