<?php
require_once "../connection.php";
function getUserByID($id){
    global $conn;
    $stmt = $conn-> prepare("select * from users where id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();
    return $user;
}


function getUserByEmail($email){
    global $conn;
    $stmt = $conn-> prepare("select * from users where email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    return $user;
}

function createUser($name, $email, $hashedPass, $role, $council_id) {
    global $conn;
$stmt = $conn->prepare("INSERT INTO users (name, email, password, role, council_id) VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([$name, $email, $hashedPass, $role, $council_id]);
}

function UpdatePass($id , $newPass){
    global $conn;
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $hashedPass = password_hash($newPass, PASSWORD_BCRYPT);
    $user = $stmt->execute([$hashedPass,$id]);
    return $user;
}

function getID_byEmail($email){
    global $conn;
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    return $user;
}

function UpdatePassByEmail($email, $newPass){
    global $conn;
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $hashedPass = password_hash($newPass, PASSWORD_BCRYPT);
    $user = $stmt->execute([$hashedPass,$email]);
    return $user;
}