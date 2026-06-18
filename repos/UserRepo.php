<?php
require_once __DIR__ . '/../connection.php';

function getAllUsers(){
    global $connection;

    $statement = $connection->prepare("
        SELECT id, name, email, role, council_id 
        FROM users 
        WHERE is_deleted = 0
    ");

    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getUserById($id){
    global $connection;

    $statement = $connection->prepare("
        SELECT id, name, email, role, council_id 
        FROM users 
        WHERE id = ? AND is_deleted = 0
    ");

    $statement->execute([$id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

function updateUser($id, $name, $email){
    global $connection;

    $statement = $connection->prepare("
        UPDATE users 
        SET name = ?, email = ? 
        WHERE id = ?
    ");

    return $statement->execute([$name, $email, $id]);
}

function softDeleteUser($id){
    global $connection;

    $statement = $connection->prepare("
        UPDATE users 
        SET is_deleted = 1 
        WHERE id = ?
    ");

    return $statement->execute([$id]);
}

function assignTitle($userId, $titleId){
    global $connection;

    $statement = $connection->prepare("
        INSERT INTO delegate_title (user_id, title_id) 
        VALUES (?, ?)
    ");

    return $statement->execute([$userId, $titleId]);
}