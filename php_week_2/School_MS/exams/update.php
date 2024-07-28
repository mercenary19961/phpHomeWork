<?php
require '../config.php';
require '../function.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "PUT") {
    $inputData = json_decode(file_get_contents("php://input"), true);
    if (isset($_GET['exam_id'])) {
        $result = updateExam($inputData, $_GET);
        echo $result;
    } else {
        $data = [
            'status' => 400,
            'message' => 'Exam ID Not Provided',
        ];
        header("HTTP/1.0 400 Bad Request");
        echo json_encode($data);
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
