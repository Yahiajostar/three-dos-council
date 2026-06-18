<?php
/**
 * User Repository
 *
 * Handles all direct database queries for the users table.
 * Contains no request/response logic - only raw data access.
 */
require_once __DIR__ . '/../connection.php';

/**
 * Returns every user that has not been soft-deleted.
 */
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

/**
 * Returns a single user by id, excluding soft-deleted rows.
 *
 * @param int $id The user's id
 */
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

/**
 * Updates a user's name and email.
 *
 * @param int $id The user's id
 * @param string $name New name value
 * @param string $email New email value
 */
function updateUser($id, $name, $email){
    global $connection;
    $statement = $connection->prepare("
        UPDATE users 
        SET name = ?, email = ? 
        WHERE id = ?
    ");
    return $statement->execute([$name, $email, $id]);
}

/**
 * Soft deletes a user - marks the row as deleted instead of removing it.
 *
 * @param int $id The user's id
 */
function softDeleteUser($id){
    global $connection;
    $statement = $connection->prepare("
        UPDATE users 
        SET is_deleted = 1 
        WHERE id = ?
    ");
    return $statement->execute([$id]);
}

/**
 * Links a user to a title by inserting into the delegate_title table.
 *
 * @param int $userId The user's id
 * @param int $titleId The title's id
 */
function assignTitle($userId, $titleId){
    global $connection;
    $statement = $connection->prepare("
        INSERT INTO delegate_title (user_id, title_id) 
        VALUES (?, ?)
    ");
    return $statement->execute([$userId, $titleId]);
}
?>