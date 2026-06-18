<?php
require_once "../connection.php";
function getUserByID($id){
    global $connection;
    $stmt = $connection-> prepare("select * from users where id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();
    return $user;
}


function getUserByEmail($email){
    global $connection;
    $stmt = $connection-> prepare("select * from users where email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    return $user;
}

function createUser($name, $email, $hashedPass, $role, $council_id) {
    global $connection;
$stmt = $connection->prepare("INSERT INTO users (name, email, password, role, council_id) VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([$name, $email, $hashedPass, $role, $council_id]);
}

function UpdatePass($id , $newPass){
    global $connection;
    $stmt = $connection->prepare("UPDATE users SET password = ? WHERE id = ?");
    $hashedPass = password_hash($newPass, PASSWORD_BCRYPT);
    $user = $stmt->execute([$hashedPass,$id]);
    return $user;
}

function getID_byEmail($email){
    global $connection;
    $stmt = $connection->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    return $user;
}

function UpdatePassByEmail($email, $newPass){
    global $connection;
    $stmt = $connection->prepare("UPDATE users SET password = ? WHERE email = ?");
    $hashedPass = password_hash($newPass, PASSWORD_BCRYPT);
    $user = $stmt->execute([$hashedPass,$email]);
    return $user;
}



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

function getUserById2($id){
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