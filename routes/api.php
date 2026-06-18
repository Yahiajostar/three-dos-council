<?php

require_once "../controllers/feedbackController.php";

$data = json_decode(file_get_contents("php://input"), true);
$path = $_SERVER['PATH_INFO'];

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id']) && $path == '/feedback')
{
    feedback_show($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] == "GET" && $path == '/feedback')
{
    feedbacks();
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && $path == '/feedback')
{
    feedback_create($data);
}

if ($_SERVER['REQUEST_METHOD'] == "PUT" && $path == '/feedback' && isset($_GET['id']))
{
    feedback_update($_GET['id'], $data);
}

if ($_SERVER['REQUEST_METHOD'] == "DELETE" && $path == '/feedback' && isset($_GET['id']))
{
    feedback_delete($_GET['id']);
}
