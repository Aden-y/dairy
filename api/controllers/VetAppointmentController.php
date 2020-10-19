<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once('../middlewares/Middleware.php');
require_once('../services/VetAppointmentService.php');

//Get the data in the request
$string_data = file_get_contents("php://input");
$data = json_decode($string_data);

if($data == null ||  empty($data->action)
) {
    http_response_code(400);
    echo json_encode(['error' => 'Incomplete data or unsuported data format']);
    exit();
}

$action = $data->action;
if($action == 'farmer') {
    Middleware::farmer();
    $response = VetAppointmentService::farmerAppointments();
    http_response_code($response['status']);
    echo json_encode($response);
    exit();
}else if($action == 'vet') {
    Middleware::vet();
    $status = $data->status;
    if($status == 'all') {
        $response = VetAppointmentService::vetAppointments();
    }else {
        $response = VetAppointmentService::vetPendingAppointments();
    }
    
    http_response_code($response['status']);
    echo json_encode($response);
    exit();
}
?>
