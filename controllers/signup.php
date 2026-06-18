<?php
/**
 * User Account Registration Controller
 * * Handles client self-registration flows, safely checks for system account duplication, 
 * abstracts access roles logic and structures password crypto strings securely.
 */

require_once '../connection.php';
require_once '../helpers/response.php';
require_once '../helpers/JWT.php'; 
require_once '../repos/user_repo.php';
require_once '../helpers/validation.php';


function signup($data){
    // Capture user payload parameters with default constraints fallback
    $name     = $data['name'] ?? '';
    $email    = $data['email'] ?? '';
    $password = $data['password'] ?? '';
    $role = !empty($data['role']) ? $data['role'] : 'delegates';
    $council_id = $data['council_id'] ?? null;
    
    // Perform standard formatting checks
    validateEmail($data['email']);
    empty_validation($data , ['name','email' , 'password']);

    // Guard constraint preventing profile email uniqueness redundancy collisions
    if (getUserByEmail($email)) {
        response(400, "User already exists");
    }

    // Securely obscure text password with robust one-way BCRYPT hashing algorithm
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Save entity state into persistent storage layers
    $isCreated = createUser($name, $email, $hashedPassword, $role , $council_id);
    if ($isCreated) {
        response(201, "User registered successfully");
    } else {
        response(500, "Something went wrong while creating the user");
    }
}