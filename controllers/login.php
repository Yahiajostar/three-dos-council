<?php
require_once '../connection.php';
require_once '../helpers/response.php';
require_once '../helpers/JWT.php'; 
require_once '../repos/user_repo.php';
require_once '../helpers/validation.php';
function login($data){
   // global $connection;
    $email = $data['email'];
    $pass  = $data['password'];
    empty_validation($data , ['email' , 'password']);
    validateEmail($data['email']);
    $user = getUserByEmail($email);
    if (!$user) {
        response(404, "User not found");
    }

    $isPasswordCorrect = password_verify($pass, $user['password']);
    if (!$isPasswordCorrect) {
        response(401, "Invalid email or password"); 
    }
    $token = GenerateToken($user);

    response(200, "Login successful", [
        "token" => $token,
        "user" => [
            "id" => $user['id'],
            "name" => $user['name'],
            "role" => $user['role']
        ]
    ]);
}
