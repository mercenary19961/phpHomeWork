<?php 
require '../config.php';

function error422($message) {
    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header("HTTP/1.0 422 Unprocessable Entity");
    echo json_encode($data);
    exit;
}

// Read a Student subjects data
function getStudentSubjects($studentParams) {
    global $conn;

    if (!isset($studentParams['name'])) {
        return error422("Please enter a student name");
    }

    $name = mysqli_real_escape_string($conn, $studentParams["name"]);
    $query = "SELECT students.name, subjects.name
                FROM student_subject
                JOIN students ON students.student_id = student_subject.student_id
                JOIN subjects ON subjects.subject_id = student_subject.subject_id
                WHERE students.name = '$name' ";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 1) {
            $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' => 'Student subjects fetched successfully',
                'data' => $res
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'Error Not Found'
            ];
            header("HTTP/1.0 404 Error Not Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Issue'
        ];
        header("HTTP/1.0 500 Internal Server Issue");
        return json_encode($data);
    }
}


// Read a Student subjects data
function getSubjectStudents($subjectParams) {
    global $conn;

    if (!isset($subjectParams['name'])) {
        return error422("Please enter a student name");
    }

    $name = mysqli_real_escape_string($conn, $subjectParams["name"]);
    $query = "SELECT subjects.name, students.name
                FROM student_subject
                JOIN subjects ON subjects.subject_id = student_subject.subject_id
                JOIN students ON students.student_id = student_subject.student_id
                WHERE subjects.name = '$name' ";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 1) {
            $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' => 'Subject students fetched successfully',
                'data' => $res
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'Error Not Found'
            ];
            header("HTTP/1.0 404 Error Not Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Issue'
        ];
        header("HTTP/1.0 500 Internal Server Issue");
        return json_encode($data);
    }
}

// Add students to subjects or subjects to students
function registerStudentInSubject($data) {
    global $conn;

    $student_name = mysqli_real_escape_string($conn, $data['student_name']);
    $subject_name = mysqli_real_escape_string($conn, $data['subject_name']);

    // here we get student ID by name to make the sql code simpler
    $studentQuery = "SELECT student_id FROM students WHERE name='$student_name' LIMIT 1";
    $studentResult = mysqli_query($conn, $studentQuery);

    // same for the subject ID
    $subjectQuery = "SELECT subject_id FROM subjects WHERE name='$subject_name' LIMIT 1";
    $subjectResult = mysqli_query($conn, $subjectQuery);

    if (mysqli_num_rows($studentResult) == 0) {
        return json_encode(["status" => 404, "message" => "Student Not Found"]);
    }

    if (mysqli_num_rows($subjectResult) == 0) {
        return json_encode(["status" => 404, "message" => "Subject Not Found"]);
    }

    $studentRow = mysqli_fetch_assoc($studentResult);
    $subjectRow = mysqli_fetch_assoc($subjectResult);

    $student_id = $studentRow['student_id'];
    $subject_id = $subjectRow['subject_id'];

    // Check if the student is already registered in the subject
    $checkQuery = "SELECT * FROM student_subject WHERE student_id='$student_id' AND subject_id='$subject_id' LIMIT 1";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $data = [
            "status" => 409, 
            "message" => "Student is already registered in this subject"
        ];
        header("HTTP/1.0 409 Student is already registered in this subject");
        return json_encode($data);
    }

    $query = "INSERT INTO student_subject (student_id, subject_id) VALUES ('$student_id', '$subject_id')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = [
            'status' => 201,
            'message' => 'Subject students created successfully'
        ];
        header("HTTP/1.0 201 Created");
        return json_encode($data);
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Issue'
        ];
        header("HTTP/1.0 500 Internal Server Issue");
        return json_encode($data);
    }
}

// Show all exams for a student
function getStudentExams($studentName) {
    global $conn;

    $studentName = mysqli_real_escape_string($conn, $studentName);

    $query = "
        SELECT students.name AS student_name, subjects.name AS subject_name, exams.exam_id, exams.exam_date, exams.max_score
        FROM student_subject
        JOIN subjects ON subjects.subject_id = student_subject.subject_id
        JOIN exams ON exams.subject_id = subjects.subject_id
        JOIN students ON student_subject.student_id = students.student_id
        WHERE students.name = '$studentName'
    ";
    
    $result = mysqli_query($conn, $query);

    if ($result) {
        $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        if (count($res) > 0) {
            $data = [
                "status" => 200,
                "message" => "Exams retrieved successfully",
                "data" => $res
            ];
            header("HTTP 1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'Error Not Found'
            ];
            header("HTTP/1.0 404 Error Not Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Issue'
        ];
        header("HTTP/1.0 500 Internal Server Issue");
        return json_encode($data);
    }
}

// Show all exams for a specific subject
function getSubjectExams($subjectName) {
    global $conn;

    $subjectName = mysqli_real_escape_string($conn, $subjectName);

    $query = "
        SELECT subjects.name, exams.exam_id, exams.exam_date, exams.max_score
        FROM subjects
        JOIN exams ON subjects.subject_id = exams.subject_id
        WHERE subjects.name = '$subjectName'
    ";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $res = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if (count($res) > 0) {
            $data = [
                "status" => 200,
                "message" => "Exams retrieved successfully",
                "data" => $res
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No exams found for the specified subject'
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error'
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}

// Update the score of an exam
function updateExamScore($examId, $score) {
    global $conn;

    $examId = mysqli_real_escape_string($conn, $examId);
    $score = mysqli_real_escape_string($conn, $score);

    // Update the score if it has changed
    $updateQuery = "UPDATE exams SET score = '$score' WHERE exam_id = '$examId'";
    $result = mysqli_query($conn, $updateQuery);

    if ($result) {
        $affectedRows = mysqli_affected_rows($conn);
        if ($affectedRows > 0) {
            $data = [
                "status" => 200,
                "message" => "Exam score updated successfully",
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                "status" => 200,
                "message" => "No changes detected, score remains the same",
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        }
    } else {
        $data = [
            "status" => 500,
            "message" => "Internal Server Error"
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}


?>