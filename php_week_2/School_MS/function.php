<?php 
require 'config.php';

function error422($message) {
    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header("HTTP/1.0 422 Unprocessable Entity");
    echo json_encode($data);
    exit;
}

// Create Students data
function createStudent($studentInput) {
    global $conn;

    $name = mysqli_real_escape_string($conn, $studentInput['name']);
    $class = mysqli_real_escape_string($conn, $studentInput['class']);
    $date_of_birth = mysqli_real_escape_string($conn, $studentInput['date_of_birth']);
    $address = mysqli_real_escape_string($conn, $studentInput['address']);
    $phone = mysqli_real_escape_string($conn, $studentInput['phone']);

    if (empty(trim($name))) {
        return error422('Enter your name');
    } elseif (empty(trim($class))) {
        return error422('Enter your class');
    } elseif (empty(trim($date_of_birth))) {
        return error422('Enter your date_of_birth');
    } elseif (empty(trim($address))) {
        return error422('Enter your address');
    } elseif (empty(trim($phone))) {
        return error422('Enter your phone');
    } else {
        $query = "INSERT INTO students (name, class, date_of_birth, address, phone) VALUES ('$name', '$class', '$date_of_birth', '$address', '$phone')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $data = [
                'status' => 201,
                'message' => 'Student Created Successfully',
            ];
            header("HTTP/1.0 201 Created");
            return json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }
}

// Read all Students data
function getStudentList() {
    global $conn;

    $query = "SELECT * FROM students";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'Student list fetched successfully',
                'data' => $res,
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No student found',
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }
    } 
    else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error'
        ];
        header("HTTP/1.0 Internal Server Error");
        return json_encode($data);
    }
}

