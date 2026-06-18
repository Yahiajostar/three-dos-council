<?php

/**
 * Authentication Login Controller
 * * Verifies user credentials against stored database records.
 * Issues a stateless JSON Web Token (JWT) upon successful authentication.
 */

require_once '../connection.php';
require_once '../helpers/response.php';
require_once '../helpers/JWT.php'; 
require_once '../repos/user_repo.php';
require_once '../helpers/validation.php';
/**
 * Authenticates a user and issues an authorization token.
 * * @param array $data Contains user credentials ('email', 'password')
 */
function login($data){
   // global $connection;
    $email = $data['email'];
    $pass  = $data['password'];
    // Execute dynamic structure and format validation
    empty_validation($data , ['email' , 'password']);
    validateEmail($data['email']);
    // Check if identity exists in data rows
    $user = getUserByEmail($email);
    if (!$user) {
        response(404, "User not found");
    }
    
    // Securely verify input string against the stored BCRYPT cryptographically hashed password
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
