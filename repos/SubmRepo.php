<?php
 
function submission_get_by_user($connection, $userId)
{
    $stmt = $connection->prepare('SELECT * FROM submissions WHERE user_id = ? AND is_deleted = 0');
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
 
function submission_create($connection, $userId, $taskId, $submissionTime, $uploads)
{
    $stmt = $connection->prepare(
        'INSERT INTO submissions (user_id, task_id, submission_time, uploads) VALUES (?, ?, ?, ?)'
    );
    $stmt->execute([$userId, $taskId, $submissionTime, $uploads]);
}