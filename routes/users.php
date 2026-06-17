<?php

require_once __DIR__ . '/../helpers/response.php';
require_once __DIR__ . '/../controllers/UserController.php';

$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);

if ($method == 'GET') {

    if (isset($_GET['id'])) {
        getSingleUser($_GET['id']);
    } else {
        getUserList();
    }

} elseif ($method == 'PUT') {

    if (!isset($_GET['id'])) {
        response(400, "User ID is required");
    }

    editUser($_GET['id'], $data);

} elseif ($method == 'DELETE') {

    if (!isset($_GET['id'])) {
        response(400, "User ID is required");
    }

    deleteUser($_GET['id']);

} elseif ($method == 'POST') {

    if (!isset($_GET['id'])) {
        response(400, "User ID is required");
    }

    assignUserTitle($_GET['id'], $data);

} else {
    response(404, "Route not found");
}