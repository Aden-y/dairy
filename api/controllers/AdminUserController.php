<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once('../middlewares/Middleware.php');
require_once('../services/UserService.php');
require_once('../services/RegistrationService.php');

Middleware::admin();

//Get the data in the request
$string_data = file_get_contents("php://input");
$data = json_decode($string_data);

if($data == null || empty($data->action)) {
    http_response_code(400);
    echo json_encode(['error' => 'Incomplete data']);
    exit();
}

if($data->action == 'register') {
    if( $data == null || empty($data->firstname) || empty($data->lastname) || empty($data->email) || empty($data->phone)) {
        http_response_code(400);
        echo json_encode(['error' => 'Incomplete data']);
    }else {
        $response = RegistrationService::register($data);
        http_response_code($response['status']);
        echo json_encode($response);
    }
    exit();
}else if($data->action  == 'users') {
    if(empty($data->role)) {
        http_response_code(400);
        echo json_encode(['error' => 'Incomplete data']);
        exit();
    }else {
        $response = UserService::getUsers($data->role);
        http_response_code($response['status']);
        echo json_encode($response);
        exit();
    }
}

?>