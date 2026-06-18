<?php
  require_once "taskController.php";
 require_once "SubmController.php";

 
$method = $_SERVER['REQUEST_METHOD'];
 
try {
    if ($method === 'GET') {
        if (isset($_GET['submissions']) && isset($_GET['user_id'])) {
            view_submission($connection, $_GET['user_id']);
        } else {
            task_view($connection);
        }
    } elseif ($method === 'POST') {
        $body = json_decode(file_get_contents('php://input'), true);
 
        if (isset($_GET['submit'])) {
            create_submission($connection, $body);
        } elseif (isset($_GET['create'])) {
            new_task($connection, $body);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Provide an action']);
        }
    } elseif ($method === 'DELETE') {
        if (isset($_GET['title'])) {
            task_del($connection, $_GET['title']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Please provide title']);
        }
    } elseif ($method === 'PATCH') {
        if (!isset($_GET['task_id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Please provide task_id']);
            exit;
        }
        $body = json_decode(file_get_contents('php://input'), true);
        update_task($connection, $_GET['task_id'], $body);
    } else {
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
    }
} catch (PDOException $err) {
    http_response_code(500);
    echo json_encode(['error' => 'failed' . $err->getMessage()]);
}
 