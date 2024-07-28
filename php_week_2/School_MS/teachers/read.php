<?php
error_reporting(E_ALL);

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With");

require ('../function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "GET") {
    if (isset($_GET['student_id'])) {
        $teacher = getTeacher($_GET);
        echo $teacher;
    } else {
        $teacherList = getTeacherList();
        echo $teacherList;
    }
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}

?>
