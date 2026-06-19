<?php
 require_once "../repos/SubmRepo.php";
 require_once "../helpers/JWT.php";

function view_submission($connection, $userId)
{
    $verifedToken = VerifyToken();
    require_admin($verifedToken);
     $submissions = submission_get_by_user($connection, $userId);
    if (!$submissions) {
        http_response_code(404);
        return;
    }
    http_response_code(200);
    echo json_encode($submissions);
}
 
function create_submission($connection, $body)
{
        $verifedToken = VerifyToken();
        if (empty($body['user_id']) || empty($body['task_id']) || empty($body['submission_time']) || empty($body['uploads'])) {
        http_response_code(422);
        echo json_encode(['error' => 'Missing required fields']);
        return;
    }
 
    submission_create($connection, $body['user_id'], $body['task_id'], $body['submission_time'], $body['uploads']);
    http_response_code(201);
    echo json_encode(['message' => 'Task submitted']);
}
 
