<?php
 
 
function task_get_all($connection)
{
    $stmt = $connection->query('SELECT * FROM tasks WHERE is_deleted = 0');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
 
function task_by_title($connection, $title)
{
    $stmt = $connection->prepare('SELECT * FROM tasks WHERE title LIKE ? AND is_deleted = 0');
    $stmt->execute(["%$title%"]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
 
function task_by_id($connection, $taskId)
{
    $stmt = $connection->prepare('SELECT * FROM tasks WHERE task_id = ? AND is_deleted = 0');
    $stmt->execute([$taskId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
 
function task_create($connection, $title, $description, $deadline, $assignedby)
{
    $stmt = $connection->prepare(
        'INSERT INTO tasks (title, description, deadline, assignedby) VALUES (?, ?, ?, ?)'
    );
    $stmt->execute([$title, $description, $deadline, $assignedby]);
}
 
function task_update($connection, $taskId, $title, $description, $deadline, $assignedby)
{
    $stmt = $connection->prepare(
        'UPDATE tasks SET title = ?, description = ?, deadline = ?, assignedby = ? WHERE task_id = ?'
    );
    $stmt->execute([$title, $description, $deadline, $assignedby, $taskId]);
}
 
function task_delete($connection, $title)
{
    $stmt = $connection->prepare('UPDATE tasks SET is_deleted = 1 WHERE title = ?');
    $stmt->execute([$title]);
}
 