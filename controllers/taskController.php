<?php
  require_once "../repos/taskRepo.php";
  require_once "../helpers/JWT.php";

function task_view($connection)
{
    $verifedToken = VerifyToken();
    if (isset($_GET['title'])) {
        $tasks = task_by_title($connection, $_GET['title']);
    } else {
        $tasks = task_get_all($connection);
    }
 
    if (!$tasks) {
        http_response_code(404);
        return;
    }
    http_response_code(200);
    echo json_encode($tasks);
}
 
function new_task($connection, $body)
{
    $verifedToken = VerifyToken();
    require_admin($verifedToken);

    if (empty($body['title']) || empty($body['description']) || empty($body['deadline']) || empty($body['assignedby'])) {
        http_response_code(422);
        echo json_encode(['error' => 'Missing required fields']);
        return;
    }
 
    task_create($connection, $body['title'], $body['description'], $body['deadline'], $body['assignedby']);
    http_response_code(201);
    echo json_encode(['message' => 'Task created']);
}
 
function update_task($connection, $taskId, $body)
{
    $verifedToken = VerifyToken();
    require_admin($verifedToken);
 
    $currentTask = task_by_id($connection, $taskId);
    if (!$currentTask) {
        http_response_code(404);
        echo json_encode(['error' => 'Task not found']);
        return;
    }
    $title       = isset($body['title'])       ? $body['title']       : $currentTask['title'];
    $description = isset($body['description']) ? $body['description'] : $currentTask['description'];
    $deadline    = isset($body['deadline'])    ? $body['deadline']    : $currentTask['deadline'];
    $assignedby  = isset($body['assignedby'])  ? $body['assignedby']  : $currentTask['assignedby'];
 
    task_update($connection, $taskId, $title, $description, $deadline, $assignedby);
    http_response_code(200);
    echo json_encode(['message' => 'Task updated successfully']);
}
 
function task_del($connection, $title)
{
    $verifedToken = VerifyToken();
    require_admin($verifedToken);
 
    task_delete($connection, $title);
    http_response_code(200);
    echo json_encode(['message' => 'Task deleted']);
}
 
