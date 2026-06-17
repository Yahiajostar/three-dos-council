<?php
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