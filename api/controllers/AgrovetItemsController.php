<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once('../middlewares/Middleware.php');
require_once('../services/AgrovetStoreService.php');

//Get the data in the request
$string_data = file_get_contents("php://input");
$data = json_decode($string_data);

if( empty($data->action)
) {
    http_response_code(400);
    echo json_encode(['error' => 'Incomplete data']);
    exit();
}

$response = AgrovetStoreService::handle($data);
http_response_code($response['status']);
echo json_encode($response);

?>