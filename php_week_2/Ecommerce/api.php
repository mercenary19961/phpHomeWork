<?php
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    // Handle GET request
    $data = [
        'message' => 'Hello, this is a GET request',
        'status' => 'success'
    ];
    echo json_encode($data);
} elseif ($method == 'POST') {
    // Handle POST request
    $input = json_decode(file_get_contents('php://input'), true);
    $data = [
        'message' => 'Hello, this is a POST request',
        'received' => $input,
        'status' => 'success'
    ];
    echo json_encode($data);
} else {
    // Handle other request methods
    http_response_code(405);
    echo json_encode(['message' => 'Method Not Allowed']);
}
?>
