<?php

header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once '../helpers/response.php'; 

$action = $_GET['action'] ?? '';

$data = json_decode(file_get_contents("php://input"), true) ?? [];

switch ($action) {
    case 'signup':
        require_once '../controllers/signup.php';
        signup($data);
        break;

    case 'login':
        require_once '../controllers/login.php';
        login($data);
        break;

    case 'forget_password':
        require_once '../controllers/forget_password.php';
        forget_password($data);
        break; 

    case 'reset_password':
        require_once '../controllers/reset_password.php';
        resetPassword($data);
        break;

    default:
        response(404, "Invalid action or Endpoint not found");
        break;
}