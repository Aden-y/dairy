<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once('../middlewares/Middleware.php');
require_once('../services/EmployeeHomeService.php');

Middleware::employee();
http_response_code(200);
echo json_encode(EmployeeHomeService::load());

