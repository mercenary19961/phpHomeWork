<?php 

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

    include('function.php');

    $requestMethod = $_SERVER["REQUEST_METHOD"];

    if($requestMethod == "GET") {

        $customerList = getCustomerList();
        echo $customerList;
    }
    else {
        $data = [
            'status' => 405,
            'message' => $requestMethod, 'Method Not Allowed',
        ];
        header("HTTP/1.0 405 Method Not Allowed");
        echo json_encode($data);
    }
?>