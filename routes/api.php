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
require_once "../controllers/materialcontroller.php";
require_once "../controllers/sessioncontroller.php";
$path = $_SERVER['PATH_INFO'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];
$segments = explode('/', trim($path, '/'));
$resource = $segments[0] ?? '';

//GET ALL SESSIONS
if(
    $_SERVER['REQUEST_METHOD'] == "GET"
    &&
    $path == "/sessions"
){
    getAllSessions();
}

//GET session by id
if(
    $_SERVER['REQUEST_METHOD'] == "GET"
    &&
    preg_match("#^/sessions/([0-9]+)$#", $path, $matches)
){
    getSessionById($matches[1]);
}

//delete session
elseif($method == "DELETE")
{
    if($resource == "sessions" && isset($segments[2]))
    {
        deleteSession($segments[1]);
    }
}

//get materials
if(
    $_SERVER['REQUEST_METHOD'] == "GET"
    &&
    $path == "/materials"
){
    getAllMaterials();
}

//delete material
if(
    $_SERVER['REQUEST_METHOD'] == "DELETE"
    &&
    preg_match("#^/materials/([0-9]+)$#", $path, $matches)
){
    deleteMaterial($matches[1]);
}
