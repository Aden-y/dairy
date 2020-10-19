<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once('../services/RegistrationService.php');
require_once('../middlewares/Middleware.php');

Middleware::guest();

//Get the data in the request
$string_data = file_get_contents("php://input");
$data = json_decode($string_data);
if( $data == null || empty($data->firstname) || empty($data->lastname) || empty($data->email) || empty($data->phone)
|| empty($data->national_id) || empty($data->type) || empty($data->county) || empty($data->subcounty) || empty($data->ward) || empty($data->place) || empty($data->password)
/* || (empty($data->specialization && $data->type == 'Vet')) 
  || (empty($data->agrovet && $data->type == 'Agrovet'))*/
) {
    http_response_code(400);
    echo json_encode(['error' => 'Incomplete data', 'agrovet'=>$data->agrovet, 'specialization'=>$data->specialization]);
}
if($data->type == 'Admin' || $data->type == 'Employee') {
  http_response_code(401);
  echo json_encode(['error'=> 'You are not authorised to make this kind of registration']);
  exit();
}
$response = RegistrationService::register($data);
http_response_code($response['status']);
echo json_encode($response);
?>