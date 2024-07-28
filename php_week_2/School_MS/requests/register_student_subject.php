<?php
error_reporting(E_ALL);
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require '../config.php';
require 'requests_functions.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "POST") {
    $inputData = json_decode(file_get_contents("php://input"), true);
    if (isset($inputData['student_name']) && isset($inputData['subject_name'])) {
        $response = registerStudentInSubject($inputData);
        echo $response;
    } else {
        echo json_encode(["status" => 422, "message" => "Invalid Input"]);
    }
} else {
    echo json_encode(["status" => 405, "message" => $requestMethod . " Method Not Allowed"]);
}
?>
