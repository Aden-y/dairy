<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once('../middlewares/Middleware.php');
require_once('../services/AdminHomeService.php');

Middleware::admin();
$response = AdminHomeService::load();
http_response_code($response['status']);
echo json_encode($response);
