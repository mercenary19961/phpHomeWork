<?php
error_reporting(E_ALL);

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With");

require ('../function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "PUT") {
    $inputData = json_decode(file_get_contents("php://input"), true);
    if (empty($inputData)) {
        $updateStudent = updateStudent($_POST, $_GET);
    } else {
        $updateStudent = updateStudent($inputData, $_GET);
    }
    echo $updateStudent;
}
else {
    $data = [
        'status' => 405,
        'message' => $requestMethod. ' Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}

?>