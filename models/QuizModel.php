<?php
class QuizModel {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        
        // Check the connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    /**
     * Get regular questions based on subject and number.
     * @param string $subject The name of the subject.
     * @param int $num The number of questions to retrieve.
     * @return array An associative array containing an array of questions.
     */
    public function getQuestionsRegModel($subject, $num) {
        $questions = [];
        $subjectId = $this->getSubjectId($subject);

        if ($subjectId) {
            $query = "SELECT description, option_A, option_B, option_C, option_D, answer, explanation 
                      FROM question 
                      JOIN subject_question ON question.question_id = subject_question.question_id 
                      JOIN subject ON subject_question.subject_id = subject.subject_id 
                      WHERE subject.subject_id = ? 
                      ORDER BY RAND() 
                      LIMIT ?";
            
            if ($stmt = $this->conn->prepare($query)) {
                $stmt->bind_param("ii", $subjectId, $num);
                $stmt->execute();
                $result = $stmt->get_result();
                
                while ($row = $result->fetch_assoc()) {
                    $questions[] = $row;
                }
                
                $result->free();
                $stmt->close();
            } else {
                // Handle the query error
                echo "Error: " . $this->conn->error;
            }
        }

        return ['questions' => $questions];
    }

    /**
     * Get past questions based on subject and year.
     * @param string $subject The name of the subject.
     * @param string $year The year of the questions.
     * @return array An associative array containing an array of questions.
     */
    public function getQuestionsPasModel($subject, $year) {
        $questions = [];
        $subjectId = $this->getSubjectId($subject);

        if ($subjectId) {
            /*
            $query = "SELECT description, option_A, option_B, option_C, option_D, answer, explanation 
                      FROM question 
                      JOIN subject_question ON question.question_id = subject_question.question_id 
                      JOIN semester_subject ON subject_question.subject_id = semester_subject.subject_id 
                      JOIN semester ON semester_subject.semester_id = semester.semester_id 
                      WHERE subject.subject_id = ? AND semester.semester_name = ? 
                      ORDER BY RAND() 
                      LIMIT 10";
           */
             $query = "SELECT description, option_A, option_B, option_C, option_D, answer, explanation 
                      FROM question 
                      JOIN subject_question ON question.question_id = subject_question.question_id 
                      JOIN subject ON subject_question.subject_id = subject.subject_id 
                      WHERE subject.subject_id = ? AND question.year = ?
                      ORDER BY RAND() 
                      LIMIT 10";

            if ($stmt = $this->conn->prepare($query)) {
                $stmt->bind_param("ss", $subjectId, $year);
                $stmt->execute();
                $result = $stmt->get_result();
                
                while ($row = $result->fetch_assoc()) {
                    $questions[] = $row;
                }
                
                $result->free();
                $stmt->close();
            } else {
                // Handle the query error
                echo "Error: " . $this->conn->error;
            }
        }

        return ['questions' => $questions];
    }

    /**
     * Fetch the subject ID based on the subject name.
     * @param string $subject The name of the subject.
     * @return int|null The ID of the subject, or null if not found.
     */
    public function getSubjectId($subject) {
        $subjectId = null;
        $query = "SELECT subject_id FROM subject WHERE subject_name = ?";
        
        if ($stmt = $this->conn->prepare($query)) {
            $stmt->bind_param("s", $subject);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($row = $result->fetch_assoc()) {
                $subjectId = $row['subject_id'];
            }
            
            $result->free();
            $stmt->close();
        } else {
            // Handle the query error
            echo "Error: " . $this->conn->error;
        }
        
        return $subjectId;
    }
public function getSemesterFromSubject($subject) {
    $semesterName = null;

    // Step 1: Get subject_id from subject table
    $subjectId = null;
    $query = "SELECT subject_id FROM subject WHERE subject_name = ?";
    
    if ($stmt = $this->conn->prepare($query)) {
        $stmt->bind_param("s", $subject);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            $subjectId = $row['subject_id'];
        }
        
        $result->free();
        $stmt->close();
    } else {
        // Handle the query error
        echo "Error fetching subject_id: " . $this->conn->error;
        return null;
    }

    // If subject_id is found, move on to Step 2
    if ($subjectId) {
        // Step 2: Get semester_id from semester_subject table
        $semesterId = null;
        $query = "SELECT semester_id FROM semester_subject WHERE subject_id = ?";
        
        if ($stmt = $this->conn->prepare($query)) {
            $stmt->bind_param("i", $subjectId); // "i" for integer
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($row = $result->fetch_assoc()) {
                $semesterId = $row['semester_id']; // Fetching the semester_id
            }
            
            $result->free();
            $stmt->close();
        } else {
            // Handle the query error
            echo "Error fetching semester_id: " . $this->conn->error;
            return null;
        }

        // Step 3: Get semester_name from semester table using semester_id
        if ($semesterId) {
            $query = "SELECT semester_name FROM semester WHERE semester_id = ?";
            
            if ($stmt = $this->conn->prepare($query)) {
                $stmt->bind_param("i", $semesterId); // "i" for integer
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($row = $result->fetch_assoc()) {
                    $semesterName = $row['semester_name']; // Fetching the semester_name
                }
                
                $result->free();
                $stmt->close();
            } else {
                // Handle the query error
                echo "Error fetching semester_name: " . $this->conn->error;
            }
        }
    }

    return $semesterName; // Return the semester name
}


    public function closeConnection() {
        $this->conn->close();
    }
}
?>

