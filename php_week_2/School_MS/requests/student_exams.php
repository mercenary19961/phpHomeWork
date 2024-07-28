<?php
error_reporting(E_ALL);

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With");

require 'requests_functions.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == 'GET') {
    if (isset($_GET['name'])) {
        $studentName = $_GET['name'];
        $response = getStudentExams($studentName);
        echo $response;
    } else {
        $error = error422("Please provide a subject name");
        echo $error;
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
