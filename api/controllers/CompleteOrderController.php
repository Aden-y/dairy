<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once('../middlewares/Middleware.php');
require_once('../services/AgrovetHomeService.php');

Middleware::agrovet();
$string_data = file_get_contents("php://input");
$data = json_decode($string_data);
if(empty($data->id)) {
    http_response_code(400);
    echo json_encode(['error'=>'Incomplete data']);

}else{
    echo json_encode(AgrovetHomeService::complete($data->id));
}
