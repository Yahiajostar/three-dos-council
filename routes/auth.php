<?php

/**
 * Authentication Central Router
 * * DESIGN DECISIONS:
 * 1. Switch-Case Selection: Used instead of multiple if-else loops because it provides 
 * better readability and slightly faster execution via jump tables when matching a single variable ($action).
 * * 2. Lazy Loading (Conditional Requires): Controller files are strictly loaded inside their 
 * respective cases rather than at the top of the file. This ensures PHP only parses and consumes 
 * memory for the specific controller needed by the active HTTP request, optimizing server resources.
 */

header("Content-Type: application/json; charset=UTF-8");

// Handle CORS Preflight Options Request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once '../helpers/response.php'; 
// Extract target action endpoint from URL parameters
$action = $_GET['action'] ?? '';
// Safely parse raw JSON input payload from request body
$data = json_decode(file_get_contents("php://input"), true) ?? [];
// Route API traffic conditionally based on action parameter
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