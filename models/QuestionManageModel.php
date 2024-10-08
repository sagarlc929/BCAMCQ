<?php

class QuestionManageModel {
  private $conn;

  public function __construct() {
    // Database connection is established in the constructor
    $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check the connection
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }


  public function deleteQuestion($questionId) {
    // Prepare the DELETE query using a prepared statement to avoid SQL injection
    $query = "DELETE FROM subject_question WHERE question_id = ?;"; // Delete related entries first
    $stmt = $this->conn->prepare($query);

    if (!$stmt) {
      return false;
    }

    $stmt->bind_param('i', $questionId);
    $stmt->execute();

    $stmt->close();

    $query = "DELETE FROM question WHERE question_id = ?";
    $stmt = $this->conn->prepare($query);

    if (!$stmt) {
      return false;
    }

    $stmt->bind_param('i', $questionId);
    $stmt->execute();

    $stmt->close();

    return true;
  }


  public function getAllQuestion() {
    $questions = array(); // Initialize an array to store the questions

    // Query to fetch questions from the database
    $query = "SELECT * FROM question";

    // Execute the query
    $result = $this->conn->query($query);

    if ($result) {
      // Fetch rows and store them in the $questions array
      while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
      }
      $result->free(); // Free the result set
    } else {
      // Handle the query error if needed
      echo "Error: " . $this->conn->error;
    }

    return $questions;
  }


  public function getQuestions($subjectSelected){
    $questions = array(); // initialize an array to store the questions

    $query = "SELECT subject_id FROM subject WHERE subject_name=?";
    $stmt = $this->conn->prepare($query);

    if (!$stmt) {
      return ['status' => false, 'message' => 'Failed to prepare the statement.'];
    }

    $stmt->bind_param('s', $subjectSelected);
    $stmt->execute();

    $result = $stmt->get_result(); // get the result set from the executed query

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc(); // fetch the row from the result set
      $subjectId = $row['subject_id']; // get the subject id from the fetched row
      $stmt->close();
    } else {
      $stmt->close();
      return ['status' => false, 'message' => 'Subject not found.'];
    }

    // query to fetch questions from the database
    $query = "SELECT question.question_id, question.description, question.option_A, question.option_B, question.option_C, question.option_D, question.answer, question.explanation, question.year 
      FROM question
      INNER JOIN subject_question ON question.question_id = subject_question.question_id
      INNER JOIN subject ON subject_question.subject_id = subject.subject_id 
      WHERE subject.subject_name = ?";

    $stmt = $this->conn->prepare($query);

    if (!$stmt) {
      return ['status' => false, 'message' => 'Failed to prepare the statement.'];
    }

    $stmt->bind_param('s', $subjectSelected);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
      // fetch rows and store them in the $questions array
      while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
      }
      $result->free(); // free the result set
    } else {
      // handle the query error if needed
      echo "Error: " . $this->conn->error;
    }

    return $questions;
  }

  public function addQuestion($description, $optionA, $optionB, $optionC,$optionD, $answer, $explanation, $subjectSelect,$year) {

    $query = "SELECT subject_id FROM subject WHERE subject_name=?";
    $stmt = $this->conn->prepare($query);

    if (!$stmt) {
      return ['status' => false, 'message' => 'Failed to prepare the statement.'];
    }

    $stmt->bind_param('s', $subjectSelect);
    $stmt->execute();

    $result = $stmt->get_result(); // Get the result set from the executed query

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc(); // Fetch the row from the result set
      $subjectId = $row['subject_id']; // Get the subject ID from the fetched row
      $stmt->close();
    } else {
      $stmt->close();
      return ['status' => false, 'message' => 'Subject not found.'];
    }

    $query = "INSERT INTO question (description, option_A, option_B, option_C, option_D, answer, explanation, year)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($query);

    if (!$stmt) {
      return ['status' => false, 'message' => 'Failed to prepare the statement.'];
    }

    $stmt->bind_param('sssssssi', $description, $optionA, $optionB, $optionC, $optionD, $answer, $explanation, $year);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
      $insertedId = $stmt->insert_id; // Get the auto-generated ID of the inserted question

      // Insert into subject_question table
      $query = "INSERT INTO subject_question (subject_id,question_id) VALUES (?, ?)";
      $stmt = $this->conn->prepare($query);

      if (!$stmt) {
        return ['status' => false, 'message' => 'Failed to prepare the statement for subject_question insertion.'];
      }

      $stmt->bind_param('ii', $subjectId, $insertedId);
      $stmt->execute();

      if ($stmt->affected_rows > 0) {
        $stmt->close();
        return ['status' => true, 'message' => 'Question added successfully.', 'id'=> $insertedId];
      } else {
        $stmt->close();
        return ['status' => false, 'message' => 'Failed to add question to subject_question table.'];
      }
    } else {
      $stmt->close();
      return ['status' => false, 'message' => 'Failed to add question to questions_table.'];
    }
  }

  //$response = $this->updateQuestion($id,$description,$optionA,$optionB,$optionC,$optionD,$answer,$explanation);
 

public function updateQuestion($id, $description, $optionA, $optionB, $optionC, $optionD, $answer, $explanation, $year) {
  // Query to check if the data is the same as the current data
  $checkQuery = "SELECT * FROM question WHERE question_id=? AND description=? AND option_A=? AND option_B=? AND option_C=? AND option_D=? AND answer=? AND explanation=? AND year=?";
  $checkStmt = $this->conn->prepare($checkQuery);

  if (!$checkStmt) {
    return ['status' => false, 'message' => 'Failed to prepare the statement for data check.'];
  }

  $checkStmt->bind_param('isssssssi', $id, $description, $optionA, $optionB, $optionC, $optionD, $answer, $explanation, $year);
  $checkStmt->execute();
  $checkStmt->store_result();

  if ($checkStmt->num_rows > 0) {
    $checkStmt->close();
    return ['status' => false, 'message' => 'The update data is the same as the existing data.'];
  }
  
  $checkStmt->close();

  // Update the question in the question table
  $query = "UPDATE question SET description=?, option_A=?, option_B=?, option_C=?, option_D=?, answer=?, explanation=?, year=? WHERE question_id=?";
  $stmt = $this->conn->prepare($query);

  if (!$stmt) {
    return ['status' => false, 'message' => 'Failed to prepare the statement for question update.'];
  }

  $stmt->bind_param('sssssssii', $description, $optionA, $optionB, $optionC, $optionD, $answer, $explanation,$year ,$id);
  $stmt->execute();

  if ($stmt->affected_rows > 0) {
    return ['status' => true, 'message' => 'Question updated successfully.'];
  } else {
    return ['status' => false, 'message' => 'No changes were made to the question.'];
  }
}

  public function closeConnection() {
    // Close the database connection
    $this->conn->close();
  }

}
?>
