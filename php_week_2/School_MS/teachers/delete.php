<?php
error_reporting(E_ALL);

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With");

require ('../function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "DELETE") {
    $deleteTeacher = deleteTeacher($_GET);
    echo $deleteTeacher;
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