// Read Student data
function getStudent($studentParams) {
    global $conn;

    if (!isset($studentParams['student_id'])) {
        return error422("Please enter a student id");
    }

    $studentId = mysqli_real_escape_string($conn, $studentParams["student_id"]);
    $query = "SELECT * FROM students WHERE student_id='$studentId' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $res = mysqli_fetch_assoc($result);
            $data = [
                'status' => 200,
                'message' => 'Student fetched successfully',
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

// Update Student data
function updateStudent($studentInput, $studentParams) {
    global $conn;

    if (!isset($studentParams["student_id"])) {
        return error422('Student id Not Found In URL');
    } elseif ($studentParams["student_id"] == null) {
        return error422('Enter student_id');
    }

    $student_id = mysqli_real_escape_string($conn, $studentParams['student_id']);
    $name = mysqli_real_escape_string($conn, $studentInput['name']);
    $class = mysqli_real_escape_string($conn, $studentInput['class']);
    $date_of_birth = mysqli_real_escape_string($conn, $studentInput['date_of_birth']);
    $address = mysqli_real_escape_string($conn, $studentInput['address']);
    $phone = mysqli_real_escape_string($conn, $studentInput['phone']);

    if (empty(trim($name))) {
        return error422('Enter your name');
    } elseif (empty(trim($class))) {
        return error422('Enter your class');
    } elseif (empty(trim($date_of_birth))) {
        return error422('Enter your date_of_birth');
    } elseif (empty(trim($address))) {
        return error422('Enter your address');
    } elseif (empty(trim($phone))) {
        return error422('Enter your phone');
    } else {
        // Check if the student exists
        $checkQuery = "SELECT * FROM students WHERE student_id='$student_id'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) == 1) {
            // Update the student if they exist
            $query = "UPDATE students SET name='$name', class='$class', date_of_birth='$date_of_birth', address='$address', phone='$phone' WHERE student_id='$student_id' LIMIT 1";
            $result = mysqli_query($conn, $query);

            if ($result) {
                if (mysqli_affected_rows($conn) > 0) {
                    $data = [
                        'status' => 200,
                        'message' => 'Student Updated Successfully'
                    ];
                    header("HTTP/1.0 200 OK");
                    return json_encode($data);
                } else {
                    $data = [
                        'status' => 200,
                        'message' => 'No changes made to the student record'
                    ];
                    header("HTTP/1.0 200 OK");
                    return json_encode($data);
                }
            } else {
                $data = [
                    'status' => 500,
                    'message' => 'Internal Server Error',
                ];
                header("HTTP/1.0 500 Internal Server Error");
                return json_encode($data);
            }
        } else {
            $data = [
                'status' => 404,
                'message' => 'No Student Found'
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }
    }
}

// Delete Student data
function deleteStudent($studentParams) {
    global $conn;

    if (!isset($studentParams["student_id"])) {
        return error422('Student id Not Found In URL');
    } elseif ($studentParams["student_id"] == null) {
        return error422('Enter student_id');
    }
    
    $studentId = mysqli_real_escape_string($conn, $studentParams["student_id"]);

    // Check if the student exists
    $checkQuery = "SELECT * FROM students WHERE student_id='$studentId'";
    $checkResult = mysqli_query($conn, $checkQuery);
    
    if (mysqli_num_rows($checkResult) == 1) {

        $query = "DELETE FROM students WHERE student_id='$studentId' ";
        $result = mysqli_query($conn, $query);
    
        if ($result) {
            if (mysqli_affected_rows($conn) == 1) {
                $data = [
                    'status' => 200,
                    'message' => 'Student deleted successfully'
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
        }
        else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 404,
            'message' => 'No Student Found'
        ];
        header("HTTP/1.0 404 Not Found");
        return json_encode($data);
    }

}

// Create Teacher data
function createTeacher($teacherInput) {
    global $conn;

    $name = mysqli_real_escape_string($conn, $teacherInput['name']);
    $subject_id = mysqli_real_escape_string($conn, $teacherInput['subject_id']);
    $contact_info = mysqli_real_escape_string($conn, $teacherInput['contact_info']);

    if (empty(trim($name))) {
        return error422('Enter the teacher name');
    } elseif (empty(trim($subject_id))) {
        return error422('Enter the subject id');
    } elseif (empty(trim($contact_info))) {
        return error422('Enter the contact information');
    } else {
        $query = "INSERT INTO teachers (name, subject_id, contact_info) VALUES ('$name', '$subject_id', '$contact_info')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $data = [
                'status' => 201,
                'message' => 'Teacher Created Successfully',
            ];
            header("HTTP/1.0 201 Created");
            return json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }
}

// Read all Teachers data
function getTeacherList() {
    global $conn;

    $query = "SELECT * FROM teachers";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'Teacher list fetched successfully',
                'data' => $res,
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No teacher found'
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

// Read Teacher data
function getTeacher($teacherParams) {
    global $conn;

    if (!isset($teacherParams['teacher_id'])) {
        return error422("Please enter a teacher id");
    }

    $teacherId = mysqli_real_escape_string($conn, $teacherParams["teacher_id"]);
    $query = "SELECT * FROM teachers WHERE teacher_id='$teacherId' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $res = mysqli_fetch_assoc($result);
            $data = [
                'status' => 200,
                'message' => 'Teacher fetched successfully',
                'data' => $res
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'Teacher Not Found'
            ];
            header("HTTP/1.0 404 Not Found");
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

// Update Teacher data
function updateTeacher($teacherInput, $teacherParams) {
    global $conn;

    if (!isset($teacherParams["teacher_id"])) {
        return error422('Teacher id Not Found In URL');
    } elseif ($teacherParams["teacher_id"] == null) {
        return error422('Enter teacher_id');
    }

    $teacher_id = mysqli_real_escape_string($conn, $teacherParams['teacher_id']);
    $name = mysqli_real_escape_string($conn, $teacherInput['name']);
    $subject_id = mysqli_real_escape_string($conn, $teacherInput['subject_id']);
    $contact_info = mysqli_real_escape_string($conn, $teacherInput['contact_info']);

    if (empty(trim($name))) {
        return error422('Enter the teacher name');
    } elseif (empty(trim($subject_id))) {
        return error422('Enter the subject id');
    } elseif (empty(trim($contact_info))) {
        return error422('Enter the contact information');
    } else {
        // Check if the teacher exists
        $checkQuery = "SELECT * FROM teachers WHERE teacher_id='$teacher_id' LIMIT 1";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // Update the teacher if they exist
            $query = "UPDATE teachers SET name='$name', subject_id='$subject_id', contact_info='$contact_info' WHERE teacher_id='$teacher_id' LIMIT 1";
            $result = mysqli_query($conn, $query);

            if ($result) {
                if (mysqli_affected_rows($conn) > 0) {
                    $data = [
                        'status' => 200,
                        'message' => 'Teacher Updated Successfully'
                    ];
                    header("HTTP/1.0 200 OK");
                    return json_encode($data);
                } else {
                    $data = [
                        'status' => 200,
                        'message' => 'No changes made to the teacher record'
                    ];
                    header("HTTP/1.0 200 OK");
                    return json_encode($data);
                }
            } else {
                $data = [
                    'status' => 500,
                    'message' => 'Internal Server Error',
                ];
                header("HTTP/1.0 500 Internal Server Error");
                return json_encode($data);
            }
        } else {
            $data = [
                'status' => 404,
                'message' => 'No Teacher Found'
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }
    }
}

// Delete Teacher data
function deleteTeacher($teacherParams) {
    global $conn;

    if (!isset($teacherParams["teacher_id"])) {
        return error422('Teacher id Not Found In URL');
    } elseif ($teacherParams["teacher_id"] == null) {
        return error422('Enter teacher_id');
    }

    $teacherId = mysqli_real_escape_string($conn, $teacherParams["teacher_id"]);

    $query = "DELETE FROM teachers WHERE teacher_id='$teacherId' LIMIT 1 ";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_affected_rows($conn) > 0) {
            $data = [
                'status' => 200,
                'message' => 'Teacher deleted successfully'
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'Teacher Not Found'
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}

// Create Subject data
function storeSubject($subjectInput) {
    global $conn;

    $name = mysqli_real_escape_string($conn, $subjectInput['name']);
    $description = mysqli_real_escape_string($conn, $subjectInput['description']);

    if (empty(trim($name))) {
        return error422('Enter the subject name');
    } elseif (empty(trim($description))) {
        return error422('Enter the subject description');
    } else {
        $query = "INSERT INTO subjects (name, description) VALUES ('$name', '$description')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $data = [
                'status' => 201,
                'message' => 'Subject Created Successfully',
            ];
            header("HTTP/1.0 201 Created");
            return json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }
}

// Read all Subjects data
function getSubjectList() {
    global $conn;

    $query = "SELECT * FROM subjects";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'Subject list fetched successfully',
                'data' => $res,
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No subject found'
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

// Read Subject data
function getSubject($subjectParams) {
    global $conn;

    if (!isset($subjectParams['subject_id'])) {
        return error422("Please enter a subject id");
    }

    $subjectId = mysqli_real_escape_string($conn, $subjectParams["subject_id"]);
    $query = "SELECT * FROM subjects WHERE subject_id='$subjectId' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $res = mysqli_fetch_assoc($result);
            $data = [
                'status' => 200,
                'message' => 'Subject fetched successfully',
                'data' => $res
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'Subject Not Found'
            ];
            header("HTTP/1.0 404 Not Found");
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

// Update Subject data
function updateSubject($subjectInput, $subjectParams) {
    global $conn;

    if (!isset($subjectParams["subject_id"])) {
        return error422('Subject id Not Found In URL');
    } elseif ($subjectParams["subject_id"] == null) {
        return error422('Enter subject_id');
    }

    $subject_id = mysqli_real_escape_string($conn, $subjectParams['subject_id']);
    $name = mysqli_real_escape_string($conn, $subjectInput['name']);
    $description = mysqli_real_escape_string($conn, $subjectInput['description']);

    if (empty(trim($name))) {
        return error422('Enter the subject name');
    } elseif (empty(trim($description))) {
        return error422('Enter the subject description');
    } else {
        // Check if the subject exists
        $checkQuery = "SELECT * FROM subjects WHERE subject_id='$subject_id' LIMIT 1";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // Update the subject if they exist
            $query = "UPDATE subjects SET name='$name', description='$description' WHERE subject_id='$subject_id' LIMIT 1";
            $result = mysqli_query($conn, $query);

            if ($result) {
                if (mysqli_affected_rows($conn) > 0) {
                    $data = [
                        'status' => 200,
                        'message' => 'Subject Updated Successfully'
                    ];
                    header("HTTP/1.0 200 OK");
                    return json_encode($data);
                } else {
                    $data = [
                        'status' => 200,
                        'message' => 'No changes made to the subject record'
                    ];
                    header("HTTP/1.0 200 OK");
                    return json_encode($data);
                }
            } else {
                $data = [
                    'status' => 500,
                    'message' => 'Internal Server Error',
                ];
                header("HTTP/1.0 500 Internal Server Error");
                return json_encode($data);
            }
        } else {
            $data = [
                'status' => 404,
                'message' => 'No Subject Found'
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }
    }
}

// Delete Subject data
function deleteSubject($subjectParams) {
    global $conn;

    if (!isset($subjectParams["subject_id"])) {
        return error422('Subject id Not Found In URL');
    } elseif ($subjectParams["subject_id"] == null) {
        return error422('Enter subject_id');
    }

    $subjectId = mysqli_real_escape_string($conn, $subjectParams["subject_id"]);

    $query = "DELETE FROM subjects WHERE subject_id='$subjectId' LIMIT 1 ";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_affected_rows($conn) > 0) {
            $data = [
                'status' => 200,
                'message' => 'Subject deleted successfully'
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'Subject Not Found'
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}

// Create Exam data
function storeExam($examInput) {
    global $conn;

    $subject_id = mysqli_real_escape_string($conn, $examInput['subject_id']);
    $exam_date = mysqli_real_escape_string($conn, $examInput['exam_date']);
    $max_score = mysqli_real_escape_string($conn, $examInput['max_score']);

    if (empty(trim($subject_id))) {
        return error422('Enter the subject id');
    } elseif (empty(trim($exam_date))) {
        return error422('Enter the exam date');
    } elseif (empty(trim($max_score))) {
        return error422('Enter the max score');
    } else {
        $query = "INSERT INTO exams (subject_id, exam_date, max_score) VALUES ('$subject_id', '$exam_date', '$max_score')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $data = [
                'status' => 201,
                'message' => 'Exam Created Successfully',
            ];
            header("HTTP/1.0 201 Created");
            return json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }
}

// Read all Exams data
function getExamList() {
    global $conn;

    $query = "SELECT * FROM exams";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'Exam list fetched successfully',
                'data' => $res,
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No exam found'
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

// Read Exam data
function getExam($examParams) {
    global $conn;

    if (!isset($examParams['exam_id'])) {
        return error422("Please enter an exam id");
    }

    $examId = mysqli_real_escape_string($conn, $examParams["exam_id"]);
    $query = "SELECT * FROM exams WHERE exam_id='$examId' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $res = mysqli_fetch_assoc($result);
            $data = [
                'status' => 200,
                'message' => 'Exam fetched successfully',
                'data' => $res
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'Exam Not Found'
            ];
            header("HTTP/1.0 404 Not Found");
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

// Update Exam data
function updateExam($examInput, $examParams) {
    global $conn;

    if (!isset($examParams["exam_id"])) {
        return error422('Exam id Not Found In URL');
    } elseif ($examParams["exam_id"] == null) {
        return error422('Enter exam_id');
    }

    $exam_id = mysqli_real_escape_string($conn, $examParams['exam_id']);
    $subject_id = mysqli_real_escape_string($conn, $examInput['subject_id']);
    $exam_date = mysqli_real_escape_string($conn, $examInput['exam_date']);
    $max_score = mysqli_real_escape_string($conn, $examInput['max_score']);

    if (empty(trim($subject_id))) {
        return error422('Enter the subject id');
    } elseif (empty(trim($exam_date))) {
        return error422('Enter the exam date');
    } elseif (empty(trim($max_score))) {
        return error422('Enter the max score');
    } else {
        // Check if the exam exists
        $checkQuery = "SELECT * FROM exams WHERE exam_id='$exam_id' LIMIT 1";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // Update the exam if they exist
            $query = "UPDATE exams SET subject_id='$subject_id', exam_date='$exam_date', max_score='$max_score' WHERE exam_id='$exam_id' LIMIT 1";
            $result = mysqli_query($conn, $query);

            if ($result) {
                if (mysqli_affected_rows($conn) > 0) {
                    $data = [
                        'status' => 200,
                        'message' => 'Exam Updated Successfully'
                    ];
                    header("HTTP/1.0 200 OK");
                    return json_encode($data);
                } else {
                    $data = [
                        'status' => 200,
                        'message' => 'No changes made to the exam record'
                    ];
                    header("HTTP/1.0 200 OK");
                    return json_encode($data);
                }
            } else {
                $data = [
                    'status' => 500,
                    'message' => 'Internal Server Error',
                ];
                header("HTTP/1.0 500 Internal Server Error");
                return json_encode($data);
            }
        } else {
            $data = [
                'status' => 404,
                'message' => 'No Exam Found'
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }
    }
}

// Delete Exam data
function deleteExam($examParams) {
    global $conn;

    if (!isset($examParams["exam_id"])) {
        return error422('Exam id Not Found In URL');
    } elseif ($examParams["exam_id"] == null) {
        return error422('Enter exam_id');
    }

    $examId = mysqli_real_escape_string($conn, $examParams["exam_id"]);

    $query = "DELETE FROM exams WHERE exam_id='$examId' LIMIT 1 ";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_affected_rows($conn) > 0) {
            $data = [
                'status' => 200,
                'message' => 'Exam deleted successfully'
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'Exam Not Found'
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}

?>
