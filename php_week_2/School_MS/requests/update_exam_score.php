<?php
error_reporting(E_ALL);

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With");

require 'requests_functions.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "PUT") {
    $input = json_decode(file_get_contents("php://input"), true);
    if (isset($input['exam_id']) && isset($input['score'])) {
        $examId = $input['exam_id'];
        $score = $input['score'];
        $response = updateExamScore($examId, $score);
        echo $response;
    } else {
        echo json_encode([
            "status" => 422, 
            "message" => "Please provide exam ID and score"
        ]);
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
